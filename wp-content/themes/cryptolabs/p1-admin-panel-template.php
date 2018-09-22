<?php
/**
 * Template Name: Admin Panel
 *
 * The template for Admin Panel
 *
 * This is the template that displays all contents of Admin Panel.
 * @since 1.0
 * @version 1.0
 */
  // Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

get_header();
 ?>
 <div id="primary" class="p1-primary-max">
		<div id="content" role="main">
			<?php get_template_part( 'template-parts/panel/entire-admin-panel.php' ); ?>
		</div><!-- #content -->
	</div><!-- #primary -->
 <?php get_footer(); 
