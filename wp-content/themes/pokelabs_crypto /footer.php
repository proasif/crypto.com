            <footer>
                     <?php if ( get_theme_mod( 'm2_logo' ) && get_theme_mod( 'm3_logo' ) && get_theme_mod( 'm4_logo' ) ) : ?>
   
 
        <img src="<?php echo get_theme_mod( 'm2_logo' ); ?>"  ?>
 
<?php endif; ?>


			 <?php if ( get_theme_mod( 'm3_logo' ) ) : ?>
   
 
        <img src="<?php echo get_theme_mod( 'm3_logo' ); ?>"  ?>
 
<?php endif; ?>

			<?php if ( get_theme_mod( 'm4_logo' ) ) : ?>
   
 
        <img src="<?php echo get_theme_mod( 'm4_logo' ); ?>"  ?>
 
<?php endif; ?>
            </footer>
            
            <?php wp_footer(); ?>
           
                
		</body>
	</html>
