<?php
/**
 * Template part for bulding Footer
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
<div class="our_work" align="center"><h3>Like our work ? Please donate.<div class="icon-smile-o"><div></h3></div>
<?php
$custom_posts = new WP_Query( array(
			'post_type'=> 'wallet',
			'order_by' => 'title',
			'order'    => 'desc',
		));
		
		if ( $custom_posts->have_posts() ) :
			while ( $custom_posts->have_posts() ) : $custom_posts->the_post(); 
			
$pod = pods('wallet', get_the_ID());
$name =	get_the_title();
$content = get_the_content();
?>
<?php 
$donatable= $pod->field('users_can_donate');
$address = $pod->field('wallet_address'); 
if($address == true && $donatable != true){
	$name = NULL;
	$address = NULL;
	}

?>
<div class="address" align="center"><?php echo $name; ?> 
<a href = "<?php echo $content . $address;?>"><?php  echo $address; ?></a></div>
<?php
	  endwhile;
	endif;
?>

<div class="social_icons" align="center">
<a href="https://telegram.org/"><div class="icon-paper-plane"></div></a>
<a href="https://twitter.com/login"><div class="icon-twitter"></div></a>
<a href="https://www.facebook.com/"><div class="icon-facebook"></div></a>
</div>

<footer>
	<footer-background>
		<figure class="clouds velocity-animating" ></figure>
		<figure class="background velocity-animating" ></figure>
		<figure class="foreground velocity-animating" ></figure>
		<figure class="poof"></figure>
		<div class="stag"><img src="https://bluestag.co.uk/templates/blue_stag/img/footer/seb.gif">
		<img src="https://bluestag.co.uk/templates/blue_stag/img/footer/quote-1.png" class="quote" id="q-1">
		<img src="https://bluestag.co.uk/templates/blue_stag/img/footer/quote-2.png" class="quote visible" id="q-2"></div>
	</footer-background>

		<?php 
		p1_custom_menu( "social-icons", true, "foot-icons", true, "", "", "");
		p1_custom_menu( "footer-menu", true, "foot-main-nav", true, "", "", "");
		?>
</footer>