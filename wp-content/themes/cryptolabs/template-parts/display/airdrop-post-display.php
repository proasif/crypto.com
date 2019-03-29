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

<article class="p1-airdrop-item" data-postid="<?php the_id() ?>" data-url="<?php the_permalink() ?>" 
    data-action="airdrop_display" data-platform="<?php echo get_field('platform'); ?>" data-nonce="<?php echo wp_create_nonce("airdrop_display"); ?>" 
    data-ajaxurl="<?php echo admin_url("admin-ajax.php"); ?>">
	<?php  
    // Get Thumbnail
	$thumb_id = get_post_thumbnail_id();
	$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
	$thumb_url[] =  $thumb_url_array;

	// Get R
	//$pod = pods('airdrop', get_the_ID());
	$airdropMeta = get_field( 'airdrop_ratings', $postid );
	
	$rate = $airdropMeta["ratings"];
	$users = $airdropMeta["no_of_users"];
	$old_rating = 0;

	if ($rate >= 0 && $users >= 1) {
		 $old_rating = round( ( $rate / $users ), 2);
	}
	$logo = wp_get_attachment_image ($thumb_id); 
    ?>
	
	<div class="p1-airdrop-logo-container">
		<div class="logo"><?php echo $logo; ?></div> 
    </div> 
	
	<?php      
	$name = get_field('airdrop_name') ;
	$edate = get_field('end_date');
	$cdate = date('Y-m-d');
	//$sign =	"(" . get_the_title() . ")" ;	
	/*if(the_field('estimated_value') != NULL){
		//$airdrop_value = "Value: " . the_field('estimated_value') . " " ;
	}
	else $airdrop_value = NULL;
	*/
	?>

    <div class="content-container">
    	<div class="content-container-part1">
            <div class="p1-airdrop-title-container">
            <a href="<?php echo the_permalink(); ?>"><?php echo $name; //. " " . $edate // . " " . $airdrop_value; // Printing Name, Sign and Value of Airdrop ?></a>
            <?php if ($cdate > $edate){
				?>
                <div>EXPIRED</div>
                <?php
				} ?>
            </div>
 <?php
	//-------------- SETTING STARS --------------//
			
	$temp_content = "";
	$star_value = "";
	$append_class = "star";
	$action = "star_rating";
	$nonce = wp_create_nonce($action);
	$admin_url = admin_url("admin-ajax.php");
	if($old_rating > 4.75){
			$star_value = '<div class="icon-star ' . $append_class . '" value="5"></div>';
		 }
	else if($old_rating > 4.25){
			$star_value = '<div class="icon-star-half-o ' . $append_class . '" value="5"></div>';	
		 }
	else {
			$star_value = '<div class="icon-star-o ' . $append_class . '" value="5"></div>';
		}
			$temp_content = $star_value . $temp_content ; // storing value for fifth star
		
	if($old_rating > 3.75){
			$star_value = '<div class="icon-star ' . $append_class . '" value="4"></div>';
		}
	else if($old_rating > 3.25){
			$star_value = '<div class="icon-star-half-o ' . $append_class . '" value="4"></div>';	
		}
	else {
			$star_value = '<div class="icon-star-o ' . $append_class . '" value="4"></div>';
		}
			$temp_content = $star_value . $temp_content ; // storing value for fourth star
		
	if($old_rating > 2.75)
		{
			$star_value = '<div class="icon-star ' . $append_class . '" value="3"></div>';
		}
	else if($old_rating > 2.25) {
			$star_value = '<div class="icon-star-half-o ' . $append_class . '" value="3"></div>';	
		}
	else {
			$star_value = '<div class="icon-star-o ' . $append_class . '" value="3"></div>';
		}
			$temp_content = $star_value . $temp_content ; // storing value for third star
		
	if($old_rating > 1.75) {
			$star_value = '<div class="icon-star ' . $append_class . '" value="2"></div>';
		}
	else if($old_rating > 1.25) {
			$star_value = '<div class="icon-star-half-o ' . $append_class . '" value="2"></div>';	
		}
	else {
			$star_value = '<div class="icon-star-o ' . $append_class . '" value="2"></div>';
		}
			$temp_content = $star_value . $temp_content ; // storing value for second star
		
	if($old_rating > 0.75) {
			$star_value = '<div class="icon-star ' . $append_class . '" value="1"></div>';
		}
	else if($old_rating > 0.25) {
			$star_value = '<div class="icon-star-half-o ' . $append_class . '" value="1"></div>';	
		}
	else {
			$star_value = '<div class="icon-star-o ' . $append_class . '" value="1"></div>';
		}
			$temp_content = $star_value . $temp_content ; // storing value for first star
			
		
		if ( $users == 0 ) {	
			$starContent = '<div class = "star-rating" data-original = "' . $old_rating . '" data-nonce= "' . $nonce . '" data-action="' . $action . '" data-url="' . $admin_url . '">'. $temp_content ;
			$starUsers = '<div class = "star-users"></div></div>';
			$content = $starContent . $starUsers;
			?>
            <div class="p1-airdrop-rating-container">
			<?php echo $content; ?>
            </div>
            
            <?php
		}
		
		else if ( $users == 1 ) {	
			$starContent = '<div class = "star-rating" data-original = "' . $old_rating . '" data-nonce= "' . $nonce . '" data-action="' . $action . '" data-url="' . $admin_url . '">'. $temp_content ;
			$starUsers = '<div class = "star-users">(' . $users . ' Vote)</div></div>';
			$content = $starContent . $starUsers;
			?>
            <div class="p1-airdrop-rating-container">
			<?php echo $content; ?>
            </div>
            
            <?php
		}
		
		else if ( $users > 1 ) {	
			$starContent = '<div class = "star-rating" data-original = "' . $old_rating .  '" data-nonce= "' . $nonce . '" data-action="' . $action . '" data-url="' .  $admin_url . '">'. $temp_content ;
			$starUsers = '<div class = "star-users">(' . $users . ' Votes)</div></div>';
			$content = $starContent . $starUsers;
			?>
            <div class="p1-airdrop-rating-container">
			<?php echo $content; ?>
            </div>
            
            <?php
		}
		else {	
			$content = '<div class = "star-rating" data-original = "' . $old_rating .  '" data-nonce= "' .  $nonce . '" data-action="' .  $action . '" data-url="'. $admin_url . '">'. $temp_content . '</div>';
			?>
            <div class="p1-airdrop-rating-container">
			<?php echo $content; ?>
            </div>
            
            <?php // Displaying stars and no. of users rated
		}
		
	
	//$about = the_field('brief_description');
	?>
            <div class="p1-airdrop-content-container">
               <div class="about-format">
                    <div class="about"><?php //echo $about ?></div>
               </div>
        
       <?php //$steps = get_the_content(); ?>
       
       <!--
                <div class="steps-format">
                    <button class="primary p1-steps-btn">Step by step guide </button>
                    <div class="p1-steps">
						<?php
    
                        // check if the repeater field has rows of data
                        if( have_rows('airdrop_steps') ):
                        
                            // loop through the rows of data
                            while ( have_rows('airdrop_steps') ) : the_row();
                        
                                // display a sub field value
                               ?> <div class="p1-step"> <?php //the_sub_field('steps'); ?> </div> 
                               <?php
                        
                            endwhile;
                        
                        else :
                        
                            // no rows found
                        
                        endif;
                
                        ?>
            		</div>
                    <button class="primary p1-close-btn">CLOSE</button>
                </div>
           -->
            </div>
        </div>
	<?php
//-------------- GETTING REQUIRED LOGOS --------------//
/*
	$requires = "";
	if (get_field('telegram_required') == true){
			 $requires = $requires . " " . '<div class="icon-paper-plane"></div>';
		}
	if (get_field('twitter_required') == true){
			$requires = $requires . " " . '<div class="icon-twitter"></div></br>';
		}
	if (get_field('facebook_required') == true){
			$requires = $requires . " " . '<div class="icon-facebook"></div></br>';
		}
	if (get_field('e-mail_required') == true){
			$requires = $requires . " " . '<div class="icon-envelope"></div></br>';
		}
	if (get_field('reddit_required') == true){
			$requires = $requires . " " . '<div class="icon-reddit"></div></br>';
		}
	if (get_field('instagram_required') == true){
			$requires = $requires . " " . '<div class="icon-instagrem"></div></br>';
		}
	if (get_field('youtube_required') == true){
			$requires = $requires . " " . '<div class="icon-youtube"></div></br>';
		}
	if (get_field('medium_required') == true){
			$requires = $requires . " " . '<div class="icon-medium"></div></br>';
		}
	if (get_field('phone_required') == true){
			$requires = $requires . " " . '<div class="icon-phone"></div></br>';
		}
	if (get_field('linkedin_required') == true){
			$requires = $requires . " " . '<div class="icon-linkedin"></div></br>';
		}
	if (get_field('discord_required') == true){
			$requires = $requires . " " . '<div class="icon-flickr"></div></br>';
		}
	if (get_field('kyc_required') == true){
			$requires = $requires . " " . '<div class="icon-user"></div></br>';
		}
	if (get_field('bitcointalk_required') == true){
			$requires = $requires . " " . '<div class="icon-btc"></div></br>';
		}
*/
		
	?>
    	<div class="content-container-part2">  
        <?php p1_required_logo($requires); ?>               
        </div>

    </div>
</article>