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
    get_template_part( 'logic-parts/p1-homepage-featured' );
	?>
    <?php
	
$signs = array();
$names = array();
$args = array('posts_per_page' => 10);
query_posts($args);
$count = 0;
if ( $currencies->have_posts() ) :
	while ( $currencies->have_posts() ) : $currencies->the_post(); 
		$thumb_id = get_post_thumbnail_id();
		$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
		$thumb_url[] =  $thumb_url_array;
		$sign = get_the_title();
		$signs[] = $sign;
		
		$pod = pods('currency', get_the_ID());
		$name = wp_get_attachment_image ($thumb_id) . $pod->field('coin_name') . " " . "(" . $sign . ")" . "</br>"; 
		echo ($name);
		$names[] = $name;
    	$count++;
 		if ($count == 10)
		break;
	endwhile; ?>
	
	<div class="p1-section" align="left">
         <?php next_post_link('<< Older Coins'); ?>
        </div>
    	
        <div class="p1-section" align="right">
         <?php previous_post_link(' Newer Coins >>'); ?>
        </div>
   <?php
endif;
	wp_reset_query();
	// Get and Display Featured Custom Posts
	
	
	?>
	</div><!-- #content -->
</div><!-- #primary -->
 
<?php 

// Get Footer
get_footer(); 