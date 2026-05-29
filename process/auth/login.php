<?php
require_once __DIR__ . '/../../utils/autoloader.php';
require_once __DIR__ . '/../../utils/connection.php';
require_once __DIR__ . '/../../utils/session.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /ComparOperator/views/login.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$redirect = $_POST['redirect'] ?? '/ComparOperator/index.php';

// Basic sanitization of the redirect URL (only allow internal paths)
if (!str_starts_with($redirect, '/ComparOperator/')) {
    $redirect = '/ComparOperator/index.php';
}

if ($username === '' || $password === '') {
    header('Location: /ComparOperator/views/login.php?error=required&redirect=' . urlencode($redirect));
    exit;
}

$userRepo = new UserRepository($db);
$user     = $userRepo->findByUsername($username);

if (!$user || !$user->verifyPassword($password)) {
    header('Location: /ComparOperator/views/login.php?error=invalid&redirect=' . urlencode($redirect));
    exit;
}

setSessionUser($user);

header('Location: ' . $redirect);
exit;
