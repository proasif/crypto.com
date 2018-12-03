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
            	<div class="p1-image-display">
					<?php 
                    $action = "img_upload";
                    $nonce = wp_create_nonce($action);
                    $url = "admin-ajax.php";
                    ?>
                    
                    <input type="text" class="p1-image-upload-text">
                    <button 
                        class="p1-image-upload-button" 
                        data-nonce="<?php echo $nonce ?>" 
                        data-action="<?php echo $action ?>" 
                        data-url="<?php echo admin_url($url); ?>" 
                        value="Submit">Submit
                    </button>
            	</div>
    </div>