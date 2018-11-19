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
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>
    <?php the_title();?>
    <?php 
		if(has_post_thumbnail()): ?>
            <div class="p1-section p1-style-curves p1-style-shadow"><?php 
            the_post_thumbnail(); 
            $pod = pods('airdrop', get_the_ID());
            $name = $pod->field('airdrop_name') ;
            $brief = $pod->field('brief_description') ;
            $title = get_the_title();
			$content = get_the_content();
			echo $title . " " . $name . "</br>" . $brief . "</br>" . $content ;
			
			
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
    <?php endif; ?>
	</div><!-- #content -->
</div><!-- #primary -->
	<!-- Return to Top -->
	<a href="javascript:" id="return-to-top"><div class="icon-chevron-circle-up"></div></a> 
 		
 