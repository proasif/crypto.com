<?php
/* =========== AJAX FUNCTIONS ========== */
add_action( 'wp_ajax_nopriv_load_more', 'load_more' );
add_action( 'wp_ajax_load_more', 'load_more' );



function load_more() {
	
	
	//$currentpage = get_query_var('paged');
		$custom_posts = new WP_Query( array(
			'post_type'=> 'airdrop',
			'order_by' => 'title',
			'order'    => 'desc',
			'posts_per_page' => 10,
			'paged' => $_POST["page"]+1,
			//'paged' => $currentpage
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
            
            
		<?php endif;
?>
	</div>
</div>
	<?php
	wp_reset_postdata();
	 die();
	
}

?>
<script>
var $star_rating = $('.star-rating .fa');

var SetRatingStar = function() {
  return $star_rating.each(function() {
    if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
      return $(this).removeClass('fa-star-o').addClass('fa-star');
    } else {
      return $(this).removeClass('fa-star').addClass('fa-star-o');
    }
  });
};

$star_rating.on('click', function() {
  $star_rating.siblings('input.rating-value').val($(this).data('rating'));
  return SetRatingStar();
});

SetRatingStar();
$(document).ready(function() {

});

</script>