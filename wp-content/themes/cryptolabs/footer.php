 <?php
/**
 * The Template Part for displaying the footer.
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme 5.4
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
?>

<?php get_template_part( 'template-parts/footer/site-footer' ); ?>
<?php get_template_part( 'template-parts/panel/p1-url-image-upload-template' ); ?>


<?php wp_footer(); ?>
</body>
</html>
