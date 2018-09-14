<?php

function ju_customize_register( $wp_customize ){
	$wp_customize->add_setting( 'header_bg_color', array(
	
	'default'						=> '#4285f4',
	'transport'						=> 'refresh'
	) );
	
	$wp_customize->add_section( 'ju_color_theme_section', array(
	'title'					=> __( 'Header', 'crypto' ),
	'priority'				=> 	30
	));
	
	$wp_customize->add_control( new WP_Customize_color_control($wp_customize, 'theme_colors', array(
	'label'					=> __( 'Header Color', 'crypto' ),
	'section'				=> 'ju_color_theme_section',
	'settings'				=> 'header_bg_color',
	
	)) );

}
function m1_customize_register( $wp_customize ) {
	
	$wp_customize->add_setting( 'm1_logo' ); // Add setting for logo uploader
   
	$wp_customize->add_section( 'ju_color_theme_section', array(
	'title'					=> __( 'Header', 'crypto' ),
	'priority'				=> 	10
	));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'm1_logo', array(
        'label'    => __( 'Upload Logo (replaces text)', 'm1' ),
        'section'  => 'ju_color_theme_section',
        'settings' => 'm1_logo',
    ) ) );
	
	}
	function m2_customize_register( $wp_customize2 ) {
	
	$wp_customize2->add_setting( 'm2_logo' ); // Add setting for logo uploader
   
	$wp_customize2->add_section( 'theme_footer_section', array(
	'title'					=> __( 'Footer', 'crypto' ),
	'priority'				=> 	100
	));
    $wp_customize2->add_control( new WP_Customize_Image_Control( $wp_customize2, 'm2_logo', array(
        'label'    => __( 'Upload Cloud_Image (replaces text)', 'm2' ),
        'section'  => 'theme_footer_section',
        'settings' => 'm2_logo',
		
    ) ) );
	
	}
	function m3_customize_register( $wp_customize3 ) {
	
	$wp_customize3->add_setting( 'm3_logo' ); // Add setting for logo uploader
   
	$wp_customize3->add_section( 'theme_footer_section', array(
	'title'					=> __( 'Footer', 'crypto' ),
	'priority'				=> 	100
	));
    $wp_customize3->add_control( new WP_Customize_Image_Control( $wp_customize3, 'm3_logo', array(
        'label'    => __( 'Upload BG_Image (replaces text)', 'm3' ),
        'section'  => 'theme_footer_section',
        'settings' => 'm3_logo',
		
    ) ) );
	
	}
	function m4_customize_register( $wp_customize4 ) {
	
	$wp_customize4->add_setting( 'm4_logo' ); // Add setting for logo uploader
   
	$wp_customize4->add_section( 'theme_footer_section', array(
	'title'					=> __( 'Footer', 'crypto' ),
	'priority'				=> 	100
	));
    $wp_customize4->add_control( new WP_Customize_Image_Control( $wp_customize4, 'm4_logo', array(
        'label'    => __( 'Upload FG_Image (replaces text)', 'm4' ),
        'section'  => 'theme_footer_section',
        'settings' => 'm4_logo',
		
    ) ) );
	
	}
	












