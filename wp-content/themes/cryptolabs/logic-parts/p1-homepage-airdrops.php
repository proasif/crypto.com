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
    	<div class="button-group">
            	<h3>Sort by..</h3>
              <button class="sort-by-button-orignal" data-sort-value="original-order">original order</button>
              <button class="sort-by-button" data-sort-value="rating">Rating</button>
              <button class="sort-by-button" data-sort-value="votes">Votes</button>
         </div>
         </br>
         <div class="button-group">
            	<h3>Filter by..</h3>
              <button class="filter-by-button-orignal" data-filter-value="p1-airdrop-item">Show All</button>
              <button class="filter-by-button" data-filter-value="ETH">ETH</button>
              <button class="filter-by-button" data-filter-value="NEO">NEO</button>
         </div>
        <section class="p1-airdrop">
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
            <button data-paging="<?php echo $page ?>" data-nonce="<?php echo $nonce ?>" data-action="<?php echo $action ?>" data-url="<?php echo admin_url($url); ?>" data-processing="0" class="primary p1-airdrop-load-more">No More</button>
        </div>
</section>
<?php //-------------- p1-section p1-style-curves p1-style-shadow ENDS --------------// ?>
