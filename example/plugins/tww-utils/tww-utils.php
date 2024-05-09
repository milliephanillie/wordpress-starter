<?php
/**
 * Plugin Name: TWW Utils
 * Description: Custom utilities for TWW
 * Version: 1.0
 * Author: The Wellness Way
 * Author URI: https://www.thewellnessway.com
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: tww-utils
 */

class TWW_MpCreate {
    const NAMESPACE = 'tww/v1';

    private $routes = [
        'group' => [
            "methods" => "POST",
            "callback" => 'create_memberpressgroup_post',
            "path" => '/mp-import/group',
        ],
        'product' => [
            "methods" => "POST",
            "callback" => 'create_memberpressproduct_post',
            "path" => '/mp-import/product',
        ],
        'subscription' => [
            "methods" => "POST",
            "callback" => 'create_subscription',
            "path" => '/mp-import/subscription',
        ],
        'add-prd-to-group' => [
            "methods" => "POST",
            "callback" => 'add_product_to_group',
            "path" => '/mp-import/add-prd-to-group',
        ],
    ];

    public function __construct() {
        add_action('rest_api_init', [$this, 'register_routes']);
    }

    public function register_routes() { 
        foreach($this->routes as $route) {
            register_rest_route(self::NAMESPACE, $route['path'], [
                'methods' => $route['methods'],
                'callback' => [$this, $route['callback']],
                'permission_callback' => '__return_true',
            ]);
        }
    }

    /**
     * Callback that creates a memberpress subscription
     * 
     * @vars string $subscr_id* - A unique subscription number for this subscription. Only edit this if you absolutely have to. 
     * @vars string $product_id* - The membership that was purchased.
     * @vars string $user_id
     * @vars string $coupon
     * @vars string $price* - The sub-total (amount before tax) of this subscription
     * @vars string $total
     * @vars string $status* - The current status of the subscription
     * @vars string $tax_amount
     * @vars string $tax_reversal_amount
     * @vars string $tax_rate
     * @vars string $tax_desc
     * @vars string $tax_compound
     * @vars string $tax_shipping
     * @vars string $tax_class
     * @vars string $gateway
     * @vars string $response
     * @vars string $period
     * @vars string $period_type
     * 
     * @param WP_REST_Request $request
     * @return WP_REST_Response
     */
    public function create_subscription(\WP_REST_Request $request) {
        $params = $request->get_params();
        $subscr_id = $params['subscr_id'] ?? null;
    }

    /**
     * Creates a post with a memberpressproduct post type
     * postmeta keys:
     * - _mepr_product_price
     * - _mepr_product_period
     * - _mepr_product_period_type
     * - _mepr_product_signup_button_text - default is 'Sign Up'
     * - _mepr_product_limit_cycles
     * - _mepr_product_limit_cycles_num
     * - _mepr_product_limit_cycles_action - deafult is 'expire'
     * - _mepr_product_limit_cycles_expires_after - default is '1'
     * - _mepr_product_limit_cycles_expires_type - default is 'days'
     * - _mepr_group_id
     * @param WP_REST_Request $request
     * @return WP_REST_Response
     */
    public function create_memberpressproduct_post(\WP_REST_Request $request) {
        $params = $request->get_params();
        $period_type = $params['period_type'] ?? null;
        $period = $params['period'] ?? 1;
        $price = $params['price'] ?? null;
        $post_title = $params['post_title'] ?? null;

        $prd = new \MeprProduct();

        if(!in_array($period_type, $prd->period_types) || $period_type === 'lifetime') {
            return new \WP_Error('invalid-period-type', 'Invalid period type', ['status' => 400]);
        }

        if(!$period || !$price || !$post_title) {
            return new \WP_Error('missing-params', 'Missing required parameters', ['status' => 400]);
        }

        $prd->post_title = $post_title;
        $prd->price = $price;
        $prd->period = $period;
        $prd->period_type = $period_type;
        $prd->store();

        if(!$prd->ID) {
            return new \WP_Error('product-not-created', 'Product not created', ['status' => 500]);
        }

        return new \WP_REST_Response(['product_id' => $prd->ID], 200);
    }

    /**
     * Creates a memberpressgroup post
     * 
     * postmeta keys:
     * _mepr_group_is_upgrade_path - bool default is 0
     * 
     * @param WP_REST_Request $request
     * @return WP_REST_Response
     */
    public function create_memberpressgroup_post(\WP_REST_Request $request) {
        $params = $request->get_params();
        $post_title = $params['post_title'] ?? null;
        $group_is_upgrade_path = $params['group_is_upgrade_path'] ?? 0;
        $products_in_group = $params['products_in_group'] ?? null;

        if(!$post_title) {
            return new \WP_Error('no-post-title', 'No post title provided', ['status' => 400]);
        }

        if($products_in_group) {
            
        }

        if($group_is_upgrade_path && '0' !== $group_is_upgrade_path) {
            $group_is_upgrade_path = 1;
        }

        $group = new \MeprGroup();
        $group->post_title = $post_title;
        $group->is_upgrade_path = $group_is_upgrade_path;
        $group->store();

        if(!$group->ID) {
            return new \WP_Error('group-not-created', 'Group not created', ['status' => 500]);
        }

        $product_group_order = [];

        $prd_ids = [];
        if($products_in_group) {
            $prd_ids = $this->add_group_meta_to_products($group_id, $products_in_group);
        }

        return new \WP_REST_Response(['group_id' => $group->ID, 'prd_ids' => $prd_ids], 200);
    }

    public function add_product_to_group(\WP_REST_Request $request) {
        $params = $request->get_params();
        $group_name = $params['group_name'] ?? null;
        $products_in_group = $params['products_in_group'] ?? null;
        $group_is_upgrade_path = $params['group_is_upgrade_path'] ?? 0;

        if(!$group_name || !$products_in_group) {
            return new \WP_Error('missing-params', 'Missing required parameters', ['status' => 400]);
        }

        $query = new \WP_Query([
            'post_type' => 'memberpressgroup',
            'title' => 'TWW+',
        ]);

        if(!$query->have_posts()) {
            return new \WP_Error('group-not-found', 'Group not found', ['status' => 404]);
        }

        $group_id = $query->posts[0]->ID;

        if(!is_array($products_in_group)) {
            return new \WP_Error('invalid-products-in-group', 'Invalid products in group', ['status' => 400]);
        }

        $prd_ids = $this->add_group_meta_to_products($group_id, $products_in_group, $group_is_upgrade_path);

        return new \WP_REST_Response(['product_ids' => $prd_ids], 200);
    }

    public function add_group_meta_to_products($group_id, $products_in_group, $group_is_upgrade_path) {
        $this->validate_products_in_group($products_in_group);

        $prd_ids = [];

        $index = 1;
        foreach($products_in_group as $key => $product_title) {
            $query = new \WP_Query([
                'post_type' => 'memberpressproduct',
                'title' => $product_title,
            ]);

            if(!$query->have_posts()) {
                continue;
            }

            $product_id = $query->posts[0]->ID;

            $prd_id = $this->store_prd_group_meta($group_id, $product_id, $index, $group_is_upgrade_path);
            array_push($prd_ids, $prd_id);
            $index++;
        }

        return $prd_ids;
    }

    public function store_prd_group_meta($prd_id, $group_id, $index, $group_is_upgrade_path){
        if(!$prd_id || !$group_id) {
            return null;
        }

        $prd = new MeprProduct($prd_id);

        if($prd->ID) {
            $prd->group_id = $group_id;

            if($group_is_upgrade_path) {
                $prd->group_order = $index;
            }

            $prd->store_meta();
        }

        return $prd->ID;
    }

    /**
     * Validate associative array where the keys are the index integers
     * and the values are the product titles (that must exist in the db)
     * 
     */
    private function validate_products_in_group($products_in_group) {
        if(!is_array($products_in_group)) {
            return false;
        }

        foreach($products_in_group as $key => $product_title) {
            if(!is_int($key) || !is_string($product_title)) {
                return false;
            }

            $query = new \WP_Query([
                'post_type' => 'memberpressproduct',
                'title' => $product_title,
            ]);

            if(!$query->have_posts()) {
                return false;
            }
        }

        return true;
    }
}