<?php
/**
 * Template part for url-image-upload
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
	<div class="p1-section p1-style-curves p1-style-shadow">
        <form class="p1-image-upload">
            	<div class="p1-image-display">
                <input type="text" id="p1-image-upload-text" name="p1-image-upload-text">
                <input type="hidden" id="admin-image-upload-nonce" value="<?php echo wp_create_nonce("admin-image-upload"); ?>">
                <button type="submit" id="p1-image-upload-button" form="form1" value="Submit">Submit</button>
            	</div>
        </form>
    </div>