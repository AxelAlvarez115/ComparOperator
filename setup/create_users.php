<?php
/**
 * Script de création des comptes par défaut.
 *
 * ⚠ À exécuter UNE SEULE FOIS après l'import du fichier SQL.
 * Accessible via : http://localhost/ComparOperator/setup/create_users.php
 *
 * Supprimez ou désactivez ce fichier en production.
 */

require_once __DIR__ . '/../utils/autoloader.php';
require_once __DIR__ . '/../utils/connection.php';

$users = [
    [
        'username' => 'admin',
        'email'    => 'admin@comparoperator.com',
        'password' => 'admin123',
        'role'     => 'admin',
    ],
    [
        'username' => 'visiteur',
        'email'    => 'visiteur@comparoperator.com',
        'password' => 'user123',
        'role'     => 'user',
    ],
];

$repo    = new UserRepository($db);
$results = [];

foreach ($users as $u) {
    if ($repo->exists($u['username'])) {
        $results[] = ['status' => 'skipped', 'username' => $u['username'],
                      'reason' => 'already exists'];
    } else {
        $ok = $repo->create($u['username'], $u['email'], $u['password'], $u['role']);
        $results[] = ['status' => $ok ? 'created' : 'error', 'username' => $u['username']];
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Setup – ComparOperator</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 560px; margin: 60px auto; padding: 0 20px; color: #334155; }
        h1   { font-size: 1.5rem; margin-bottom: 4px; }
        p    { color: #64748b; margin-bottom: 24px; font-size: .9rem; }
        .card { border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; }
        .row  { display: flex; justify-content: space-between; align-items: center;
                padding: 14px 20px; border-bottom: 1px solid #f1f5f9; gap: 12px; }
        .row:last-child { border-bottom: none; }
        .badge { font-size: .75rem; font-weight: 600; padding: 3px 10px; border-radius: 999px; }
        .created { background: #dcfce7; color: #16a34a; }
        .skipped { background: #fef9c3; color: #854d0e; }
        .error   { background: #fee2e2; color: #dc2626; }
        .creds   { font-size: .8rem; color: #64748b; }
        .warn    { margin-top: 20px; background: #fff7ed; border: 1px solid #fed7aa;
                   border-radius: 10px; padding: 14px 18px; font-size: .85rem; color: #9a3412; }
        a { color: #f97316; font-weight: 600; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Compar<span style="color:#f97316">Operator</span> – Setup</h1>
    <p>Création des comptes utilisateurs par défaut.</p>

    <div class="card">
        <?php foreach ($results as $r): ?>
        <div class="row">
            <div>
                <strong><?= htmlspecialchars($r['username']) ?></strong>
                <?php if ($r['status'] === 'created'): ?>
                    <div class="creds">
                        <?php foreach ($users as $u): if ($u['username'] !== $r['username']) continue; ?>
                            <?= htmlspecialchars($u['email']) ?> · mot de passe : <code><?= htmlspecialchars($u['password']) ?></code>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($r['reason'])): ?>
                    <div class="creds"><?= htmlspecialchars($r['reason']) ?></div>
                <?php endif; ?>
            </div>
            <span class="badge <?= $r['status'] ?>">
                <?= match($r['status']) {
                    'created' => '✓ Créé',
                    'skipped' => '⚠ Déjà existant',
                    default   => '✕ Erreur',
                } ?>
            </span>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="warn">
        ⚠ <strong>Supprimez ou protégez ce fichier avant la mise en production.</strong><br>
        Il permet de créer des comptes sans authentification.
    </div>

    <p style="margin-top:20px">
        <a href="/ComparOperator/views/login.php">→ Aller à la page de connexion</a>
    </p>
</body>
</html>
