<?php
/**
 * The Template for search form pages.
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
<div class="airdrop-search">
<form role="search" method="get" action="<?php echo home_url('/'); ?>">
<input type="search" class="form-control" placeholder="Search" data-action="search" data-ajaxurl="<?php echo admin_url("admin-ajax.php"); ?>" data-value="<?php echo get_search_query() ?>" name="s" title="Search" />
</form>	
</div>