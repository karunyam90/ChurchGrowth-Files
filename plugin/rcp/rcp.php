<?php
/*
Plugin Name: rcp
Plugin URI: 
Description: 
Version: 
Author: 
Author URI: 
License: 
License URI: 
*/
<?php if( ! is_user_logged_in() ) { ?>

	<div class="rcp_login_link">
		<p><?php printf( __( '<a href="https://mylogin.churchgrowthfollowupministry.org/">Log in</a> to renew or change an existing membership.','rcp' )); ?> </p>
	</div>
<?php } ?>