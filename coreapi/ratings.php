<?php
$security = $_POST["security"];
$rating = $_POST["rating"];
$postid = $_POST["postid"]; //only for (this) airdrop 
define('WP_USE_THEMES', false);
require($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
	$result = wp_verify_nonce( $security, 'ratings' );
	
	if ($result == -1) {
		
		die();
		
	}

$pod = pods('airdrop', intval($postid) );

$rate = $pod->field('rating') ;
$users = $pod->field('no_of_users') ;


$rate = $rate + $rating;
$users = $users + 1;
$data = array(
'rating' => $rate,
'no_of_users' => $users
);
$pod->save($data);

$average = floatval($rate/$users);
echo $average;

?>