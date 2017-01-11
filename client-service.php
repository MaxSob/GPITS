<?php
require_once __DIR__.'/vendor/autoload.php';

use ApiAi\Client;

try {
    $msg = $_REQUEST["msg"];
    $client = new Client('e03c87fb65274c028b551a92de04f456');
    $query = $client->get('query', [
        'query' => $msg,
    ]);

    //$response = json_decode((string) $query->getBody(), true);
    echo $query->getBody();
} catch (\Exception $error) {
    echo $error->getMessage();
}
?>
