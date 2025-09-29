<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../models/onderhoudschema.php';

$onderhoudschema = new Onderhoudschema();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['attractie_id'])) {
            $data = $onderhoudschema->getByAttractieId($_GET['attractie_id']);
        } else {
            $data = $onderhoudschema->getAll();
        }
        echo json_encode($data);
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $onderhoudschema->create($data['attractie_id'], $data['onderhoud_datum'], $data['onderhoud_type']);
        echo json_encode(['message' => 'Onderhoudsschema aangemaakt']);
        break;
    default:
        http_response_code(405);
        echo json_encode(['message' => 'Methode niet toegestaan']);
        break;
}
?>