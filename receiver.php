<?php

echo "<h1>Receiver:</h1>";

$input_date_from_client = file_get_contents('php://input');
var_dump($input_date_from_client);