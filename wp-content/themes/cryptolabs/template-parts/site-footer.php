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