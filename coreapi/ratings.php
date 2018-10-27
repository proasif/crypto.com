<?php

$security = $_POST["security"];
$url = $_POST["url"];
$op = $_POST["op"];
$postid = $_POST["postid"]; //only for process image

$dmode = $_GET["dmode"];
if ($dmode) {
	$op = $_GET["op"];
	$url = urldecode($_GET["url"]);
}

//check if url is valid
if(!filter_var($url, FILTER_VALIDATE_URL)) {
	echo "Errr:Invalid URL";
	die();
}

//get wordpress things
define('WP_USE_THEMES', false);
require($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');

//check security
$result = check_ajax_referer( 'admin-image-upload', $security, false );
if ($op == 'upload_and_process') {
	$result = wp_verify_nonce( $security, 'upload_and_process' );
}

if ($result == -1 && !$dmode) {
	echo "Errr:Security Error";
	die();
}
else {
	if ($op == 'upload') {
		$upload_url = uploadRemoteImage($url, false);
		echo $upload_url;
	}
	else if ($op == 'upload_and_process') {
		$upload_url = uploadRemoteImage($url, true);
		echo $upload_url;
	}
	else if ($op == 'delete') {
		$delete_url = deleteUploadedImage($url);
		echo $delete_url;
	}
	die();
}

function uploadRemoteImage($image_url, $process){
    $image = $image_url;
    $get = wp_remote_get( $image );
    $type = wp_remote_retrieve_header( $get, 'content-type' );
    
	$ext = ".jpg";
	$shouldProceed = false;
	
	if ($type == "image/jpeg" || $type == "image/jpg") {
		$ext = ".jpg";
		$shouldProceed = true;
	}
	else if ($type == "image/png") {
		$ext = ".png";
		$shouldProceed = true;
	}
	else if ($type == "image/gif") {
		$ext = ".gif";
		$shouldProceed = true;
		
		//till i can get this to work
		//return "Errr:Use Upload Files For GIF Files";
	}
	
	if (!$shouldProceed) {
        return "Errr:Invalid Filetype";
	}
	
   	$mirror = wp_upload_bits( basename( pathinfo($image, PATHINFO_FILENAME) ) . $ext , '', wp_remote_retrieve_body( $get ) );
	
	$path = $mirror["file"];
	$filename = basename($mirror["file"]);
	$image_id = '';
	
	$url = $mirror["url"];
	$url = parse_url($url, PHP_URL_PATH);
	
	if ($process && !$mirror['error']) {
		$wp_filetype = wp_check_filetype($filename, null );
		
		$attachment = array(
			'guid'=> $path, 
			'post_mime_type' => $type,
			'post_title'     => preg_replace( '/\.[^.]+$/', '', $filename ),
   			'post_content'   => '',
			'post_status' => 'inherit'
         );
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		
    	$image_id = wp_insert_attachment($attachment, $path, 0);
		
		// Generate the metadata for the attachment, and update the database record
		$attach_data = wp_generate_attachment_metadata( $image_id, $path );
		wp_update_attachment_metadata( $image_id, $attach_data );
		
		$image_id = $image_id;
	}
	
	$content = array(
		"url" => $url,
		"atpath" => $path,
		"name" => $filename,
		"image_id" => $image_id
	);
	return "Succ:" . json_encode($content);
}  

function deleteUploadedImage($url){
	$result = attachment_url_to_postid($url); 
	
	//return "|" . $result . "|";
	//get path from the entire url
	/*$arr = explode('wp-content/', $result);
	if (count($arr) >= 1) {
		$main = $arr[0];
		$path = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/2018/09/' . $main;
		unlink($path);*/
		if ($result != ""){
			wp_delete_attachment($result, true);
		return "Succ:File Deleted - " . $result;
	}
	else {
		return "Errr:File not found for delete - " . $result;	
	}
}