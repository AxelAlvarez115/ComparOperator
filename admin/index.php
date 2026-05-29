<?php
require_once __DIR__ . '/../utils/autoloader.php';
require_once __DIR__ . '/../utils/connection.php';
require_once __DIR__ . '/../utils/auth_guard.php';

$destinationRepo = new DestinationRepository($db);
$destinations    = $destinationRepo->findAll();
$success         = isset($_GET['success']);
$error           = $_GET['error'] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="/ComparOperator/assets/css/main.css">
    <title>Admin – Destinations</title>
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
                       class="flex items-center gap-3 p-3 rounded-lg bg-orange-50 text-orange-600 font-semibold">
                        Destinations
                    </a>
                </li>
                <li>
                    <a href="/ComparOperator/admin/views/tour_operators.php"
                       class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 font-medium transition">
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
            <h2 class="text-3xl font-bold">Destinations</h2>
            <?php if ($success): ?>
                <span class="text-green-600 text-sm font-medium bg-green-50 px-3 py-1 rounded-full">Saved successfully</span>
            <?php elseif ($error): ?>
                <span class="text-red-600 text-sm font-medium bg-red-50 px-3 py-1 rounded-full">Error: <?= htmlspecialchars($error) ?></span>
            <?php endif; ?>
        </div>

        <!-- Add form -->
        <form
            method="POST"
            action="/ComparOperator/process/admin/add_destination.php"
            class="flex flex-wrap items-end gap-4 bg-white shadow rounded-2xl p-6">
            <div class="flex flex-col">
                <label for="location" class="text-xs font-medium text-gray-500 mb-1">Location *</label>
                <input type="text" id="location" name="location" required
                       class="border border-gray-300 rounded-lg p-2 w-36 focus:ring-2 focus:ring-orange-400 focus:outline-none text-sm">
            </div>
            <div class="flex flex-col">
                <label for="country" class="text-xs font-medium text-gray-500 mb-1">Country *</label>
                <input type="text" id="country" name="country" required
                       class="border border-gray-300 rounded-lg p-2 w-36 focus:ring-2 focus:ring-orange-400 focus:outline-none text-sm">
            </div>
            <div class="flex flex-col">
                <label for="price" class="text-xs font-medium text-gray-500 mb-1">Price (€) *</label>
                <input type="number" id="price" name="price" min="1" required
                       class="border border-gray-300 rounded-lg p-2 w-28 focus:ring-2 focus:ring-orange-400 focus:outline-none text-sm">
            </div>
            <div class="flex flex-col">
                <label for="image" class="text-xs font-medium text-gray-500 mb-1">Image filename</label>
                <input type="text" id="image" name="image" placeholder="e.g. paris.jpg"
                       class="border border-gray-300 rounded-lg p-2 w-36 focus:ring-2 focus:ring-orange-400 focus:outline-none text-sm">
            </div>
            <div class="flex flex-col">
                <label for="tour_operator_id" class="text-xs font-medium text-gray-500 mb-1">Tour Operator ID</label>
                <input type="number" id="tour_operator_id" name="tour_operator_id" value="0" min="0"
                       class="border border-gray-300 rounded-lg p-2 w-28 focus:ring-2 focus:ring-orange-400 focus:outline-none text-sm">
            </div>
            <button type="submit"
                    class="bg-orange-500 text-white font-medium py-2 px-5 rounded-full hover:bg-orange-600 transition text-sm">
                Add Destination
            </button>
        </form>

        <!-- Table -->
        <div class="bg-white shadow rounded-xl p-6 flex-1 overflow-hidden flex flex-col">
            <h3 class="text-lg font-bold mb-4">Destinations list
                <span class="text-gray-400 font-normal text-sm ml-2"><?= count($destinations) ?> entries</span>
            </h3>
            <div class="overflow-auto flex-1">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                        <tr>
                            <th class="py-3 px-4">ID</th>
                            <th class="py-3 px-4">Location</th>
                            <th class="py-3 px-4">Country</th>
                            <th class="py-3 px-4">Price</th>
                            <th class="py-3 px-4">Operator ID</th>
                            <th class="py-3 px-4"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                    <?php foreach ($destinations as $destination): ?>
                        <tr class="hover:bg-gray-50 transition"
                            data-id="<?= $destination->getId() ?>"
                            data-location="<?= htmlspecialchars($destination->getLocation()) ?>"
                            data-country="<?= htmlspecialchars($destination->getCountry()) ?>"
                            data-price="<?= $destination->getPrice() ?>"
                            data-tour-operator-id="<?= $destination->getTourOperatorId() ?>">
                            <td class="py-3 px-4 text-gray-400"><?= $destination->getId() ?></td>
                            <td class="py-3 px-4 font-medium"><?= htmlspecialchars($destination->getLocation()) ?></td>
                            <td class="py-3 px-4"><?= htmlspecialchars($destination->getCountry()) ?></td>
                            <td class="py-3 px-4 text-teal-600 font-semibold">€<?= $destination->getPrice() ?></td>
                            <td class="py-3 px-4"><?= $destination->getTourOperatorId() ?></td>
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
            <h2 class="text-xl font-bold text-orange-500">Edit Destination</h2>
            <form id="updateDestinationForm" class="flex flex-col gap-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col">
                        <label class="text-xs font-medium text-gray-500 mb-1" for="upd_location">Location</label>
                        <input id="upd_location" name="location" type="text"
                               class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-400 outline-none text-sm" required>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-xs font-medium text-gray-500 mb-1" for="upd_country">Country</label>
                        <input id="upd_country" name="country" type="text"
                               class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-400 outline-none text-sm" required>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-xs font-medium text-gray-500 mb-1" for="upd_price">Price (€)</label>
                        <input id="upd_price" name="price" type="number" min="1"
                               class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-400 outline-none text-sm" required>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-xs font-medium text-gray-500 mb-1" for="upd_tour_operator_id">Tour Operator ID</label>
                        <input id="upd_tour_operator_id" name="tour_operator_id" type="number" min="0"
                               class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-400 outline-none text-sm">
                    </div>
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
    document.getElementById('updateDestinationForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const payload = {
            id:               parseInt(document.getElementById('upd_id').value),
            location:         document.getElementById('upd_location').value,
            country:          document.getElementById('upd_country').value,
            price:            parseInt(document.getElementById('upd_price').value),
            tour_operator_id: parseInt(document.getElementById('upd_tour_operator_id').value) || 0,
        };
        const res = await fetch('/ComparOperator/process/admin/update_destination.php', {
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
