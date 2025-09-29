<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../models/attractie.php';

$attractie = new Attractie();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $data = $attractie->getAll();
        echo json_encode($data);
        break;
    default:
        http_response_code(405);
        echo json_encode(['message' => 'Methode niet toegestaan']);
        break;
}
?>