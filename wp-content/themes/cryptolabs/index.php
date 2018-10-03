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

get_header();
?>
	<div class="icon-btc" data-icon="a">
    Bitcoin
    </div>
 	
		
        
		<?php get_template_part( 'template-parts/panel/featured-post-grid-display' ); ?>	
        
		
	

<?php get_footer();