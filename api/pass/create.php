<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../services/PASSService.php';
require_once __DIR__ . '/../../utils/Validator.php';

$body = file_get_contents('php://input'); // read body as a string

$json = json_decode($body, true); // true -> decode as array

if(Validator::validate($json, ['name', 'price'])) {
  $pass = new PASS(NULL,
                   $json['name'],
                  $json['price']);
  $new = PASSService::getInstance()->insertPASS($pass);
  if($new) {
    http_response_code(201);
    echo json_encode($new);
  } else {
    http_response_code(500); // fail :(
  }
} else {
  http_response_code(400);
}

?>
