<!DOCTYPE html>

<?php
/**
 * Template Name: Home
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
    <?php
/**
 * Template part for p1-homepage-airdrops.php
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
?>	
<section class="p1-section p1-style-curves p1-style-shadow">
	
	<?php //-------------------- p1-section p1-style-curves p1-style-shadow STARTS -----------------------// ?>
        <section class="p1-airdrop">
    
     <?php
                    get_template_part( 'template-parts/display/airdrop-post', 'display-copy' );
            
        ?>
        </section>
        <?php //-------------- p1-airdrop ENDS --------------// ?>
</section>
<?php //-------------- p1-section p1-style-curves p1-style-shadow ENDS --------------// ?>
        
	</div><!-- #content -->
</div><!-- #primary -->
	<!-- Return to Top -->
 		
 
<?php 

// Get Footer
get_footer(); 
