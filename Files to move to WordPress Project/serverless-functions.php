<?php
require ($_SERVER["DOCUMENT_ROOT"] . '/thesispoc/vendor/autoload.php' );
/*
 * Main serverless functions
 */

function serv_wptexturize($title){
	$client = new GuzzleHttp\Client();
	$filteredTitle = urlencode($title);
	$response = $client->get('https://v2y230wfv1.execute-api.us-east-1.amazonaws.com/Prod?title=' . $filteredTitle, ['verify' => false]);
	$element = json_decode($response->getBody(), true);
	return $element['filtered'];
}