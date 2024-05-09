<?php

namespace AgileStoreLocator\Vendors\Elementor;


use AgileStoreLocator\Vendors\Elementor\Widget;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Agile Store Locator Elementor Addon
 */
class Addon {
    
    /**
     * Agile Store Locator Elementor Addon constructor.
     */
    public function __construct() {

        add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_registered' ) );
    }

    /**
     * Register widget
     */
    public function widgets_registered() {

        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widget());
    }
}
