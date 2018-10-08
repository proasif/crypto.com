<?php
/**
 * Template Name: Website Design
 *
 * The template for Website design
 *
 * This is the template that displays all Website design things.
 * @since 1.0
 * @version 1.0
 */
 
 ?>
 
 <!------------Header Module------------> 
 <?
 if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
get_header();
?>
<!------------Header Module Ends------------>

<!------------Main Module------------> 
 <div id="primary" class="p1-primary-max p1-body">
	<div id="content" role="main">
    
    
    <!------------Homepage Module------------> 
		<?php get_template_part( 'logic-parts/p1-homepage-featured' ); ?>
    <!------------Homepage Module Ends------------>
    
    
    <!------------Admin Panel Module------------> 
        <?php get_template_part( 'template-parts/panel/url-image-upload' ); ?>
    <!------------Admin Panel Module Ends------------> 
    
    
	</div><!-- #content -->
</div><!-- #primary -->
 
<!------------Main Module Ends------------> 


<!------------Footer Module------------> 
<?php
get_footer(); 
?>
<!------------Footer Module Ends------------>  
 
 
 
 
 
 