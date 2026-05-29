<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../../utils/autoloader.php';
require_once __DIR__ . '/../../utils/connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$id             = (int) ($data['id'] ?? 0);
$location       = trim($data['location'] ?? '');
$country        = trim($data['country'] ?? '');
$price          = (int) ($data['price'] ?? 0);
$tourOperatorId = (int) ($data['tour_operator_id'] ?? 0);

if ($id <= 0 || $location === '' || $country === '' || $price <= 0) {
    http_response_code(422);
    echo json_encode(['error' => 'Missing required fields']);
    exit;
}

$destinationRepo = new DestinationRepository($db);
$success = $destinationRepo->update($id, $location, $country, $price, $tourOperatorId);

echo json_encode(['success' => $success]);
