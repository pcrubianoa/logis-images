<?php

// get the raw POST data
$rawData = file_get_contents("php://input");

// this returns null if not valid json
return json_decode($rawData, true);  // will return array