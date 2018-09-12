<?php
/**
 * The Header for our theme.
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme 5.4
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
?><!DOCTYPE html>
<!--[if IE 8]>
<html class="no-js lt-ie10 lt-ie9" id="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9]>
<html class="no-js lt-ie10" id="ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if !IE]><!-->
<html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>"/>
        <link rel="profile" href="http://gmpg.org/xfn/11"/>
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
    
        <?php wp_head(); ?>
    
		<?php if (has_custom_logo())
                    {
                     the_custom_logo();
                    }
                    else echo ("Put a logo"); 
        ?>
        
        <?php 
			$menu = clean_custom_menu( "primary", true, "p1-main-nav", true, "", "", "");
			echo $menu;
			
			
		?>
        
    </head>
		
    <body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
		  <?php do_action( 'poke_body_start' ); ?>
    