<?php
require_once __DIR__ . '/../../utils/autoloader.php';
require_once __DIR__ . '/../../utils/connection.php';
require_once __DIR__ . '/../../utils/auth_guard.php';

$repo          = new TourOperatorRepository($db);
$scoreRepo     = new ScoreRepository($db);
$tourOperators = $repo->findAll();
$success       = isset($_GET['success']);
$error         = $_GET['error'] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="/ComparOperator/assets/css/main.css">
    <title>Admin – Tour Operators</title>
</head>
<body class="bg-gray-100 text-gray-800">

    <?php $authUser = currentUser(); ?>
    <aside class="fixed top-0 left-0 w-64 h-screen bg-white shadow-lg flex flex-col">
        <div class="p-6 border-b">
            <h1 class="text-2xl font-bold text-orange-500">Admin Panel</h1>
            <p class="text-xs text-gray-400 mt-1"><?= htmlspecialchars($authUser['username'] ?? '') ?></p>
        </div>
        <nav class="flex-1 p-4">
            <ul class="space-y-2">
                <li>
                    <a href="/ComparOperator/admin/index.php"
                       class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 font-medium transition">
                        Destinations
                    </a>
                </li>
                <li>
                    <a href="/ComparOperator/admin/views/tour_operators.php"
                       class="flex items-center gap-3 p-3 rounded-lg bg-orange-50 text-orange-600 font-semibold">
                        Tour Operators
                    </a>
                </li>
            </ul>
        </nav>
        <div class="p-4 border-t flex flex-col gap-2">
            <a href="/ComparOperator/index.php" class="text-sm text-gray-500 hover:text-orange-500 transition">← Retour au site</a>
            <a href="/ComparOperator/process/auth/logout.php" class="text-sm text-red-400 hover:text-red-600 transition">Déconnexion</a>
        </div>
    </aside>

    <main class="ml-64 p-8 min-h-screen flex flex-col gap-6">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold">Tour Operators</h2>
            <?php if ($success): ?>
                <span class="text-green-600 text-sm font-medium bg-green-50 px-3 py-1 rounded-full">Saved successfully</span>
            <?php elseif ($error): ?>
                <span class="text-red-600 text-sm font-medium bg-red-50 px-3 py-1 rounded-full">Error: <?= htmlspecialchars($error) ?></span>
            <?php endif; ?>
        </div>

        <!-- Add form -->
        <form
            method="POST"
            action="/ComparOperator/process/admin/add_tour_operator.php"
            class="flex flex-wrap items-end gap-4 bg-white shadow rounded-2xl p-6">
            <div class="flex flex-col">
                <label for="name" class="text-xs font-medium text-gray-500 mb-1">Name *</label>
                <input type="text" id="name" name="name" required
                       class="border border-gray-300 rounded-lg p-2 w-40 focus:ring-2 focus:ring-orange-400 focus:outline-none text-sm">
            </div>
            <div class="flex flex-col">
                <label for="link" class="text-xs font-medium text-gray-500 mb-1">Website URL *</label>
                <input type="url" id="link" name="link" required
                       class="border border-gray-300 rounded-lg p-2 w-52 focus:ring-2 focus:ring-orange-400 focus:outline-none text-sm">
            </div>
            <div class="flex items-center gap-2 pb-0.5">
                <input type="checkbox" id="is_premium" name="is_premium"
                       class="w-4 h-4 accent-orange-500">
                <label for="is_premium" class="text-sm font-medium text-gray-700">Premium</label>
            </div>
            <button type="submit"
                    class="bg-orange-500 text-white font-medium py-2 px-5 rounded-full hover:bg-orange-600 transition text-sm">
                Add Operator
            </button>
        </form>

        <!-- Table -->
        <div class="bg-white shadow rounded-xl p-6 flex-1 overflow-hidden flex flex-col">
            <h3 class="text-lg font-bold mb-4">Operators list
                <span class="text-gray-400 font-normal text-sm ml-2"><?= count($tourOperators) ?> entries</span>
            </h3>
            <div class="overflow-auto flex-1">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                        <tr>
                            <th class="py-3 px-4">ID</th>
                            <th class="py-3 px-4">Name</th>
                            <th class="py-3 px-4">Website</th>
                            <th class="py-3 px-4">Avg. Score</th>
                            <th class="py-3 px-4">Premium</th>
                            <th class="py-3 px-4"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                    <?php foreach ($tourOperators as $operator): ?>
                        <?php $avgScore = $scoreRepo->getAverageByTourOperator($operator->getId()); ?>
                        <tr class="hover:bg-gray-50 transition"
                            data-id="<?= $operator->getId() ?>"
                            data-name="<?= htmlspecialchars($operator->getName()) ?>"
                            data-link="<?= htmlspecialchars($operator->getLink()) ?>"
                            data-is-premium="<?= (int) $operator->getIsPremium() ?>">
                            <td class="py-3 px-4 text-gray-400"><?= $operator->getId() ?></td>
                            <td class="py-3 px-4 font-medium"><?= htmlspecialchars($operator->getName()) ?></td>
                            <td class="py-3 px-4">
                                <a href="<?= htmlspecialchars($operator->getLink()) ?>"
                                   target="_blank"
                                   class="text-blue-500 hover:underline truncate max-w-xs block">
                                    <?= htmlspecialchars($operator->getLink()) ?>
                                </a>
                            </td>
                            <td class="py-3 px-4">
                                <?php if ($avgScore !== null): ?>
                                    <span class="flex items-center gap-1 text-orange-500 font-semibold">
                                        <?= $avgScore ?>
                                        <img src="/ComparOperator/assets/img/icons/star_rate.svg" class="w-4 h-4" alt="">
                                    </span>
                                <?php else: ?>
                                    <span class="text-gray-400">—</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3 px-4">
                                <?php if ($operator->getIsPremium()): ?>
                                    <span class="bg-orange-100 text-orange-600 text-xs font-semibold px-2 py-0.5 rounded-full">Premium</span>
                                <?php else: ?>
                                    <span class="text-gray-400">—</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3 px-4">
                                <button class="updateBtn text-orange-500 hover:underline text-sm font-medium cursor-pointer">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Update Modal -->
    <div id="updateModal" class="hidden fixed inset-0 z-50 items-center bg-black/40 justify-center p-4">
        <div class="w-full max-w-lg bg-white rounded-2xl shadow-2xl p-6 relative flex flex-col gap-5">
            <button id="closeUpdateModal"
                    class="cursor-pointer absolute top-3 right-3 p-1 rounded-full hover:bg-gray-100 transition">
                <img src="/ComparOperator/assets/img/icons/close.svg" alt="" class="w-5 h-5">
            </button>
            <h2 class="text-xl font-bold text-orange-500">Edit Tour Operator</h2>
            <form id="updateTourOperatorForm" class="flex flex-col gap-4">
                <div class="flex flex-col">
                    <label class="text-xs font-medium text-gray-500 mb-1" for="upd_name">Name</label>
                    <input id="upd_name" name="name" type="text"
                           class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-400 outline-none text-sm" required>
                </div>
                <div class="flex flex-col">
                    <label class="text-xs font-medium text-gray-500 mb-1" for="upd_link">Website URL</label>
                    <input id="upd_link" name="link" type="text"
                           class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-400 outline-none text-sm" required>
                </div>
                <div class="flex items-center gap-2">
                    <input id="upd_is_premium" name="is_premium" type="checkbox"
                           class="w-4 h-4 accent-orange-500">
                    <label class="text-sm font-medium text-gray-700" for="upd_is_premium">Premium operator</label>
                </div>
                <input type="hidden" id="upd_id" name="id">
                <div class="flex justify-end gap-3 pt-1">
                    <button type="button" id="cancelUpdate"
                            class="px-4 py-2 rounded-full border border-gray-300 text-gray-600 hover:bg-gray-50 transition text-sm">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-5 py-2 bg-orange-500 text-white font-medium rounded-full hover:bg-orange-600 transition text-sm">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="/ComparOperator/assets/js/admin_form.js"></script>
    <script>
    document.getElementById('updateTourOperatorForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const payload = {
            id:         parseInt(document.getElementById('upd_id').value),
            name:       document.getElementById('upd_name').value,
            link:       document.getElementById('upd_link').value,
            is_premium: document.getElementById('upd_is_premium').checked,
        };
        const res = await fetch('/ComparOperator/process/admin/update_tour_operator.php', {
            method:  'POST',
            headers: { 'Content-Type': 'application/json' },
            body:    JSON.stringify(payload),
        });
        const data = await res.json();
        if (data.success) {
            location.reload();
        } else {
            alert('Error saving changes.');
        }
    });
    </script>
</body>
</html>
