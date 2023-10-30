<?php

use GuzzleHttp\Client;
use GuzzleHttp\Promise;

$client = new Client(['base_uri' => 'http://127.0.0.1']);

// Initiate each request but do not block
$promises = [
    'image' => $client->getAsync('/'),
    'png'   => $client->getAsync('/'),
    'jpeg'  => $client->getAsync('/'),
    'webp'  => $client->getAsync('/')
];

$responses = Promise\Utils::unwrap($promises);

foreach ($responses as $key => $response) {
    echo $key .': '.$response->getBody()->getContents();
    echo "\n";
}
