<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../utils/autoloader.php';
require_once __DIR__ . '/../utils/connection.php';

$tourOperatorId = (int) ($_GET['tour_operator_id'] ?? 0);

if ($tourOperatorId <= 0) {
    http_response_code(422);
    echo json_encode(['error' => 'Invalid tour_operator_id']);
    exit;
}

$reviewRepo = new ReviewRepository($db);
$reviews    = $reviewRepo->findByTourOperator($tourOperatorId);

$result = array_map(fn($r) => [
    'username' => htmlspecialchars($r->getUsername()),
    'content'  => htmlspecialchars($r->getContent()),
], $reviews);

echo json_encode($result);
