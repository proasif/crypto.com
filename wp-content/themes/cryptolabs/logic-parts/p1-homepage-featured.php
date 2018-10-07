<?php
/**
 * Template part for p1-homepage-featured.php
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
?>	

<div class="p1-section p1-style-curves p1-style-shadow">
	<div class="p1-featured">
		<h2>AirdropMonkey.com | Free Crypto Airdrops & More...</h2>
		<?php
		$custom_posts = new WP_Query( array(
			'order_by' => 'title',
			'order'    => 'desc',
			'posts_per_page' => 3,
		));

		if ( $custom_posts->have_posts() ) :
			while ( $custom_posts->have_posts() ) : $custom_posts->the_post(); 
				get_template_part( 'template-parts/display/featured-post', 'grid-display' );
			endwhile;
		endif;
		?>
	</div>
</div>