<?php
/**
 * The Template for displaying archive pages.
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package CryptoPokeLabs_Theme 5.4
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

// Get Header
get_header();
?>

 <div id="primary" class="p1-primary-max p1-body">
	<div id="content" role="main"> 
    <?php
	if(have_posts() ):
		while( have_posts() ): the_post(); ?>
        <?php get_template_part('template-parts/display/airdrop-post', 'display-copy'); ?>
        
        <?php endwhile;
		
		endif;
	
	?> 
	</div><!-- #content -->
</div><!-- #primary -->
	<!-- Return to Top -->
	<a href="javascript:" id="return-to-top"><div class="icon-chevron-circle-up"></div></a> 
 		
 
<?php 

// Get Footer
get_footer(); 