<?php
/* =========== AJAX FUNCTIONS ========== */
add_action( 'wp_ajax_nopriv_load_more', 'load_more' );
add_action( 'wp_ajax_load_more', 'load_more' );


?>
<!-------------- p1-section p1-style-curves p1-style-shadow STARTS -------------->
<div class="p1-section p1-style-curves p1-style-shadow">

<!-------------- p1-airdrop STARTS -------------->
	<div class="p1-airdrop">
<?php
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
            
            <!-------------- p1-airdrop-item STARTS --------------> 
            <div class="p1-airdrop-item">
            <?php
			$thumb_id = get_post_thumbnail_id();
			$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
			$thumb_url[] =  $thumb_url_array;
			$sign = get_the_title();
			$pod = pods('airdrop', get_the_ID());
			$logo = wp_get_attachment_image ($thumb_id);
				   $name = $pod->field('airdrop_name') ;
				$sign =	"(" . get_the_title() . ")" ;
				
				if($pod->field('estimated_value') != ""){
				$value = "Value: " . $pod->field('estimated_value') . " " ;
				}
				//<!-------------- SETTING STARS -------------->
					$star = '<div class="star_rating">
							<fieldset class="rating star">
								<input type="radio" id="field6_star5" name="rating2" value="5" /><label class = "full" for="field6_star5"></label>
								<input type="radio" id="field6_star4" name="rating2" value="4" /><label class = "full" for="field6_star4"></label>
								<input type="radio" id="field6_star3" name="rating2" value="3" /><label class = "full" for="field6_star3"></label>
								<input type="radio" id="field6_star2" name="rating2" value="2" /><label class = "full" for="field6_star2"></label>
								<input type="radio" id="field6_star1" name="rating2" value="1" /><label class = "full" for="field6_star1"></label>
							</fieldset>
							</div>
							<input type="hidden" id="ratings-nonce" value="'. wp_create_nonce("ratings") . '">		
	  						' ; 
			
			//<!-------------- GETTING REQUIRED LOGOS -------------->
			
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
				?>
                
                <!-------------- PRINTING THE DATA -------------->
            		<div class="logo"><?php echo $logo; ?></div>
                    
                    <h1><?php echo $name . " " . $sign . " " . $value; ?></h1>
              
                    <div class="requires"><?php echo ("Requires: "); echo $requires; ?></div>
                    
                    <div class="star"><?php echo $star; ?></div>
                
               </div>
               <!-------------- p1-airdrop-item ENDS--------------> 
				<?php endwhile; ?>
            
            
		<?php endif;
?>
	</div>
    <!-------------- p1-airdrop STARTS -------------->
</div>
<!-------------- p1-section p1-style-curves p1-style-shadow ENDS -------------->
	<?php
	wp_reset_postdata();
	 die();
	
}

?>
<script>
// ------------------ RATING ------------------ //

	$("label").click(function(){
	  $(this).parent().find("label").css({"background-color": "#78e2fb"});
	  $(this).css({"background-color": "red"});
	  $(this).nextAll().css({"background-color": "red"});
	});
	$(".star label").click(function(){
	  $(this).parent().find("label").css({"color": "#78e2fb"});
	  $(this).css({"color": "red"});
	  $(this).nextAll().css({"color": "red"});
	  $(this).css({"background-color": "transparent"});
	  $(this).nextAll().css({"background-color": "transparent"});
	});
// ------------------ RATING ENDS ------------------ //

</script>