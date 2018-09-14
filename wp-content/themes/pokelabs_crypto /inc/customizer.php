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
	












