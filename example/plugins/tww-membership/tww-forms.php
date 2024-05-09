<?php
/**
 * Plugin Name: TWW Forms V1
 * Description: Custom forms for TWW Plus registration
 * Version: 1.0
 * Author: The Wellness Way
 * Author URI: https://www.thewellnessway.com
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: tww-forms
 * Domain Path: /languages
 */

 if(!defined('ABSPATH')) {
     exit;
 }

 if(!defined('TWW_FORMS_PLUGIN_FILE')) {
     define('TWW_FORMS_PLUGIN_FILE', __FILE__);
 }

 if(!defined('TWW_FORMS_PLUGIN')) {
     define('TWW_FORMS_PLUGIN', plugin_dir_path(__FILE__));
 }  

 if(!defined('TWW_FORMS_PLUGIN_URL')) {
     define('TWW_FORMS_PLUGIN_URL', plugin_dir_url(__FILE__));
 }

 require_once 'vendor/autoload.php';

 use TWWForms\Includes\TWW_User;

class TWW_Forms {
    public function __construct() {
        add_filter('mepr_design_style_handles', [$this, 'tww_design_style_handle_prefixes']);
    }

    public function tww_design_style_handle_prefixes($allowed_handles) {
        $allowed_handles[] = 'tww-forms';

        return $allowed_handles;
    }

    public static function get_last_subscription_id() {
        $tww_user = new TWW_User();

        $last_subscription = $tww_user->get_last_subscription();

        return $last_subscription ? $last_subscription->id : null;
    }

    public static function sub_in_grace_period() {
        $tww_user = new TWW_User();

        $last_subscription = $tww_user->get_last_subscription();
        if(!$last_subscription || !$last_subscription->id ) {
            return false;
        }

        $last_subscription = new \MeprSubscription($last_subscription->id);

        return $last_subscription ? $last_subscription->in_grace_period() : false;
    }

    public static function get_active_subscription_id() {
        $user_id = get_current_user_id();

        if(!class_exists('MeprDb') || !$user_id) {
            return null;
        }

        $active_status = 'active'; 
        $mepr_db = \MeprDb::fetch();
        $active_subscription = $mepr_db->get_one_record($mepr_db->subscriptions, [
            'user_id' => $user_id, 
            'status' => $active_status
        ]);

        return $active_subscription !== null ? $active_subscription->id : null;
    }

    public static function get_subscription_gateway($subscription_id) {
        if(!class_exists('MeprDb')) {
            return null;
        }

        $mepr_db = \MeprDb::fetch();
        $subscription = $mepr_db->get_one_record($mepr_db->subscriptions, ['id' => $subscription_id]);

        return $subscription !== null ? $subscription->gateway : null;
    }

    public static function active_subscription_in_grace_period() {
        $sub = new MeprSubscription(self::get_active_subscription_id());

        return $sub ? $sub->in_grace_period() : false;
    }
}

$twwForms = new TWW_Forms();

add_action('wp_enqueue_scripts', 'tww_register_styles');
function tww_register_styles() {
    $version = '1.0.7';

    wp_register_style('tww-forms', TWW_FORMS_PLUGIN_URL . 'resources/assets/css/tww-forms.css', [], $version, 'all');
    wp_enqueue_style('tww-forms');
    wp_register_style('tww-forms-two', TWW_FORMS_PLUGIN_URL . 'resources/assets/css/tww-forms-two.css', [], $version, 'all');
    wp_enqueue_style('tww-forms-two');
}

add_action('wp_enqueue_scripts', 'tww_register_scripts');
function tww_register_scripts() {
    $version = '1.0.71';
    $active_subscription_id = TWW_Forms::get_active_subscription_id();

    wp_register_script('tww-forms', TWW_FORMS_PLUGIN_URL . 'resources/assets/js/tww-forms.js', [], $version, true);
    wp_enqueue_script('tww-forms');
    wp_localize_script('tww-forms', 'twwForms', [
        'siteUrl' => site_url(),
        'iconsPath' => TWW_FORMS_PLUGIN_URL . 'resources/assets/images/icons/',
        'restNonce' => wp_create_nonce('wp_rest'),
        'active_subscription_id' => TWW_Forms::get_last_subscription_id() ?? null,
        'active_subscription_in_grace_period' => TWW_Forms::active_subscription_in_grace_period() ?? false,
        'sub_in_grace_period' => TWW_Forms::sub_in_grace_period() ?? false,
        'gateway' => TWW_Forms::get_subscription_gateway($active_subscription_id),
    ]);

    wp_register_script('tww-helpers', TWW_FORMS_PLUGIN_URL . 'resources/assets/js/helpers.js', [], $version, true);
    wp_register_script('tww-config', TWW_FORMS_PLUGIN_URL . 'resources/assets/js/config.js', [], $version, true);
    wp_register_script('tww-state', TWW_FORMS_PLUGIN_URL . 'resources/assets/js/state.js', [], $version, true);
    wp_register_script('tww-loader', TWW_FORMS_PLUGIN_URL . 'resources/assets/js/loader.js', [], $version, true);

    wp_enqueue_script('tww-helpers');
    wp_enqueue_script('tww-config');
    wp_enqueue_script('tww-state');
    wp_enqueue_script('tww-loader');
}

use TWWForms\Routes\TWW_SubscriptionRoute;

$twwSubscriptionRoutes = new TWW_SubscriptionRoute();
add_action('rest_api_init', [$twwSubscriptionRoutes, 'boot']);

use TWWForms\Routes\TWW_CancelRoute;
$twwCancelRoute = new TWW_CancelRoute();
add_action('rest_api_init', [$twwCancelRoute, 'boot']);

use TWWForms\Routes\TWW_UpdateUsernameRoute;
$twwUpdateUsername = new TWW_UpdateUsernameRoute();
add_action('rest_api_init', [$twwUpdateUsername, 'boot']);

use TWWForms\Routes\TWW_UpdateSubscriptionRoute;
$twwUpdateSubscriptionRoute = new TWW_UpdateSubscriptionRoute();
add_action('rest_api_init', [$twwUpdateSubscriptionRoute, 'boot']);

use TWWForms\Includes\TWW_Email;
use TWWForms\Utils\TWW_MpCreate;

use TWWForms\Shortcodes\TWW_FreeShortcode;
use TWWForms\Shortcodes\TWW_MembershipShortcode;
use TWWForms\Shortcodes\TWW_EditUsernameShortcode;



add_action('init', function() {
    $twwEmail = new TWW_Email();

    $twwFreeShortcode = new TWW_FreeShortcode();
    $twwMembershipShortcode = new TWW_MembershipShortcode();
    $twwEditUsernameShortcode = new TWW_EditUsernameShortcode();

    $twwCreate = new TWW_MpCreate();
});


