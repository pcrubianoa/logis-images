<?php

echo "<h1>Receiver:</h1>";

$response = json_decode($response->getBody());
print_r($response);