<?php
/**
 * Plugin Name: TWW Dashboard
 * Description: Custom dashboard for TWW
 * Version: 1.0
 * Author: The Wellness Way
 * Author URI: https://www.thewellnessway.com
 * Text Domain: tww-dashboard
 * Domain Path: /languages
 * License: GPL2
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define the plugin path
define('TWW_DASHBOARD_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('TWW_DASHBOARD_PLUGIN_URL', plugin_dir_url(__FILE__));
define('TWW_DASHBOARD_PLUGIN_VERSION', '1.0');

class TwwDashboard {
    public function __construct() {
        add_action('init', [$this, 'load_textdomain']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
        //Load the tww-dashboard template from /templates/tww-dashboard.php
        add_filter('theme_templates', [$this, 'add_dashboard_template']);
        add_filter('template_include', [$this, 'load_dashboard_template']);
    }

    public function load_textdomain() {
        load_plugin_textdomain('tww-dashboard', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }

    public function add_dashboard_template() {
        $templates['template-tww_glossary.php'] = __('TWW Glossary', 'tww-glossary');
         return $templates;
    }

    public function load_dashboard_template($template) {
        if(is_page_template('template-tww_dashboard.php')) {
            $template = TWW_DASHBOARD_PLUGIN_PATH . 'templates/template-tww_dashboard.php';
        }

        return $template;
    }

    public function enqueue_scripts() {
        wp_enqueue_style('tww-dashboard', TWW_DASHBOARD_PLUGIN_URL . 'assets/css/tww-dashboard.css', [], TWW_DASHBOARD_PLUGIN_VERSION);
        wp_enqueue_script('tww-dashboard', TWW_DASHBOARD_PLUGIN_URL . 'assets/js/tww-dashboard.js', ['jquery'], TWW_DASHBOARD_PLUGIN_VERSION, true);
    }
}

$tww_dashboard = new TWW_DASHBOARD();