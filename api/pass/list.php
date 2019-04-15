<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../services/PASSService.php';

echo json_encode(PASSService::getInstance()->allPASS());

?>
