<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Invalide les sessions créées avant l'ajout du champ 'role'
if (isset($_SESSION['user']) && !isset($_SESSION['user']['role'])) {
    session_unset();
    session_destroy();
    session_start();
}

function isLoggedIn(): bool {
    return isset($_SESSION['user']['id'], $_SESSION['user']['role']);
}

function isAdmin(): bool {
    return isLoggedIn() && ($_SESSION['user']['role'] ?? '') === 'admin';
}

function currentUser(): ?array {
    if (!isLoggedIn()) return null;
    return $_SESSION['user'];
}

function setSessionUser(User $user): void {
    $_SESSION['user'] = [
        'id'       => $user->getId(),
        'username' => $user->getUsername(),
        'email'    => $user->getEmail(),
        'role'     => $user->getRole(),
    ];
}

function destroySession(): void {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    session_destroy();
}
