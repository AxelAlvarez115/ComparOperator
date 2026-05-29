<?php
require_once __DIR__ . '/../../utils/autoloader.php';
require_once __DIR__ . '/../../utils/connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /ComparOperator/admin/index.php');
    exit;
}

$location       = trim($_POST['location'] ?? '');
$country        = trim($_POST['country'] ?? '');
$price          = (int) ($_POST['price'] ?? 0);
$image          = trim($_POST['image'] ?? '');
$tourOperatorId = (int) ($_POST['tour_operator_id'] ?? 0);

if ($location === '' || $country === '' || $price <= 0) {
    header('Location: /ComparOperator/admin/index.php?error=missing_fields');
    exit;
}

$destinationRepo = new DestinationRepository($db);
$destinationRepo->create($location, $country, $price, $image, $tourOperatorId);

header('Location: /ComparOperator/admin/index.php?success=1');
exit;
