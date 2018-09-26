<?php
namespace um_ext\um_notices\core;

if ( ! defined( 'ABSPATH' ) ) exit;

class Notices_Enqueue {

	function __construct() {

		add_action('wp_enqueue_scripts',  array(&$this, 'wp_enqueue_scripts'), 0);

        add_filter( 'um_enqueue_localize_data',  array( &$this, 'localize_data' ), 10, 1 );

	}


    function localize_data( $data ) {

        $data['notices_mark_notice_seen'] = UM()->get_ajax_route( 'UM_Notices_API', 'ajax_mark_notice_seen' );

        return $data;

    }


	/***
	***	@enqueue
	***/
	function wp_enqueue_scripts() {

		wp_register_style('um_notices', um_notices_url . 'assets/css/um-notices.css' );
		wp_enqueue_style('um_notices');

		wp_register_script('um_notices', um_notices_url . 'assets/js/um-notices.js', '', '', true );
		wp_enqueue_script('um_notices');

	}
	
}