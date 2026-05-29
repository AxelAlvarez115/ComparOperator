<?php
require_once __DIR__ . '/../utils/session.php';

// Redirect if already logged in
if (isLoggedIn()) {
    header('Location: /ComparOperator/index.php');
    exit;
}

$error    = $_GET['error']    ?? null;
$redirect = $_GET['redirect'] ?? '/ComparOperator/index.php';

$errorMessages = [
    'invalid'  => 'Identifiant ou mot de passe incorrect.',
    'required' => 'Veuillez remplir tous les champs.',
    'inactive' => 'Ce compte est désactivé.',
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="/ComparOperator/assets/css/main.css">
    <title>Connexion – ComparOperator</title>
</head>
<body class="min-h-screen bg-gray-50 flex flex-col">

    <!-- Minimal header -->
    <header class="bg-white border-b border-gray-100 px-6 py-4">
        <a href="/ComparOperator/index.php"
           class="text-xl font-bold text-slate-800 hover:opacity-80 transition">
            Compar<span class="text-orange-400">Operator</span>
        </a>
    </header>

    <!-- Login card -->
    <main class="flex-1 flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-sm">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <h1 class="text-2xl font-bold text-slate-800 mb-1">Connexion</h1>
                <p class="text-sm text-gray-500 mb-6">Accédez à votre espace ComparOperator.</p>

                <?php if ($error && isset($errorMessages[$error])): ?>
                <div class="mb-5 flex items-center gap-2 bg-red-50 border border-red-200 text-red-600 rounded-xl px-4 py-3 text-sm">
                    <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <?= htmlspecialchars($errorMessages[$error]) ?>
                </div>
                <?php endif; ?>

                <form method="POST" action="/ComparOperator/process/auth/login.php" class="flex flex-col gap-4">
                    <input type="hidden" name="redirect" value="<?= htmlspecialchars($redirect) ?>">

                    <div class="flex flex-col gap-1">
                        <label for="username" class="text-sm font-medium text-gray-700">
                            Identifiant
                        </label>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            required
                            autofocus
                            autocomplete="username"
                            class="border border-gray-300 rounded-xl p-3 text-sm outline-none focus:ring-2 focus:ring-orange-400 focus:border-transparent transition"
                            placeholder="Votre identifiant">
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="password" class="text-sm font-medium text-gray-700">
                            Mot de passe
                        </label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            class="border border-gray-300 rounded-xl p-3 text-sm outline-none focus:ring-2 focus:ring-orange-400 focus:border-transparent transition"
                            placeholder="••••••••">
                    </div>

                    <button
                        type="submit"
                        class="mt-2 w-full bg-orange-400 hover:bg-orange-500 text-white font-semibold py-3 rounded-xl transition">
                        Se connecter
                    </button>
                </form>
            </div>

            <p class="text-center text-xs text-gray-400 mt-6">
                Vous n'avez pas de compte ? Contactez un administrateur.
            </p>
        </div>
    </main>

</body>
</html>
