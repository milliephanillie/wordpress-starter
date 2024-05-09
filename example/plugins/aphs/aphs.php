<?php

	/*
	Plugin Name: Hover Sounds
	Plugin URI: http://codecanyon.net/user/Tean/portfolio
	Description: Play sounds on hover or click DOM elements.
	Version: 1.15
	Author: Tean
	Author URI: https://codecanyon.net/user/Tean/
	*/


	
	if(!defined('ABSPATH'))exit;
	define('APHS_CAPABILITY', 'manage_options');
	define('APHS_TEXTDOMAIN', 'aphs');
	define('APHS_BSF_MATCH', 'ebsfma');//encrypt media 

	include(dirname(__FILE__) . '/includes/utils.php');

	if(is_admin()){

		register_activation_hook(__FILE__, "aphs_player_activate"); 
		register_uninstall_hook(__FILE__, "aphs_player_uninstall"); 

		add_action("admin_menu", "aphs_admin_menu");
		add_action('admin_enqueue_scripts', 'aphs_admin_enqueue_scripts');
		add_action('plugins_loaded', 'aphs_plugins_loaded');

		add_action('wp_ajax_aphs_save_options', 'aphs_save_options');

		add_action('init', 'aphs_init_setup');
		
	}else{

		add_action('wp_enqueue_scripts', 'aphs_enqueue_scripts');

		add_action('init', 'aphs_init_frontend');

	}

	function aphs_init_frontend() {

		//options
		$current_options = get_option('aphs_player_options');
		$default_options = aphs_getOptions();
		$options = $current_options + $default_options;

		if($options['overrideWpAudio']){
	    	add_filter('wp_audio_shortcode_override', 'aphs_audio_shortcode_override', 10, 2);
	    	add_filter('the_content', 'aphs_disable_wp_auto_p', 0 );
	    }
	}

	function aphs_init_setup() {

	    // Add only in Rich Editor mode
        if ('true' == get_user_option('rich_editing')) {
            // filter the tinyMCE buttons and add our own
            add_filter('mce_external_plugins', 'aphs_add_shortcode_editor');
            add_filter('mce_buttons', 'aphs_register_shortcode_editor', -1000);
            add_action('wp_ajax_aphs_shortcode_editor', 'aphs_shortcode_editor');

        } 

    }


    // registers the buttons for use
    function aphs_register_shortcode_editor($buttons) {
        array_push($buttons, '|', 'aphs_shortcode_editor');
        return $buttons;
    }

	function aphs_shortcode_editor(){
		include 'aphs-shortcode-editor.php';
		die();
	}

	// adds the button to the tinyMCE bar
	function aphs_add_shortcode_editor($plugin_array){
		$plugin_array['aphs_shortcode_editor'] = plugins_url('js/aphs-shortcode-editor.js', __FILE__);
		return $plugin_array;
	}


    function aphs_disable_wp_auto_p( $content ) {
	    remove_filter( 'the_content', 'wpautop' );
	    remove_filter( 'the_excerpt', 'wpautop' );
	    return $content;
	}

	function aphs_audio_shortcode_override( $html, $attr ) {

		if (isset( $attr['wav']) || isset( $attr['mp3']) || isset( $attr['m4a']) || isset( $attr['ogg']) || isset( $attr['src'])){

			if($attr['wav'])$url = $attr['wav'];
			else if($attr['mp3'])$url = $attr['mp3'];
			else if($attr['m4a'])$url = $attr['m4a'];
			else if($attr['ogg'])$url = $attr['ogg'];
			else if($attr['src'])$url = $attr['src'];

			//options
			$current_options = get_option('aphs_player_options');
			$default_options = aphs_getOptions();
			$options = $current_options + $default_options;

			//additional classes
			$add_class = '';
		    if(isset($atts['class']))$add_class = ' '.$atts['class'];
		    else if(isset($options['overrideWpAudioClass']))$add_class = ' '.$options['overrideWpAudioClass'];

			
			return '<div class="aphs-toggle-button'.$add_class.'" data-hover-sound="'.esc_attr($url).'" >
	    		<img class="aphs-play" src="'.esc_attr($options['togglePlayIcon']).'" alt="" />
	    		<img class="aphs-pause" src="'.esc_attr($options['togglePauseIcon']).'" alt="" />
	    	</div>';

		}else{
			return "";
		}

	};
	
	function aphs_admin_menu(){

		add_menu_page("Hover sounds", "Hover sounds", APHS_CAPABILITY, "aphs_settings", "aphs_settings_page", plugins_url('/css/icon.png', __FILE__));

		add_submenu_page("aphs_settings", "Hover sounds", "Hover sounds", APHS_CAPABILITY, 'aphs_settings');	

	}

	function aphs_settings_page(){

		include("includes/settings.php");

	}

	function aphs_admin_enqueue_scripts() {

		wp_enqueue_script('jquery');
		wp_enqueue_media();

		wp_enqueue_style("codemirror", plugins_url('/css/codemirror.min.css', __FILE__));
		wp_enqueue_script("codemirror", plugins_url('/js/codemirror.min.js', __FILE__));	

		wp_enqueue_style('aphs-admin', plugins_url('/css/admin.css', __FILE__));	
		wp_enqueue_script('aphs-admin', plugins_url('/js/admin.js', __FILE__), array('jquery'));


		if(get_option('aphs_player_options')){
			$current_options = get_option('aphs_player_options');
			$default_options = aphs_getOptions();
			$aphs_player_options = $current_options + $default_options;
		}else{
			$aphs_player_options = aphs_getOptions();
		}

		wp_localize_script('aphs-admin', 'aphs_data', array('plugins_url' => plugins_url('', __FILE__), 
															 'ajax_url' => admin_url( 'admin-ajax.php'),
															 'options' => json_encode($aphs_player_options),
															 'security'  => wp_create_nonce( 'aphs-security-nonce'))); 
	}

	function aphs_enqueue_scripts() {

	    wp_enqueue_script('jquery');

		wp_enqueue_style('aphs-style', plugins_url('/source/css/aphs.css', __FILE__));//main css
		wp_enqueue_script('aphs', plugins_url('/source/js/new.js', __FILE__), array('jquery'));//main js


		if(get_option('aphs_player_options')){
			$current_options = get_option('aphs_player_options');
			$default_options = aphs_getOptions();
			$aphs_player_options = $current_options + $default_options;
		}else{
			$aphs_player_options = aphs_getOptions();
		}

        if($aphs_player_options['customCss']){
		    $custom_css = aphs_compressCss($aphs_player_options['customCss']);
	        wp_add_inline_style( 'aphs-style', $custom_css );
		}

		wp_localize_script('aphs', 'aphs_player_options', array('options' => json_encode($aphs_player_options))); 

	}

	//############################################//
	/* save options */
	//############################################//

	function aphs_save_options(){

		if ( ! check_ajax_referer( 'aphs-security-nonce', 'security' ) ) {
		    wp_send_json_error( 'Invalid security token sent.' );
		    wp_die();
		}

		if(isset($_POST['player_options'])){

			$options = json_decode(wp_kses_stripslashes($_POST['player_options']), true);

			update_option('aphs_player_options', $options);
		 
		 	echo json_encode('SUCCESS');

			wp_die();

		}else{
			wp_die();
		}	
	}

	// shortcode 
	add_shortcode('aphs', "aphs_sound");

	function aphs_sound($atts, $content = null){


		//options
		$current_options = get_option('aphs_player_options');
		$default_options = aphs_getOptions();
		$options = $current_options + $default_options;



		$markup = '';

		/*if(!isset($GLOBALS['aphs_optionsAdded'])){
	        $GLOBALS['aphs_optionsAdded'] = 'yes';

	        if($options['customCss']){

			    $markup .= '<script>';
				    
			        $markup .= 'var htmlDivCss = "'.aphs_compressCss($options['customCss']).'";
			        var htmlDiv = document.getElementById("aphs-inline-css");
			        if(htmlDiv){
			            htmlDiv.innerHTML = htmlDivCss;
			        }else{
			            var htmlDiv = document.createElement("div");
			            htmlDiv.innerHTML = "<style id=\'aphs-inline-css\'>" + htmlDivCss + "</style>";
			            document.getElementsByTagName("head")[0].appendChild(htmlDiv.childNodes[0]);
			        }';

				$markup .= '</script>';

			}

	    }*/



	    $add_class = '';
	    if(isset($atts['class']))$add_class = ' '.$atts['class'];//additional classes

	    $start = null;
	    if(isset($atts['start']))$start = $atts['start'];
	    $end = null;
	    if(isset($atts['end']))$end = $atts['end'];

	    //predefined shapes
	    if(isset($atts['type'])){

	    	if($atts['type'] == 'toggle_button' && isset($atts['url'])){

	    		$url = APHS_BSF_MATCH.base64_encode($atts['url']);

	    		$toggle_play_icon = isset($atts['toggle_play_icon']) ? $atts['toggle_play_icon'] : $options['togglePlayIcon'];
	    		$toggle_pause_icon = isset($atts['toggle_pause_icon']) ? $atts['toggle_pause_icon'] : $options['togglePauseIcon'];

	    		$markup .= '<div class="aphs-toggle-button'.$add_class.'" data-hover-sound="'.esc_attr($url).'"';

	    			if($start) $markup .= ' data-start="'.esc_attr($start).'"';
	    			if($end) $markup .= ' data-end="'.esc_attr($end).'"';

	    			$markup .= '>';

		    		$markup .= '<img class="aphs-play" src="'.esc_attr($toggle_play_icon).'" alt="" />
		    		<img class="aphs-pause" src="'.esc_attr($toggle_pause_icon).'" alt="" />

	    		</div>';

	    	}
	    	else if($atts['type'] == 'image_with_volume' && isset($atts['image_url']) && isset($atts['url'])){

	    		$image_url = $atts['image_url'];

	    		$url = APHS_BSF_MATCH.base64_encode($atts['url']);

	    		$volume_off_icon = isset($atts['volume_off_icon']) ? $atts['volume_off_icon'] : $options['volumeOffIcon'];
	    		$volume_on_icon = isset($atts['volume_on_icon']) ? $atts['volume_on_icon'] : $options['volumeOnIcon'];

	    		$markup .= '<div class="aphs-image-wrap'.$add_class.'" data-hover-sound="'.esc_attr($url).'"';

	    			if($start) $markup .= ' data-start="'.esc_attr($start).'"';
	    			if($end) $markup .= ' data-end="'.esc_attr($end).'"';

	    			$markup .= '>';

	    			$markup .= '<img class="aphs-image" src="'.$image_url.'" alt="" />

		    		<div class="aphs-volume-button">
			    		<img class="aphs-play" src="'.esc_attr($volume_off_icon).'" alt="" />
			    		<img class="aphs-pause" src="'.esc_attr($volume_on_icon).'" alt="" />
		    		</div>

	    		</div>';

	    	}
	    	else if($atts['type'] == 'speech_slow' && isset($atts['url']) && isset($atts['url_slow'])){

	    		$url = APHS_BSF_MATCH.base64_encode($atts['url']);
	    		$url_slow = APHS_BSF_MATCH.base64_encode($atts['url_slow']);

	    		$speech_icon = isset($atts['speech_icon']) ? $atts['speech_icon'] : $options['speechIcon'];
	    		$speech_slow_icon = isset($atts['speech_slow_icon']) ? $atts['speech_slow_icon'] : $options['speechSlowIcon'];

	    		$markup .= '<div class="aphs-speech-wrap'.$add_class.'"';

	    			if($start) $markup .= ' data-start="'.esc_attr($start).'"';
	    			if($end) $markup .= ' data-end="'.esc_attr($end).'"';

	    			$markup .= '>';

	    			$markup .= '<div class="aphs-speech" data-hover-sound="'.esc_attr($url).'">
		    			<img class="aphs-speech-icon" src="'.esc_attr($speech_icon).'" alt="" />
		    		</div>
		    		<div class="aphs-speech" data-hover-sound="'.esc_attr($url_slow).'">
		    			<img class="aphs-speech-icon" src="'.esc_attr($speech_slow_icon).'" alt="" />
		    		</div>

	    		</div>';

	    	}
	    	else if($atts['type'] == 'speech_aid' && isset($atts['url']) && isset($atts['url_sign'])){

	    		$url = APHS_BSF_MATCH.base64_encode($atts['url']);
	    		$url_sign = APHS_BSF_MATCH.base64_encode($atts['url_sign']);

	    		$speech_icon = isset($atts['speech_icon']) ? $atts['speech_icon'] : $options['speechIcon'];
	    		$speech_aid_icon = isset($atts['speech_aid_icon']) ? $atts['speech_aid_icon'] : $options['speechAidIcon'];

	    		$markup .= '<div class="aphs-speech-wrap'.$add_class.'"';

	    			if($start) $markup .= ' data-start="'.esc_attr($start).'"';
	    			if($end) $markup .= ' data-end="'.esc_attr($end).'"';

	    			$markup .= '>';

	    			$markup .= '<div class="aphs-speech" data-hover-sound="'.esc_attr($url).'">
		    			<img class="aphs-speech-icon" src="'.esc_attr($speech_icon).'" alt="" />
		    		</div>
		    		<div class="aphs-speech aphs-speech-aid" data-hover-sound="'.esc_attr($url_sign).'">
		    			<img class="aphs-speech-icon" src="'.esc_attr($speech_aid_icon).'" alt="" />
		    		</div>

	    		</div>';

	    	}

	    }else if(isset($atts['id']) && isset($atts['url'])){

			$id = $atts['id'];
			$url = $atts['url'];
		
            $id_array = explode( ',', $id );
            $url_array = explode( ',', $url ); 

            if(count($id_array) != count($url_array))return "Hover sound shortcode needs to contain the same amount of id and url parameters! (you need one sound url for each id attribute)";

            $i = 0;
	        foreach($id_array as $k => $v){ 

	        	$url = APHS_BSF_MATCH.base64_encode($url_array[$i]);

				$markup .= '<div class="aphs-sound'.$add_class.'" data-id="'.esc_attr($v).'" data-hover-sound="'.esc_attr($url).'"></div>';

				$i++;
	        }

		}else if(isset($atts['class']) && isset($atts['url'])){

			$class = $atts['class'];
			$url = $atts['url'];
		
            $class_array = explode( ',', $class );
            $url_array = explode( ',', $url ); 

            if(count($class_array) != count($url_array))return "Hover sound shortcode needs to contain the same amount of id and url parameters! (you need one sound url for each id attribute)";

            $i = 0;
	        foreach($class_array as $k => $v){ 

	        	$url = APHS_BSF_MATCH.base64_encode($url_array[$i]);

				$markup .= '<div class="aphs-sound'.$add_class.'" data-class="'.esc_attr($v).'" data-hover-sound="'.esc_attr($url).'"></div>';

				$i++;
	        }

		}

		//aphs_debug_to_console($markup);

		if(!empty($content))$markup .= do_shortcode($content);

		return $markup;

	}




	//############################################//
	/* activation */
	//############################################//

	function aphs_player_uninstall($networkwide) {
		
		global $wpdb;

	    if (is_multisite()) {
	        if ($networkwide) {
	            $old_blog = $wpdb->blogid;
	            // Get all blog ids
	            $blogids = $wpdb->get_col($wpdb->prepare("SELECT blog_id FROM $wpdb->blogs"));
	            foreach ($blogids as $blog_id) {
	                switch_to_blog($blog_id);
	                aphs_deinstall();
	            }
	            switch_to_blog($old_blog);
	            return;
	        }  
	    }
	    
	    aphs_deinstall();
	    
	}

	function aphs_deinstall(){

		delete_option('aphs_player_options');

		delete_option('aphs_version');

	}

	function aphs_player_activate(){

		global $wpdb;

		if ( is_multisite() ) {
    		if (isset($_GET['networkwide']) && ($_GET['networkwide'] == 1)) {
                $current_blog = $wpdb->blogid;
    			// Get all blog ids
    			$blogids = $wpdb->get_col($wpdb->prepare("SELECT blog_id FROM $wpdb->blogs"));
    			foreach ($blogids as $blog_id) {
    				switch_to_blog($blog_id);
    				aphs_install();
    			}
    			switch_to_blog($current_blog);
    			return;
    		}
    	}

		aphs_install();

	}

	function aphs_getOptions(){

		return array(

        	//playback
            "playbackMethod" => "hover",
            "rewindOnHover" => false,
            "loop" => true,
            "playbackRate" => 1,
            "overrideWpAudio" => false,
            "allowMultipleSoundsAtOnce" => false,
            "overrideWpAudioClass" => "",
            "useGa" => "",
            "gaTrackingId" => "",
            

            //icons
			"togglePlayIcon" => plugins_url('/aphs/css/play.png'),
			"togglePauseIcon" => plugins_url('/aphs/css/pause.png'),

			"inlinePlayIcon" => plugins_url('/aphs/css/inline_play.png'),
			"inlinePauseIcon" => plugins_url('/aphs/css/inline_pause.png'),

			"volumeOffIcon" => plugins_url('/aphs/css/volume_off.png'),
			"volumeOnIcon" => plugins_url('/aphs/css/volume_on.png'),

			"speechIcon" => plugins_url('/aphs/css/speaker.png'),
			"speechSlowIcon" => plugins_url('/aphs/css/snail.png'),
			"speechAidIcon" => plugins_url('/aphs/css/hearing-aid.png'),
	
            //custom css
            "customCss" => "",

     
		);

	}

	function aphs_install(){

		//settings

        $options = aphs_getOptions();
	
		add_option('aphs_player_options', $options);


		global $wpdb;
		$wpdb->show_errors(); 
		$charset_collate = $wpdb->get_charset_collate();
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$tour_table = $wpdb->prefix . "apvr_tours";
		if($wpdb->get_var( "show tables like '$tour_table'" ) != $tour_table){

			$sql = "CREATE TABLE $tour_table ( 
				`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			    `title` varchar(70) NOT NULL,
			    `options` longtext DEFAULT NULL,
			    `custom_css` longtext DEFAULT NULL,
			    PRIMARY KEY (`id`)
			) $charset_collate;";
			dbDelta( $sql );

		}
	
	}

	function aphs_plugins_loaded() {

		load_plugin_textdomain(APHS_TEXTDOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');

	    $current_version = get_option('aphs_version');

	    if($current_version == FALSE){
	    	add_option('aphs_version', '1.0');
	    }

	    $current_version = get_option('aphs_version');

	    if($current_version == '1.0'){
			update_option('aphs_version', '1.05');	
			$current_version = get_option('aphs_version');	
		}

		update_option('aphs_version', '1.15');	


	}


?>