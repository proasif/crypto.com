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
            <select class="p1-filter-dropdown" data-ajaxurl="<?php echo admin_url("admin-ajax.php"); ?>" data-action="select">
                <option value="">Sort By..</option>
                <option value="rating">Rating</option>
                <option value="eth">ETH</option>
                <option value="own">OWN CHAIN</option>
                <option value="neo">NEO</option>
            </select>
         <?php 
            //-------------- p1-airdrop STARTS --------------//
            $currentpage = get_query_var('paged');
            $custom_posts = new WP_Query( array(
                'post_type'			=> 'airdrop',
                'order_by' 			=> 'title',
                'order'    			=> 'desc',
                'posts_per_page' 	=> 10,
                'paged' 				=> $currentpage
            ));
            
            if ( $custom_posts->have_posts() ) :
                while ( $custom_posts->have_posts() ) : $custom_posts->the_post(); 
                    get_template_part( 'template-parts/display/airdrop-post', 'display' );
                endwhile;
            endif;
        ?>
        </section>
        <?php //-------------- p1-airdrop ENDS --------------// ?>
        
        <div class="p1-load-more-button" align="center">
            <?php 
                $action = "load_more";
                $nonce = wp_create_nonce($action);
                $page = 1;
                $url = "admin-ajax.php";
            ?>
            <button data-paging="<?php echo $page ?>" data-nonce="<?php echo $nonce ?>" data-action="<?php echo $action ?>" data-url="<?php echo admin_url($url); ?>"class="primary p1-airdrop-load-more">Load More</button>
        </div>
</section>
<?php //-------------- p1-section p1-style-curves p1-style-shadow ENDS --------------// ?>
