<?php
//fix local cors issue
// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}


require 'vendor/autoload.php';

$apiKey = '123456789101112';
$apiUrl = 'https://atlas.atdw-online.com.au/api/atlas/products';

$guzzle = new GuzzleHttp\Client();

// endpoints and filter query
$response = $guzzle->get($apiUrl, [
    'query' => [
        'key' => $apiKey,
        'term' => 'sydney',
        'cats' => 'ACCOMM',
        // Add other parameters as needed
    ],
]);

// Parse UTF-16LE encoded XML response
$xmlString = $response->getBody()->getContents();
$xml = simplexml_load_string($xmlString, null, LIBXML_NOCDATA);

// Convert XML to JSON
$json = json_encode($xml, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

// Return JSON response to the frontend
header('Content-Type: application/json');
echo $json;
