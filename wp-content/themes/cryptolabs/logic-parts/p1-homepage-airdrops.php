<?php
/**
 * Template part for p1-homepage-airdrops.php
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
?>	
<!-------------- p1-section p1-style-curves p1-style-shadow STARTS -------------->
<div class="p1-section p1-style-curves p1-style-shadow">

<!-------------- p1-airdrop STARTS -------------->
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
            
            <!-------------- p1-airdrop-item STARTS --------------> 
            <div class="p1-airdrop-item">
				<?php
                    $thumb_id = get_post_thumbnail_id();
                    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
                    $thumb_url[] =  $thumb_url_array;
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
                                    <input type="hidden" id="ratings-nonce" value="'. wp_create_nonce("ratings") . '">
                                </div>		
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
            
            
		<?php endif; ?>
	</div>
    <!-------------- p1-airdrop STARTS -------------->
</div>
<!-------------- p1-section p1-style-curves p1-style-shadow ENDS -------------->
