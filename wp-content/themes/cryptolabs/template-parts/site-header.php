<?php
/**
 * Template part for bulding Header
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

<header>
	<div class="p1-primary-max p1-header-content">
		<div class="p1-header-logo">
		<?php if ( get_theme_mod( 'm1_logo' ) ) { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Homepage of AirdropMonkey.com" rel="home">
				<img src="<?php echo get_theme_mod( 'm1_logo' ); ?>" alt="Airdrop Monkey's Logo"><span><h1 class="p1-logo-title p1-gradient">AIRDROP</h1><h1 class="p1-logo-sub">MONKEY</h1></span>
			</a>
		<?php } ?>
		</div>

	<?php 
		p1_custom_menu( "primary", true, "p1-nav-main", true, "", "", "");
	?>
	</div>
</header>
          
          
    