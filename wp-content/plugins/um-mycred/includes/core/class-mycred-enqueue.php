<?php
namespace um_ext\um_mycred\core;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

class myCRED_Enqueue {

	function __construct() {
	
		add_action( 'wp_enqueue_scripts',  array( &$this, 'wp_enqueue_scripts' ), 0 );
	
	}

	function wp_enqueue_scripts(){
		
		wp_register_style( 'um_mycred', um_mycred_url . 'assets/css/um-mycred.css' );
		wp_enqueue_style( 'um_mycred' );
		
		wp_register_script( 'um_mycred', um_mycred_url . 'assets/js/um-mycred.js', '', '', true );
		wp_enqueue_script( 'um_mycred' );
		
	}
	
}