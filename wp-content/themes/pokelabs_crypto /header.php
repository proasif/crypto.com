<?php
/**
 * The Header for our theme.
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Crypto Theme | Pokelabs 1.0
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
?>
<!DOCTYPE html>
	<html>
    	<head>
        	<title>Crypto Hawk</title>
      		<?php 
				wp_head(); 
			?>
            <meta charset="<?php bloginfo( 'charset' ); ?>"/>
            <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
            
			<?php if (has_custom_logo())
						{
						 the_custom_logo();
						}
						else echo ("Put a logo"); 
					?>
        </head>
		<body <?php body_class(); ?>>
        <?php do_action( 'poke_body_start' ); ?>
     		<?php 
				wp_nav_menu();
				
			
			 ?>
    	