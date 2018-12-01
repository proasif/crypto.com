<?php
/**
 * Template part for featured-post-grid-display
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
	$action = "star_rating";
	$nonce = wp_create_nonce($action);
	$admin_url = admin_url("admin-ajax.php");
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
			
		if ( $users == 1 ) {	
			$starContent = '<div class = "star-rating" data-original = "' . $old_rating . '" data-nonce= "' . $nonce . '" data-action="' . $action . '" data-url="' . $admin_url . '">'. $temp_content ;
			$starUsers = '<div class = "star-users">(' . $users . ' Vote) </div></div>';
			$content = $starContent . $starUsers;
			echo $content;
		}
		
		else if ( $users > 1 ) {	
			$starContent = '<div class = "star-rating" data-original = "' . $old_rating .  '" data-nonce= "' . $nonce . '" data-action="' . $action . '" data-url="' .  $admin_url . '">'. $temp_content ;
			$starUsers = '<div class = "star-users">(' . $users . ' Votes)</div></div>';
			$content = $starContent . $starUsers;
			echo $content;
		}
		else {	
			$content = '<div class = "star-rating" data-original = "' . $old_rating .  '" data-nonce= "' .  $nonce . '" data-action="' .  $action . '" data-url="'. $admin_url . '">'. $temp_content . '</div>';
			echo $content ; // Displaying stars and no. of users rated
		}
		
	
	$about = $pod->field('brief_description');
	?>
	   <div class="about-format">
			<div class="about"><?php echo $about ?></div>
	   </div>
	
   <?php $steps = get_the_content(); ?>
		<div class="steps-format">
			<button class="primary p1-steps-btn">Step by step guide </button>
			<div class="show"><?php echo $steps ?></div>
			<button class="primary p1-close-btn">CLOSE</button>
		</div>
	<?php
//-------------- GETTING REQUIRED LOGOS --------------//

	$requires = "";
	if ($pod->field('telegram_required') == true)
		{
			 $requires = $requires . " " . '<div class="icon-paper-plane"></div>';
		}
	if ($pod->field('twitter_required') == true)
		{
			$requires = $requires . " " . '<div class="icon-twitter"></div></br>';
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
	if ($pod->field('kyc_required') == true)
		{
			$requires = $requires . " " . '<div class="icon-user"></div></br>';
		}
	if ($pod->field('bitcointalk_required') == true)
		{
			$requires = $requires . " " . '<div class="icon-btc"></div></br>';
		}
		
	?>

	<div class="requires"><?php echo ("Requires: "); echo $requires; // Displaying required logos  ?></div> 
</div>