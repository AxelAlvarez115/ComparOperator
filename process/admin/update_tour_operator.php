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

$id        = (int) ($data['id'] ?? 0);
$name      = trim($data['name'] ?? '');
$link      = trim($data['link'] ?? '');
$isPremium = (bool) ($data['is_premium'] ?? false);

if ($id <= 0 || $name === '' || $link === '') {
    http_response_code(422);
    echo json_encode(['error' => 'Missing required fields']);
    exit;
}

$repo    = new TourOperatorRepository($db);
$success = $repo->update($id, $name, $link, $isPremium);

echo json_encode(['success' => $success]);
