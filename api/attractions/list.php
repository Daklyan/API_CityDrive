<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../services/AttractionService.php';

echo json_encode(AttractionService::getInstance()->allAttractions());

?>
