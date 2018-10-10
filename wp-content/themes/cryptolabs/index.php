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
	
$signs = array();
$names = array();
if ( $currencies->have_posts() ) :
	while ( $currencies->have_posts() ) : $currencies->the_post(); 
	
		$sign = get_the_title();
		$signs[] = $sign;
		
		$pod = pods('currency', get_the_ID());
		$name = $pod->field('coin_name') . "(" . $sign . ")";
		$names[] = $name;
		
	endwhile;
endif;
	
print_r($names);
	
	// Get and Display Featured Custom Posts
	get_template_part( 'logic-parts/p1-homepage-featured' );
	
	?>
	</div><!-- #content -->
</div><!-- #primary -->
 
<?php 

// Get Footer
get_footer(); 