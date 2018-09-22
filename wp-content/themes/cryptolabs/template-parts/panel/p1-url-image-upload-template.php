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
    <form class="p1-imgupload">
    <div class="idata">
    	<input type="text" id="iupload" name="iupload">
		<button type="submit" form="form1" value="Submit" onclick="iupload()">Submit</button>
    </div>
    </form>
    