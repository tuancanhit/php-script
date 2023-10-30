<?php

// CLIENT
use GuzzleHttp\Client;
use GuzzleHttp\Promise;

$client = new Client(['base_uri' => 'http://127.0.0.1']);

// Initiate each request but do not block
$promises = [
    'image' => $client->getAsync('/?type=image'),
    'png'   => $client->getAsync('/?type=png'),
    'jpeg'  => $client->getAsync('/?type=jpeg'),
    'webp'  => $client->getAsync('/?type=webp')
];

$responses = Promise\Utils::unwrap($promises);

foreach ($responses as $key => $response) {
    echo $key .': '.$response->getBody()->getContents();
    echo "\n";
}

?>

<?php

// SERVER
sleep(1);
$now = DateTime::createFromFormat('U.u', microtime(true));
$now = $now->format("Y-m-d H:i:s.u");
header('Content-Type: application/json; charset=utf-8');
echo json_encode(['execute_time' => $now]);

?>

Result:

image: {"execute_time":"2023-10-30 08:16:55.102500"}
png: {"execute_time":"2023-10-30 08:16:55.105900"}
jpeg: {"execute_time":"2023-10-30 08:16:55.105800"}
webp: {"execute_time":"2023-10-30 08:16:55.312200"}
