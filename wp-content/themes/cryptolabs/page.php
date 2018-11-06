<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
?>	

<?php
// Get Header
get_header();
?>

 <div id="primary" class="p1-primary-max">
	<div id="content" role="main">
		<?php
			while ( have_posts() ) : the_post();	
			
			the_content();

			endwhile; // End of the loop.
			?>
	</div><!-- #content -->
</div><!-- #primary -->
 
<?php 

// Get Footer
get_footer(); 