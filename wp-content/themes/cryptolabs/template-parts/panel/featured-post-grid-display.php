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
	
	<div class="featured-post-grid-display-section">
    
             <?php
                $custom_posts = new WP_Query( array(
                    'order_by' => 'title',
                    'order'    => 'desc',
                    'posts_per_page' => 3,
                ));
                if ( $custom_posts->have_posts() ) :
                    while ( $custom_posts->have_posts() ) : $custom_posts->the_post(); ?>
					<h2 id="post-<?php the_ID(); ?>">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<?php 
							the_content();
							the_post_thumbnail();
						?>

			<?php endwhile; ?>
            <?php endif; ?>
    	</div>