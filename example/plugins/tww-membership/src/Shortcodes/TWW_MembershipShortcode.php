<?php
namespace TWWForms\Shortcodes;

use MeprAccountCtrl;
use MeprDb;
use TWWForms\Includes\TWW_User;
use MeprSubscription;

class TWW_MembershipShortcode extends TWW_Shortcodes {
    const SHORTCODE_NAME = 'TWW+ Membership';
    const NO_ACTIVE_TITLE = 'No active membership';
    private $scenario;
    private $sub_id;

    public function set_sc_settings() {
        $this->sc_settings = [
            'name' => 'tww_current_membership',
            'handle' => 'tww-current-membership-shortcode',
            'capability' => 'edit_user',
            'permission_callback' => 'is_user_logged_in',
        ];
    }

    public $next_billing_at, $expires_at, $case, $active_subscription_id, $product_title, $has_active_subscription, $subscription, $latest_txn, $has_expired, $price, $memberpress_product;

    public function render_shortcode($atts, $content = null) {
        if($this->sc_settings['handle']) {
            wp_enqueue_script($this->sc_settings['handle']);
        }

        $atts = shortcode_atts([
            'justify' => 'flex-start',
        ], $atts);

        if(!class_exists('MeprDb')) {
            return '<p>MembershipPress is not installed</p>';
        }
        
        $tww_user = new TWW_User(get_current_user_id());

        if(!$tww_user->ID) {
            return '<p>You must be logged in to view this content</p>';
        }

        $user_id = $tww_user->ID;
        $subscription = new \MeprSubscription();;
        $prd = new \MeprProduct();
        $subscriptions = $tww_user->subscriptions();

        

        if($subscriptions && $subscriptions[0]) {
            $this->sub_id       = $subscriptions[0]->id;
            $subscription       = new \MeprSubscription($subscriptions[0]->id);
        
            $this->scenario     = $this->get_scenario($subscription);
            $txn                = $subscription->latest_txn();   
            $prd                = new \MeprProduct($subscription->product_id);
    
            $this->has_active_subscription  = true;
            $this->active_subscription_id   = $subscription->id;
            $this->product_title            = $prd->post_title;
            $this->expires_at               = $txn && $txn->expires_at ? \MeprAppHelper::format_date($txn->expires_at) : '';
            $this->price                    = $subscription->price ? $subscription->price : '';
    
            $this->case = $subscription->status;
            $this->next_billing_at = $subscription->next_billing_at ? \MeprAppHelper::format_date($subscription->next_billing_at) : '';
        }
        
        ob_start();
        include TWW_FORMS_PLUGIN . 'templates/current-membership-shortcode.php';
        return ob_get_clean();
    }

    public function in_grace_period($sub_id) {
        $sub = new \MeprSubscription($sub_id);

        return $sub->in_grace_period();
    }

    public function print_status_tag(\MeprSubscription $subscription = null) {
        $scenario = $this->get_scenario($subscription);

        if (strpos($scenario, 'canceled') !== false) {
            $string = 'Canceled';
        } elseif ($scenario === 'active') {
            $string = 'Active';
        } elseif ($scenario === 'lapsed') {
            $string = 'Lapsed';
        } elseif ($scenario === 'suspended') {
            $string = 'Paused';
        } elseif ($scenario === 'no-subscription') {
            $string = 'No Subscriptions';
        } elseif ($scenario === 'expired') {
            $string = 'Expired';
        } else {
            $string = '';
        }
    
        return sprintf('<span class="status-tag %s">%s</span>', $scenario, $string);
    }

    public function get_scenario(\MeprSubscription $subscription = null) {
        $status = $subscription->status;
        $txn = $subscription->latest_txn();
        $expires_at = $txn && $txn->expires_at ? \MeprAppHelper::format_date($txn->expires_at) : '';
        $latest_txn_failed = $subscription->latest_txn_failed();
        $scenario = '';

        /*
        * If a subscription is active and is not in the grace period but it has expired
        * then the status should be 'expired'

        * If a subscription is active and is not in the grace period and it has not expired
        * then the status should be 'active'

        ** if a subscription is active but the latest tranactions has failed or strpos($sub->active, 'No') !== false it should be lapsed

        * if a subscription status is canceled and the subscription has not expired then the status should be 'canceled-but-active'

        * if a subscription status is cancelled and the subscription has expired then the status should be 'canceled-and-expired'
        */

        if ('active' === $status && !$subscription->in_grace_period() && time() > strtotime($expires_at)) {
            $scenario = 'expired';
        }
        
        if ('active' === $status && !$subscription->in_grace_period() && !$latest_txn_failed && time() < strtotime($expires_at)) {
            $scenario = 'active';
        }

        
        if ('cancelled' === $status && time() < strtotime($expires_at)) {
            $scenario = 'canceled-but-active';
        }
        
        if ('cancelled' === $status && time() > strtotime($expires_at)) {
            $scenario = 'canceled-and-expired';
        }
        
        if ('active' === $status && !$subscription->in_grace_period() && ($latest_txn_failed || false !== strpos($subscription->status, 'No'))) {
            $scenario = 'lapsed';
        }
        
        if (!$txn && !$subscription->in_grace_period()) {
            $scenario = 'lapsed';
        }
        
        if ('suspended' === $status) {
            $scenario = 'suspended';
        }
        
        if (!$subscription->id) {
            $scenario = 'no-subscription';
        }
        
        return $scenario;
    }

    public function print_renewel_button($txn_id, $user_id) {
        $user = new \MeprUser($user_id);
        $renewal_link = $user->renewal_link($txn_id);

        if(!$renewal_link) {
            return '';
        }

        return sprintf(
        '<a id="tww-renew-subscription" href="'.$renewal_link.'" class="loader-default--primary loader-default">
            <span class="loader--inner-element"></span>
            Renew Membership
        </a>');
    }

    public function print_card_plan_buttons($sub_id, $user_id = null) {
        $subscription = new \MeprSubscription($sub_id);
        $txn = $subscription->latest_txn();
        $pm = $subscription->payment_method();

        $prd = $subscription->product();
        $url = site_url('/account/?action=update&sub=' . $sub_id);

        $html = '';

        if($pm) {
            $html .= sprintf('
            <a id="tww-update-card" href="%s" class="loader-default--primary loader-default">
                <span class="loader--inner-element"></span>
                Update Card
            </a>', $url);
        }
                    
        if($prd->group()) {
            $html .= sprintf('
            <a id="tww-change-plan-button"  href="#" class="loader-default--primary loader-default">
                <span class="loader--inner-element"></span>
                Change Plan
            </a>');
        }

        return $html;
    }

    public function print_join_button() {
        $url = site_url('/join');

        return sprintf(
        '<a href="%s" class="loader-default--primary loader-default">
            Join
        </a>', $url);
    }

    public function print_actions(\MeprSubscription $subscription = null, $sub_id = null, $user_id = null) {
        $sub_id = $sub_id ?? $subscription->id;
        $user_id = $user_id ?? get_current_user_id();

        $scenario = $this->get_scenario($subscription);

        $html_group_cancel_renew = '';
        $html_group_card_plan = '<div class="current-membership--action-group card-plan">';
        if($sub_id) {
            $html_group_cancel_renew = '<div class="current-membership--action-group cancel-renew">';
            if ('active' === $scenario) {
                $html_group_card_plan .= $this->print_card_plan_buttons($sub_id, $user_id);
                $html_group_cancel_renew .= $this->print_cancellation_button();
            }
            
            if ('canceled-but-active' === $scenario || 'canceled-and-expired' === $scenario) {
                $html_group_card_plan .= $this->print_card_plan_buttons($sub_id, $user_id);
                $html_group_card_plan .= $this->print_renewel_button($sub_id, get_current_user_id());
            }
            
            if ('expired' === $scenario) {
                $html_group_card_plan .= $this->print_card_plan_buttons($sub_id, $user_id);
                $html_group_card_plan .= $this->print_renewel_button($sub_id, get_current_user_id());
            }
            
            if ('lapsed' === $scenario || 'suspended' === $scenario) {
                $html_group_card_plan .= $this->print_card_plan_buttons($sub_id, $user_id);
                $html_group_cancel_renew .= '';
            }
            

            $html_group_cancel_renew .= "</div>";
        } else {
            $html_group_card_plan .= $this->print_join_button();
        }

        $html_group_card_plan .= "</div>";

        $html = $html_group_card_plan . $html_group_cancel_renew;

        return $html;
    }



    public function print_cancellation_button() {
        return sprintf(
        '<a id="tww-cancel-subscription" href="#" class="tww-negative-action">
            <span class="loader--inner-element"></span>
            Cancel Membership
        </a>');
    }

    public function print_tag(\MeprSubscription $subscription) {
        $scenario = $this->get_scenario($subscription);
        return sprintf('<span class="status-tag %s">%s</span>', $this->scenario, $this->scenario);
    }

    public function print_title(\MeprSubscription $subscription, $product_title = null) {
        $scenario = $this->get_scenario($subscription);
        $prd = $subscription->product();
        $product_title = $product_title ?? null;

        if($prd && $prd->post_title && null === $product_title) {
            $product_title = $prd->post_title;
        }

        $title = $product_title ? $product_title : self::NO_ACTIVE_TITLE;

        return sprintf('<h3>%s</h3>', $title);
    }

    public function print_membership_string(\MeprSubscription $subscription) {
        $scenario = $this->get_scenario($subscription);
        $price = $subscription->price ?? '';
        $next_billing_at = $subscription->next_billing_at ? \MeprAppHelper::format_date($subscription->next_billing_at) : '';
        $expires_at = $subscription->latest_txn()->expires_at ? \MeprAppHelper::format_date($subscription->latest_txn()->expires_at) : '';

        switch ($scenario) {
            case 'active':
                $string = sprintf('<p>Your next bill is for <strong>$%s</strong> on <strong>%s</strong></p>', $price, $next_billing_at);
                break;
            case 'canceled-but-active':
                $string = sprintf('<p>Your membership has been canceled but is still active until <strong>%s</strong></p>', $expires_at);
                break;
            case 'canceled-and-expired':
                $string = sprintf('<p>Your membership has been canceled and expired on <strong>%s</strong></p>', $expires_at);
                break;
            case 'lapsed':
                $string = sprintf('<p>There may have been a problem with your latest payment. Please check with your bank or update your card. If you have any further problems, pleae contact support.</p>');
                break;
            case 'expired':
                $string = sprintf('<p>Your membership has expired on <strong>%s</strong></p>', $expires_at);
                break;
            default:
                $string = '';
                break;
        }        
       
        return $string;
    }

    function tww_register_scripts() {
        wp_register_script('tww-current-membership-shortcode', TWW_FORMS_PLUGIN_URL . 'resources/assets/js/current-membership-shortcode.js', [], '1.0.3', true);
        wp_enqueue_script('tww-current-membership-shortcode');
    }
}