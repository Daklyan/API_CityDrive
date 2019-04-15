                                                                                                                                                                                                                                                            <?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../services/AttractionService.php';
require_once __DIR__ . '/../../utils/Validator.php';

$body = file_get_contents('php://input'); // read body as a string

$json = json_decode($body, true); // true -> decode as array

if(Validator::validate($json, ['name', 'minHeight', 'capacity', 'duration'])) {
  $attraction = new Attraction(NULL,
                               $json['name'],
                               $json['capacity'],
                               $json['minHeight'],
                               $json['duration']);
  $new = AttractionService::getInstance()->insertAttraction($attraction);
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
