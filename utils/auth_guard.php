<?php

require_once __DIR__ . '/session.php';

if (!isLoggedIn() || !isAdmin()) {
    $redirect = urlencode($_SERVER['REQUEST_URI']);
    header('Location: /ComparOperator/views/login.php?redirect=' . $redirect);
    exit;
}
