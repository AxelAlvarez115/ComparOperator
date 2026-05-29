<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../utils/autoloader.php';
require_once __DIR__ . '/../utils/connection.php';
require_once __DIR__ . '/../utils/session.php';

if (!isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['error' => 'Authentication required']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$username       = trim($data['username'] ?? '');
$content        = trim($data['content'] ?? '');
$tourOperatorId = (int) ($data['tour_operator_id'] ?? 0);
$gradeRaw       = $data['grade'] ?? null;
$grade          = ($gradeRaw !== null) ? (int) $gradeRaw : null;
if ($grade !== null && ($grade < 1 || $grade > 5)) $grade = null;

if ($username === '' || $content === '' || $tourOperatorId <= 0) {
    http_response_code(422);
    echo json_encode(['error' => 'Missing required fields']);
    exit;
}

$manager = new Manager($db);

try {
    $success = $manager->createReview($content, $tourOperatorId, $username, $grade);

    if ($success) {
        // Valeurs brutes : l'échappement est fait côté client (escapeHtml dans review_form.js).
        echo json_encode([
            'success'  => true,
            'username' => $username,
            'content'  => $content,
            'grade'    => $grade,
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to save review']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server error']);
}
