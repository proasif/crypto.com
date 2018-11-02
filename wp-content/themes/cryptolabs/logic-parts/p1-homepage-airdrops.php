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
<?php //-------------------- p1-section p1-style-curves p1-style-shadow STARTS -----------------------// ?>
	<div class="p1-airdrop">
     <?php 
	 	//-------------- p1-airdrop STARTS --------------//
		$currentpage = get_query_var('paged');
		$custom_posts = new WP_Query( array(
			'post_type'=> 'airdrop',
			'order_by' => 'title',
			'order'    => 'desc',
			'posts_per_page' => 10,
			'paged' => $currentpage
		));
		
		if ( $custom_posts->have_posts() ) :
			while ( $custom_posts->have_posts() ) : $custom_posts->the_post(); 
			
	?> 
           
            <div class="p1-airdrop-item" data-postid="<?php the_id() ?>" data-url="<?php the_permalink() ?>">
				<?php  
			//------------------------p1-airdrop-item STARTS------------------------------//
                    $thumb_id = get_post_thumbnail_id();
                    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
                    $thumb_url[] =  $thumb_url_array;
					$pod = pods('airdrop', get_the_ID());
					$rate = $pod->field('rating') ;
					$users = $pod->field('no_of_users') ;
					$old_rating = 0;
					
					if ($rate >= 0 && $users >= 1) {
						 $old_rating = round( ( $rate / $users ), 2);
					}
					$logo = wp_get_attachment_image ($thumb_id); 
				?>
					
					<div class="logo"><?php echo $logo; // Printing Logo ?></div> 
                    
                 <?php      
                    $name = $pod->field('airdrop_name') ;
                    $sign =	"(" . get_the_title() . ")" ;	
					if($pod->field('estimated_value') != NULL){
                    $airdrop_value = "Value: " . $pod->field('estimated_value') . " " ;
                    }
					else $airdrop_value = NULL;
					
				  ?>
					
				<h1><?php echo $name . " " . $sign . " " . $airdrop_value; // Printing Name, Sign and Value of Airdrop ?></h1>
                    
                 <?php
					//-------------- SETTING STARS --------------//
							
					$temp_content = "";
					$star_value = "";
					$append_class = "star";
					if($old_rating > 4.75)
						 {
							$star_value = '<div class="icon-star ' . $append_class . '" value="5"></div>';
						 }
					else if($old_rating > 4.25)
						 {
							$star_value = '<div class="icon-star-half-o ' . $append_class . '" value="5"></div>';	
						 }
					else 
						{
							$star_value = '<div class="icon-star-o ' . $append_class . '" value="5"></div>';
						}
							$temp_content = $star_value . $temp_content ; // storing value for fifth star
						
					if($old_rating > 3.75)
						{
							$star_value = '<div class="icon-star ' . $append_class . '" value="4"></div>';
						}
					else if($old_rating > 3.25)
						{
							$star_value = '<div class="icon-star-half-o ' . $append_class . '" value="4"></div>';	
						}
					else 
						{
							$star_value = '<div class="icon-star-o ' . $append_class . '" value="4"></div>';
						}
							$temp_content = $star_value . $temp_content ; // storing value for fourth star
						
					if($old_rating > 2.75)
						{
							$star_value = '<div class="icon-star ' . $append_class . '" value="3"></div>';
						}
					else if($old_rating > 2.25) 
						{
							$star_value = '<div class="icon-star-half-o ' . $append_class . '" value="3"></div>';	
						}
					else 
						{
							$star_value = '<div class="icon-star-o ' . $append_class . '" value="3"></div>';
						}
							$temp_content = $star_value . $temp_content ; // storing value for third star
						
					if($old_rating > 1.75) 
						{
							$star_value = '<div class="icon-star ' . $append_class . '" value="2"></div>';
						}
					else if($old_rating > 1.25) 
						{
							$star_value = '<div class="icon-star-half-o ' . $append_class . '" value="2"></div>';	
						}
					else 
						{
							$star_value = '<div class="icon-star-o ' . $append_class . '" value="2"></div>';
						}
							$temp_content = $star_value . $temp_content ; // storing value for second star
						
					if($old_rating > 0.75) 
						{
							$star_value = '<div class="icon-star ' . $append_class . '" value="1"></div>';
						}
					else if($old_rating > 0.25) 
						{
							$star_value = '<div class="icon-star-half-o ' . $append_class . '" value="1"></div>';	
						}
					else 
						{
							$star_value = '<div class="icon-star-o ' . $append_class . '" value="1"></div>';
						}
							$temp_content = $star_value . $temp_content ; // storing value for first star
							
						if($old_rating != NULL)
						{	
							$content = '<div class = "star-rating" data-original = "' . $old_rating .  '">' 
							. $temp_content .'<input type="hidden" id="ratings-nonce" value="'. wp_create_nonce("ratings") . '">'
							. " " . "(" . $users .  " Votes)" . '</div>';
							echo $content ; // Displaying stars and no. of users rated
						}
						else 
						{	
							$content = '<div class = "star-rating" data-original = "' . $old_rating .  '">' 
							. $temp_content .'<input type="hidden" id="ratings-nonce" value="'. wp_create_nonce("ratings") . '">
							' . '</div>';
							echo $content ; // Displaying stars and no. of users rated
						}
						
                    
                    $about = $pod->field('brief_description');
					?>
                       <div class="about-format">
                            <div class="about"><?php echo $about ?></div>
                       </div>
                    
                   <?php $steps = $pod->field('step_by_step_guide'); ?>
                        <div class="steps_format">
                            <div class="steps"><input type="button" class="steps_button" value="Step by step guide"></div>
                            <div class="show"><?php echo "STEPS: " . "</br>" . $steps ?></div>
                            <div class="steps"><input type="button" class="close" value="CLOSE"></div>
                        </div>
					<?php
                //-------------- GETTING REQUIRED LOGOS --------------//
				
					$requires = "";
					if ($pod->field('telegram_required') == true)
						{
							 $requires = $requires . " " . '<div class="icon icon-paper-plane"></div>';
						}
					if ($pod->field('twitter_required') == true)
						{
							$requires = $requires . " " . '<div class="class="icon-twitter"></div></br>';
						}
					if ($pod->field('facebook_required') == true) 
						{
							$requires = $requires . " " . '<div class="icon-facebook"></div></br>';
						}
					if ($pod->field('e-mail_required') == true)
						{
							$requires = $requires . " " . '<div class="icon-envelope"></div></br>';
						}
					if ($pod->field('reddit_required') == true)
						{
							$requires = $requires . " " . '<div class="icon-reddit"></div></br>';
						}
					if ($pod->field('instagram_required') == true)
						{
							$requires = $requires . " " . '<div class="icon-instagrem"></div></br>';
						}
					if ($pod->field('youtube_required') == true)
						{
							$requires = $requires . " " . '<div class="icon-youtube"></div></br>';
						}
					if ($pod->field('medium_required') == true)
						{
							$requires = $requires . " " . '<div class="icon-medium"></div></br>';
						}
					if ($pod->field('phone_required') == true)
						{
							$requires = $requires . " " . '<div class="icon-phone"></div></br>';
						}
					if ($pod->field('linkedin_required') == true)
						{
							$requires = $requires . " " . '<div class="icon-linkedin"></div></br>';
						}
					if ($pod->field('discord_required') == true)
						{
							$requires = $requires . " " . '<div class="icon-flickr"></div></br>';
						}
						
				?>
			
                    <div class="requires"><?php echo ("Requires: "); echo $requires; // Displaying required logos  ?></div> 
    
            </div>
			<?php
			 //-------------- p1-airdrop-item ENDS--------------//
				endwhile; 
			?>
            
            
		<?php endif; ?>
	</div>
    <?php //-------------- p1-airdrop ENDS --------------// ?>
    
    <div class="load_more_button" align="center">
        	<a><input type="button" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>"class="load_more" value="Load More"></a>
    </div>
</div>
<?php //-------------- p1-section p1-style-curves p1-style-shadow ENDS --------------// ?>
