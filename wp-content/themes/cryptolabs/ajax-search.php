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
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>
    <?php the_title();?>
    <?php 
		if(has_post_thumbnail()): ?>	
		<div class="p1-section p1-style-curves p1-style-shadow">
			<?php 
                the_post_thumbnail(); 
                $pod = pods('airdrop', get_the_ID());
                $name = $pod->field('airdrop_name') ;
                $title = get_the_title();
                echo $title . " " . $name . "</br>" ;
            ?>
		</div>
	  <?php endif; ?>
</article>