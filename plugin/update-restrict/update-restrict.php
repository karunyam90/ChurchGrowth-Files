<?php
/*
Plugin Name: update restrict
Plugin URI: 
Description: 
Version: 
Author: 
Author URI: 
License: 
License URI: 
*/
function pw_rcp_custom_currency( $currencies ) {
	$currencies['INR'] = 'Rupee (₹)';
	return $currencies;
}
add_filter( 'rcp_currencies', 'pw_rcp_custom_currency' );