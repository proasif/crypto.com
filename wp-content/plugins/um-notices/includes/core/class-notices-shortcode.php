<?php
namespace um_ext\um_notices\core;

if ( ! defined( 'ABSPATH' ) ) exit;

class Notices_Shortcode {

	function __construct() {
	
		add_shortcode( 'ultimatemember_notice', array( &$this, 'ultimatemember_notice' ) );

	}
	
	/***
	***	@Shortcode
	***/
	function ultimatemember_notice( $args = array() ) {
		ob_start();

		echo '<div class="um-notices-shortcode">';
		UM()->Notices_API()->query()->show_notice( $args['id'] );
		echo '</div>';
		
		UM()->Notices_API()->shortcodes[ $args['id'] ] = 1;
		
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

}