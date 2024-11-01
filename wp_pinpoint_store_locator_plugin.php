<?php
/*
Plugin Name: Store Locator Software for Website
Plugin URI:  https://www.pinpointstorelocator.com/
Description: Advanced dealer, product, and store locator software. Free 20-days trial. Features integrated coupons, lead management, programmable API, and tools for engaging local store traffic. Store Locator software provide solutions for websites who have multiple store and want to show their location on their website (one place).
Version:     1.0.0
Author:      Pinpoint Store Locator Team
Author URI:  
*/
define('PINPOINT_PLUGIN_PATH', plugin_dir_path( __FILE__ ));

define('PINPOINT_LOADER_URL', plugin_dir_url( __FILE__ )."images/pinpoint-loading.gif");

add_action('admin_menu', 'pinpoint_setup_menu');

$pinPointFullPageURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .  
                $_SERVER['REQUEST_URI']; 


register_deactivation_hook( __FILE__, 'pinPointDeActivation' );
function pinPointDeActivation() {
	delete_option( 'pin_point_access_key');
}

function pinpoint_setup_menu(){
	add_menu_page( 'Pin Point Store Locator Software Admin', 'PinPoint Store Locator Software', 'manage_options', 'pin-point-store-locator', 'pin_point_store_locator_admin' );
}

function pin_point_store_locator_admin(){
	include(PINPOINT_PLUGIN_PATH."library/pinpoint-adminpage.php");
}
add_action( 'admin_init', 'pinpoint_admin_css' );
function pinpoint_admin_css() {
    wp_register_style('pinpoint-admin-style', plugins_url('css/pinpoint-admin.css', __FILE__));
	wp_enqueue_style('pinpoint-admin-style');
}

function showPinPointStoreLocator() { 
	wp_register_style('pinpoint-front-style', plugins_url('css/pinpoint-front.css', __FILE__));
	wp_enqueue_style('pinpoint-front-style');

	ob_start();
	include(PINPOINT_PLUGIN_PATH."templates/frontpage/showpinpointfrontend.php");
	return ob_get_clean();
}
add_shortcode('PIN_POINT_STORE_LOCATOR', 'showPinPointStoreLocator'); 

/*============ For front end AJAX call ======*/

function pinpoint_front_end_js() {
  wp_enqueue_script( 'pinpoint-frontend', plugins_url('/js/pinpoint_store_locator_frontend.js', __FILE__), array('jquery'), '1.0.0', true );
  wp_localize_script( 'pinpoint-frontend', 'PinpointAjax', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' )
  ));
}
add_action( 'wp_enqueue_scripts', 'pinpoint_front_end_js' );

function pinpoint_frontaction_callback() {
	include_once(PINPOINT_PLUGIN_PATH."library/frontpage/performaction.php");  	
  	die(); // this is required to return a proper result
}
add_action( 'wp_ajax_pinpoint_frontaction', 'pinpoint_frontaction_callback' );
add_action( 'wp_ajax_nopriv_pinpoint_frontaction', 'pinpoint_frontaction_callback' );
?>