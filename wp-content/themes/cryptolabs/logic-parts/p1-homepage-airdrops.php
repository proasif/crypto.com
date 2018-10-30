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
           
            <div class="p1-airdrop-item" data-postid="<?php the_id() ?>" data-url="<?php the_permalink() ?>">
				 <?php
                    $thumb_id = get_post_thumbnail_id();
                    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
                    $thumb_url[] =  $thumb_url_array;
					$pod = pods('airdrop', get_the_ID());
					$rate = $pod->field('rating') ;
					$users = $pod->field('no_of_users') ;
					if( $rate || $user == 0){
						$old_rating = 0;
						}
					echo $rate . " ";
					echo $users;
					
                    $old_rating = $rate/$users;
					echo "</br>" . $old_rating;
					$logo = wp_get_attachment_image ($thumb_id);
                    
                    $name = $pod->field('airdrop_name') ;
                    $sign =	"(" . get_the_title() . ")" ;
                    
                    if($pod->field('estimated_value') != ""){
                    $value = "Value: " . $pod->field('estimated_value') . " " ;
                    }
					//<!-------------- SETTING STARS -------------->
                        $star = '<div class="star_rating">
                                    <fieldset class="rating star">
                                        <input type="radio" id="field6_star5" name="rating2" value="5" /><label class = "full" value="5" for="field6_star5"></label>
                                        <input type="radio" id="field6_star4" name="rating2" value="4" /><label class = "full" value="4" for="field6_star4"></label>
                                        <input type="radio" id="field6_star3" name="rating2" value="3" /><label class = "full" value="3" for="field6_star3"></label>
                                        <input type="radio" id="field6_star2" name="rating2" value="2" /><label class = "full" value="2" for="field6_star2"></label>
                                        <input type="radio" id="field6_star1" name="rating2" value="1" /><label class = "full" value="1" for="field6_star1"></label>
                                    </fieldset>
                                    <input type="hidden" id="ratings-nonce" value="'. wp_create_nonce("ratings") . '">
								
                                </div>
								';
								
								if( $old_rating >= 4.75 ){ echo
									'
										<div class="new-stars">
										<div class="icon-star" value="1"></div>
										<div class="icon-star" value="2"></div>
										<div class="icon-star" value="3"></div>
										<div class="icon-star" value="4"></div>
										<div class="icon-star" value="5"></div>
										</div>	
                                	'; 
										}
									
									else if( $old_rating >= 4.5 || $old_rating >= 4.25 ){ echo
										'
										<div class="new-stars">
										<div class="icon-star" value="1"></div>
										<div class="icon-star" value="2"></div>
										<div class="icon-star" value="3"></div>
										<div class="icon-star" value="4"></div>
										<div class="icon-star-half-o" value="5"></div>
										</div>	
                                	'; 
										}
										
										
									else if( $old_rating >= 4.0 || $old_rating >= 3.75 ){ echo
										'
										<div class="new-stars">
										<div class="icon-star" value="1"></div>
										<div class="icon-star" value="2"></div>
										<div class="icon-star" value="3"></div>
										<div class="icon-star" value="4"></div>
										<div class="icon-star-o" value="5"></div>
										</div>	
                                	'; 
										}
										
										
									else if( $old_rating >= 3.5 || $old_rating >= 3.25 ){ echo
										'
										<div class="new-stars">
										<div class="icon-star" value="1"></div>
										<div class="icon-star" value="2"></div>
										<div class="icon-star" value="3"></div>
										<div class="icon-star-half-o" value="4"></div>
										<div class="icon-star-o" value="5"></div>
										</div>	
                                	'; 
										}
										
									else if( $old_rating >= 3.0 || $old_rating >= 2.75 ){ echo
										'
										<div class="new-stars">
										<div class="icon-star" value="1"></div>
										<div class="icon-star" value="2"></div>
										<div class="icon-star" value="3"></div>
										<div class="icon-star-o" value="4"></div>
										<div class="icon-star-o" value="5"></div>
										</div>	
                                	'; 
										}
										
										
									else if( $old_rating >= 2.5 || $old_rating >= 2.25 ){ echo
										'
										<div class="new-stars">
										<div class="icon-star" value="1"></div>
										<div class="icon-star" value="2"></div>
										<div class="icon-star-half-o" value="3"></div>
										<div class="icon-star-o" value="4"></div>
										<div class="icon-star-o" value="5"></div>
										</div>	
                                	'; 
										}
										
									else if( $old_rating >= 2.0 || $old_rating >= 1.75 ){ echo
										'
										<div class="new-stars">
										<div class="icon-star" value="1"></div>
										<div class="icon-star" value="2"></div>
										<div class="icon-star-o" value="3"></div>
										<div class="icon-star-o" value="4"></div>
										<div class="icon-star-o" value="5"></div>
										</div>	
                                	'; 
										}
										
									
									else if( $old_rating >= 1.5 || $old_rating >= 1.25 ){ echo
										'
										<div class="new-stars">
										<div class="icon-star" value="1"></div>
										<div class="icon-star-half-o" value="2"></div>
										<div class="icon-star-o" value="3"></div>
										<div class="icon-star-o" value="4"></div>
										<div class="icon-star-o" value="5"></div>
										</div>	
                                	'; 
										}
										
									else if( $old_rating >= 1.0 || $old_rating >= 0.75){ echo
										'
										<div class="new-stars">
										<div class="icon-star" value="1"></div>
										<div class="icon-star-o" value="2"></div>
										<div class="icon-star-o" value="3"></div>
										<div class="icon-star-o" value="4"></div>
										<div class="icon-star-o" value="5"></div>
										</div>	
                                	'; 
										}
										
									else if( $old_rating >= 0.5 || $old_rating >= 0.25 ){ echo
										'
										<div class="new-stars">
										<div class="icon-star-half-o" value="1"></div>
										<div class="icon-star-o" value="2"></div>
										<div class="icon-star-o" value="3"></div>
										<div class="icon-star-o" value="4"></div>
										<div class="icon-star-o" value="5"></div>
										</div>	
                                	'; 
										}
										
									else if ($old_rating == 0){ echo
										'
										<div class="new-stars">
										<div class="icon-star-o" value="1"></div>
										<div class="icon-star-o" value="2"></div>
										<div class="icon-star-o" value="3"></div>
										<div class="icon-star-o" value="4"></div>
										<div class="icon-star-o" value="5"></div>
										</div>	
                                	'; 
										}
								
							
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
