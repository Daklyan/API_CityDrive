<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../services/EmployeeService.php';

echo json_encode(EmployeeService::getInstance()->allEmployee());