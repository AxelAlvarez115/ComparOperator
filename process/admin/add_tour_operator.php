<?php
require_once __DIR__ . '/../../utils/autoloader.php';
require_once __DIR__ . '/../../utils/connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /ComparOperator/admin/views/tour_operators.php');
    exit;
}

$name      = trim($_POST['name'] ?? '');
$link      = trim($_POST['link'] ?? '');
$isPremium = isset($_POST['is_premium']) ? 1 : 0;

if ($name === '' || $link === '') {
    header('Location: /ComparOperator/admin/views/tour_operators.php?error=missing_fields');
    exit;
}

$tourOperator = new TourOperator([
    'id'         => 0,
    'name'       => $name,
    'link'       => $link,
    'is_premium' => $isPremium,
]);

$repo = new TourOperatorRepository($db);
$repo->create($tourOperator);

header('Location: /ComparOperator/admin/views/tour_operators.php?success=1');
exit;
