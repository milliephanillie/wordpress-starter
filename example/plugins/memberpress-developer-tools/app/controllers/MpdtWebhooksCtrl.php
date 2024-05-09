<?php
if(!defined('ABSPATH')) {die('You are not allowed to call this page directly.');}

class MpdtWebhooksCtrl extends MpdtBaseCtrl {
  public $events;

  public function __construct() {
    $this->events = require(MPDT_DOCS_PATH . '/webhooks/events.php');
  }

  public function load_hooks() {
    add_action('mepr-event',array($this,'process_event'));
    add_action('wp_ajax_mpdt_event_data',array($this,'ajax_event_data'));
    add_action('wp_ajax_mpdt_send_event',array($this,'ajax_send_event'));
  }

  // Eliminate aggregate events like 'all' from the events array
  public function real_events($keys_only=false) {
    $events = $this->events;
    if(isset($events['all'])) { unset($events['all']); }
    return ($keys_only ? array_keys($events) : $events);
  }

  public function prepare_data($event, $data, $raw_data = null) {
    $info = $this->events[$event];

    switch($info->type) {
      case 'member':
        $utils = MpdtUtilsFactory::fetch('member'); break;
      case 'transaction':
        $utils = MpdtUtilsFactory::fetch('transaction'); break;
      case 'subscription':
        $utils = MpdtUtilsFactory::fetch('subscription'); break;
      default:
        return $data;
    }

    if( is_object($raw_data) && $raw_data instanceof \MeprBaseModel && 'member' === $info->type ){
      if( isset($raw_data->event_args) && !empty($raw_data->event_args) ){
        $data->event_args = $raw_data->event_args;
      }
    }

    return $utils->prepare_obj((array)$data);
  }

  public function process_event($evt) {
    if(!in_array($evt->event, $this->real_events(true))) { return false; }

    $event = $evt->event;
    $data  = $evt->get_data();

    if(is_wp_error($data)) { return $data; }

    // make sure to pass event args
    $event_args = (array) $evt->get_args();
    if( !empty($event_args) ){
      $event_args['event_id'] = $evt->id;
      $event_args['event'] = $event;
      $data->event_args = $event_args;
    }

    $send_now = get_option('mpdt_send_webhook_immediately');
    return $this->send_to_all_webhooks($event, $data, $send_now);
  }

  public function send_to_all_webhooks($event, MeprBaseModel $data, $send_now=false) {

    if(!in_array($event, $this->real_events(true))) { return false; }

    $webhooks = get_option(MPDT_WEBHOOKS_KEY, false);

    // Verify first that we actually have some webhooks
    if(is_array($webhooks) && !empty($webhooks)) {
      foreach($webhooks as $webhook) {
        // Skip it if this event is messed up or not active for this webhook
        if(empty($webhook['url']) ||
           (!isset($webhook['events']['all']) &&
            !isset($webhook['events'][$event])))
        { continue; }

        $this->send($webhook, $event, $data, $send_now);
      }
    }
  }

  public function send($webhook, $event, MeprBaseModel $data, $send_now=false) {

    if(!in_array($event, $this->real_events(true))) { return false; }

    $send_now_events = apply_filters('mpdt-send-now-events', array('member-deleted'), $webhook, $event, $data, $send_now);
    if(in_array($event, $send_now_events)) {
      // Need to send the 'member-deleted' webhook now to make sure the data isn't deleted by the time the cron is ran.
      $send_now = true;
    }

    if($send_now || (defined('DOING_CRON') && DOING_CRON)) {
      $data = $this->prepare_data($event,$data->rec,$data);

      $event_info = $this->events[$event];
      if( true === apply_filters('mpdt-webook-validate-member-data', true, $data, $event, $webhook)
        && isset($data['member'])
        && ( ! is_array($data['member']) || 0 === $data['member'] )
        && in_array($event_info->type, apply_filters('mpdt-webook-member-data-event-types',array('subscription','transaction'), $data, $event, $webhook)) ) {
        // MeprJobs handles this like a boss
        throw new Exception(__('Invalid member or member doesn\'t exist.', 'memberpress', 'memberpress-developer-tools'));
      }

      if( isset($data['event_args']) ){
        unset($data['event_args']);
      }

      $evt_obj = $this->events[$event];
      $type = $evt_obj->type;
      $body = compact('event', 'type', 'data');
      $args = array(
        'method' => 'POST',
        'timeout' => 30,
        'redirection' => 5,
        'httpversion' => '1.1',
        'blocking' => true,
        'headers' => array("Content-Type" => "application/json"),
        'body' => json_encode($body),
        'cookies' => array(),
        'sslverify' => true,
        'user-agent' => 'MemberPress/'.MEPR_VERSION
      );

      if(empty(trim($webhook['url']))) {
        return false;
      }

      $webhook_key  = get_option('mpdt_webhook_key', '');

      // Add Webhook key to  HTTP header if available.
      if( '' !== $webhook_key ){
        $args[ 'headers' ][ 'MEMBERPRESS-WEBHOOK-KEY' ] = $webhook_key;
      }

      $res = wp_remote_post($webhook['url'], $args);

      if(is_wp_error($res)) {
        // MeprJobs handles this like a boss
        throw new Exception($res->get_error_message());
      }
    }
    else {
      // Queue up that event if we're not in CRON yo!
      $job = new MpdtWebhookJob();
      $job->webhook = $webhook;
      $job->event   = $event;

      if(isset($data->ID)) {
        $job->data_id = $data->ID;
      }
      else {
        $job->data_id = $data->id;
      }

      // We need event id to fetch args.
      if( isset($data->event_args) ){
        if( isset($data->event_args['event_id']) ){
          $job->event_id = $data->event_args['event_id'];
        }
      }

      $job->enqueue();
    }

    return true;
  }

  public function ajax_send_event() {
    if(!MeprUtils::is_mepr_admin()) {
      header('HTTP/1.1 401 Unauthorized', true, 401);
      exit(__('Error: You are unauthorized.', 'memberpress-developer-tools'));
    }

    if(!isset($_REQUEST['event'])) {
      header('HTTP/1.1 400 Bad Request', true, 400);
      exit(__('Error: No event was specified.', 'memberpress-developer-tools'));
    }

    $event = $_REQUEST['event'];
    $events = $this->real_events(true);

    if(!in_array($event,$events)) {
      header('HTTP/1.1 400 Bad Request', true, 400);
      exit(__('Error: Invalid event.', 'memberpress-developer-tools'));
    }

    $evt_obj = $this->events[$event];

    $utils = MpdtUtilsFactory::fetch($evt_obj->type);
    $evt_data = $utils->get_event_data($event);

    $data = $this->get_obj($event, $evt_data['data']['id']);
    if(is_wp_error($data)) {
      exit(
        json_encode(
          array(
            'errors' => array(
              $data->get_error_message()
            )
          )
        )
      );
    }

     // make sure to pass event args
    if( isset($evt_data['data']['event_args']) ){
      $data->event_args = $evt_data['data']['event_args'];
    }

    try {
      $this->send_to_all_webhooks($event, $data, true);
    } catch (Exception $e) {
      exit(
        json_encode(
          array(
            'errors' => array(sprintf(__('Event %s failed to send: %s', 'memberpress-developer-tools'), $event, $e->getMessage()))
          )
        )
      );
    }

    exit(
      json_encode(
        array(
          'message' => sprintf(__('Event %s was successfully sent to webhooks', 'memberpress-developer-tools'), $event)
        )
      )
    );
  }

  public function get_obj($event, $id) {
    $info = $this->events[$event];

    switch($info->type) {
      case 'member':       return new MeprUser($id);
      case 'subscription': return new MeprSubscription($id);
      case 'transaction':  return new MeprTransaction($id);
      default: return new WP_Error(__('Unknown event type', 'memberpress-developer-tools'));
    }
  }

  public function ajax_event_data() {
    if(!MeprUtils::is_mepr_admin()) {
      header('HTTP/1.1 401 Unauthorized', true, 401);
      exit(__('Error: You are unauthorized.', 'memberpress-developer-tools'));
    }

    if(!isset($_REQUEST['event'])) {
      header('HTTP/1.1 400 Bad Request', true, 400);
      exit(__('Error: No event was specified.', 'memberpress-developer-tools'));
    }

    $event = $_REQUEST['event'];
    $events = $this->real_events(true);

    if(!in_array($event,$events)) {
      header('HTTP/1.1 400 Bad Request', true, 400);
      exit(__('Error: Invalid event.', 'memberpress-developer-tools'));
    }

    $evt_obj = $this->events[$event];

    $utils = MpdtUtilsFactory::fetch($evt_obj->type);

    // let us get the event data.
    $event_data = apply_filters('mdpt-ajax-event-data', $utils->get_event_data($event));
    if( isset($event_data['data']['event_args']) ){
      unset($event_data['data']['event_args']);
    }

    // prepare json.
    exit(wp_json_encode($event_data));
  }

}
