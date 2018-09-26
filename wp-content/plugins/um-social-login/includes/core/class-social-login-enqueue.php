<?php
namespace um_ext\um_social_login\core;

if ( ! defined( 'ABSPATH' ) ) exit;

class Social_Login_Enqueue {

	function __construct() {
	
		add_action( 'wp_enqueue_scripts',  array( &$this, 'wp_enqueue_scripts' ), 9 );
		add_action( 'admin_enqueue_scripts',  array( &$this, 'admin_enqueue_scripts' ), 9 );

	}


	/***
	***	@styles
	***/
	function wp_enqueue_scripts() {
		
		wp_register_style('um_social_login', um_social_login_url . 'assets/css/um-social-connect.css', array(), um_social_login_version );
		wp_enqueue_style('um_social_login');
		
		wp_register_script('um_social_login', um_social_login_url . 'assets/js/um-social-connect.js', array('jquery', 'wp-util'), um_social_login_version, true );
		wp_enqueue_script('um_social_login');

		wp_register_script('um_facebook_fix', um_social_login_url . 'assets/js/um-facebook-fix.js', array(), um_social_login_version, true );
		wp_enqueue_script('um_facebook_fix');
		
	}


	function admin_enqueue_scripts() {

		wp_register_script('um_facebook_fix', um_social_login_url . 'assets/js/um-facebook-fix.js', array(), um_social_login_version, true );
		wp_enqueue_script('um_facebook_fix');

	}

}