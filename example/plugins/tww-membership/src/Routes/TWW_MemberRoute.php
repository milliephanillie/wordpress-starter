<?php
namespace TWWForms\Routes;

class TWW_MemberRoute {
    const LOCALHOST_URL = 'http://host.docker.internal:8080';
    protected $routes = [];

    private $api_key = null;
    private $namespace = 'tww/v1';

    public function __construct() {
        $this->api_key = get_option('mpdt_api_key', '');
    }

    public function register_routes( ) {
        foreach($this->routes as $handle => $route) {
            register_rest_route($this->namespace, $route['path'], [
                'methods' => $route['methods'],
                'callback' => [$this, $route['callback']],
                'permission_callback' => '__return_true'
            ]);
        }
    }

    public function get_site_url() {
        if(false !== strpos(site_url(), 'localhost')) {
            return self::LOCALHOST_URL;
        }

        return site_url();
    }

    public function tww_mp_remote_post($url) {
        if(!$this->api_key) {
            return new \WP_Error('api_key_missing', 'API key is missing', ['status' => 400]);
        }
        
        $response = wp_remote_post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'MEMBERPRESS-API-KEY' => $this->api_key,
            ]
        ]);

        return $response;
    }

    public function validate_subscription_is_active($id) {
        $mepr_db = \MeprDb::fetch();
        $active_subscription = $mepr_db->get_one_record($mepr_db->subscriptions, [
            'id' => $id, 
            'status' => 'active'
        ]);
  
        return $active_subscription !== null;
      }
}