<?php
add_action( 'wp_enqueue_scripts', 'my_plugin_add_stylesheet' );
function my_plugin_add_stylesheet() {
    wp_enqueue_style( 'my-style', get_stylesheet_directory_uri() . '/style.css', false, '1.0', 'all' );
}
function load_js_assets() {
    wp_enqueue_script('extra js', 'https://mylogin.churchgrowthfollowupministry.org/wp-content/themes/nevochild/validation.js',array(), false, true);
}
add_action('wp_enqueue_scripts', 'load_js_assets');

add_action( 'wp_enqueue_scripts', 'tthq_add_custom_fa_css' );

function tthq_add_custom_fa_css() {
wp_enqueue_style( 'custom-fa', 'https://use.fontawesome.com/releases/v5.0.6/css/all.css' );
}

//Different menu function
function my_wp_nav_menu_args( $args = '' ) {
 
    if( is_user_logged_in() ) { 
        $args['menu'] = 'mysecond';
    } else { 
        $args['menu'] = 'myfirst';
    } 
        return $args;
    }
    add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );

    // Custom redirect after logout
    add_action('wp_logout','auto_redirect_after_logout');

function auto_redirect_after_logout(){
  wp_safe_redirect( home_url() );
  exit;
}

//Restrict content pro Url change


add_filter( 'rcp_login_redirect_url', __NAMESPACE__ . '\\login_redirect', PHP_INT_MAX, 2 );
/**
 * @param string $redirect URL to redirect user to.
 * @param object $user WP_User object
 *
 * @return mixed
 */
function login_redirect( $redirect, $user ) {

	$logged_in_user = get_userdata( $user->ID );

	if ( ! isset( $logged_in_user->roles ) || ! is_array( $logged_in_user->roles ) ) {
		wp_die( 'You have no role assigned.' );
	}

	$redirects = [
		/**
		 * If there is no explicit 'redirect_to' given, each role
		 * will fallback to the following ordered redirects upon
		 * logging in.
		 *
		 * role => redirect
		 */
		'administrator' => admin_url(),
		'subscriber'    => home_url( 'welcome' ),
	];

	// Fallback to user role default redirect.
	foreach ( $redirects as $role => $redirect ) {
		if ( in_array( $role, $logged_in_user->roles ) ) {
			return $redirect;
		}
	}

	// No fallback found for role, so proceed as normal.
	return $redirect;
}