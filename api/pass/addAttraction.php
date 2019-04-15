<?php

ini_set('display_errors', 1);

require_once __DIR__ . '/../../services/PASSService.php';
require_once __DIR__ . '/../../services/AttractionService.php';
require_once __DIR__ . '/../../utils/Validator.php';

if(Validator::validate($_GET, ['id_pass', 'id_attraction'])) {

  $pass = PASSService::getInstance()->getById($_GET['id_pass']);
  $attr = AttractionService::getInstance()->getById($_GET['id_attraction']);

  if($pass && $attr) {
    $success = PASSService::getInstance()->linkAttraction($pass, $attr);
    if($success) {
      http_response_code(204);
    } else {
      http_response_code(409);
    }
  } else {
    http_response_code(404);
  }
} else {
  http_response_code(400);
}



?>
