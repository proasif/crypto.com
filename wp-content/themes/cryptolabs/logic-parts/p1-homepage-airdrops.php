<?php
/**
 * Template part for p1-homepage-airdrops.php
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
?>	
<div class="p1-section p1-style-curves p1-style-shadow">
	<div class="p1-airdrop">
<?php	
		$currentpage = get_query_var('paged');
		$custom_posts = new WP_Query( array(
			'post_type'=> 'airdrop',
			'order_by' => 'title',
			'order'    => 'desc',
			'posts_per_page' => 10,
			'paged' => $currentpage
		));
		
		if ( $custom_posts->have_posts() ) :
			while ( $custom_posts->have_posts() ) : $custom_posts->the_post(); ?>
            <div class="p1-airdrop-item">
            <?php
			$thumb_id = get_post_thumbnail_id();
			$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
			$thumb_url[] =  $thumb_url_array;
			$sign = get_the_title();
			$pod = pods('airdrop', get_the_ID());
			$name = wp_get_attachment_image ($thumb_id) . " " . 
				    $pod->field('airdrop_name') . " " . 
					"(" . $sign . ")" . " " . 
					$pod->field('airdrop_value') . " " . 
					'<div class="star-rating">
						<span class="fa fa-star-o" data-rating="1"></span>
						<span class="fa fa-star-o" data-rating="2"></span>
						<span class="fa fa-star-o" data-rating="3"></span>
						<span class="fa fa-star-o" data-rating="4"></span>
						<span class="fa fa-star-o" data-rating="5"></span>
						<input type="hidden" name="whatever1" class="rating-value" value="2.56">
      				</div>
	  				</br></br>' ; 
			
			?> <h1> <?php echo $name; ?> </h1> <?php
			
			$requires = "";
			if ($pod->field('telegram_required') == true){
				 $requires = $requires . " " . '<div class="icon icon-paper-plane"></div>';
				}
			if ($pod->field('twitter_required') == true){
				$requires = $requires . " " . '<div class="class="icon-twitter"></div></br>';
				}
			if ($pod->field('facebook_required') == true){
				$requires = $requires . " " . '<div class="icon-facebook"></div></br>';
				}
			if ($pod->field('e-mail_required') == true){
				$requires = $requires . " " . '<div class="icon-envelope"></div></br>';
				}
			if ($pod->field('reddit_required') == true){
				$requires = $requires . " " . '<div class="icon-reddit"></div></br>';
				}
			if ($pod->field('instagram_required') == true){
				$requires = $requires . " " . '<div class="icon-instagrem"></div></br>';
				}
			if ($pod->field('youtube_required') == true){
				$requires = $requires . " " . '<div class="icon-youtube"></div></br>';
				}
			if ($pod->field('medium_required') == true){
				$requires = $requires . " " . '<div class="icon-medium"></div></br>';
				}
			if ($pod->field('phone_required') == true){
				$requires = $requires . " " . '<div class="icon-phone"></div></br>';
				}
			if ($pod->field('linkedin_required') == true){
				$requires = $requires . " " . '<div class="icon-linkedin"></div></br>';
				}
			if ($pod->field('discord_required') == true){
				$requires = $requires . " " . '<div class="icon-flickr"></div></br>';
				}
				echo ("Requires: ");
				echo $requires;
			?></div><?php
			endwhile; ?>
            
            <?php
            echo paginate_links(array(
            'total' => $custom_posts -> max_num_pages
			));
			?>
		<?php endif;
?>
	</div>
</div>
