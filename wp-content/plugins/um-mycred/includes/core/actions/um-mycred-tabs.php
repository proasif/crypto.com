<?php
if ( ! defined( 'ABSPATH' ) ) exit;


	/***
	***	@display badges in header
	***/
	add_action('um_after_profile_header_name', 'um_mycred_show_badges_header');
	function um_mycred_show_badges_header() {
		if ( ! UM()->options()->get('mycred_show_badges_in_header') ) return;
		echo UM()->myCRED_API()->show_badges( um_profile_id() );
	}

	/***
	***	@default badges tab
	***/
	add_action('um_profile_content_badges_default', 'um_profile_content_badges_default');
	function um_profile_content_badges_default( $args ) {
		echo UM()->myCRED_API()->show_badges( um_profile_id() );
	}
	
	/***
	***	@show user badges
	***/
	add_action('um_profile_content_badges_my_badges', 'um_profile_content_badges_my_badges');
	function um_profile_content_badges_my_badges( $args ) {
		echo UM()->myCRED_API()->show_badges( um_profile_id() );
	}
	
	/***
	***	@show all badges
	***/
	add_action('um_profile_content_badges_all_badges', 'um_profile_content_badges_all_badges');
	function um_profile_content_badges_all_badges( $args ) {
		echo UM()->myCRED_API()->show_badges_all(2);
	}