<?php
namespace TWWForms\Routes;

use TWWForms\Routes\TWW_MemberRoute;

class TWW_CancelRoute extends TWW_MemberRoute {
    protected $routes = [
        'cancel' => [
            'methods' => 'POST',
            'callback' => 'cancel_subscription',
            'path' => '/cancel-subscription',
        ]
    ];

    public function boot() {
        $this->register_routes();
    }

    public function cancel_subscription(\WP_REST_Request $request) {
      $id = $request->get_param('active_subscripton_id') ?? null;

      if(!$id) {
        return new \WP_Error('missing_id', 'Missing subscription ID', ['status' => 400]);
      }

      if(!$this->validate_subscription_is_active($id)) {
        return new \WP_Error('invalid_id', 'Subscription is invalid or not active.', ['status' => 400]);
      }

      $memberpress_cancel_route = 'wp-json/mp/v1/subscriptions/' . $id . '/cancel';

      $url = trailingslashit($this->get_site_url()) . $memberpress_cancel_route;
    
      try {
        $result = $this->tww_mp_remote_post($url);
      } catch(\Exception $e) {
        return new \WP_Error('wp_error', $e->getMessage(), ['status' => 500]);
      }

      $mp_response = json_decode(wp_remote_retrieve_body($result), true);

      if(is_object($mp_response) && isset($mp_response->code)) {
        return rest_ensure_response([
          'success' => false,
          'error' => new \WP_Error($mp_response->code, $mp_response->message, ['status' => 500]),
          'message' => "There has been an error. Please try again later or contact support.",
        
        ]);
      }
    
      if(is_wp_error($result)) {
        return rest_ensure_response([
          'success' => false,
          'error' => new \WP_Error('wp_error', $result->get_error_message, ['status' => 500]),
          'message' => "There has been an error. Please try again later or contact support.",
        ]);
      }
    
      return rest_ensure_response([
        'success' => true,
        'message' => $mp_response['message']
      ]);
    }
}