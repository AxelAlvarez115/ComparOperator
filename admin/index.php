<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Admin Destinations</title>
</head>
<body class="bg-gray-100 text-gray-800">
    <aside class="fixed top-0 left-0 w-64 h-screen bg-white shadow-lg flex flex-col">
        <div class="p-6 border-b">
            <h1 class="text-2xl font-bold text-orange-600">Admin Panel</h1>
        </div>
        <nav class="flex-1 p-4">
            <ul class="space-y-4">
                <li><a href="/ComparOperator/admin/index.php" class="flex items-center gap-3 p-3 rounded-lg hover:bg-indigo-100 font-medium">Destinations</a></li>
                <li><a href="/ComparOperator/admin/views/tour_operators.php" class="flex items-center gap-3 p-3 rounded-lg hover:bg-indigo-100 font-medium">Tour operators</a></li>
            </ul>
        </nav>
    </aside>
    <main class="flex flex-col gap-6 ml-64 p-8 h-screen">
        <h2 class="text-3xl font-bold">Destinations</h2>
            <form class="flex items-center gap-6 bg-white shadow-lg rounded-2xl p-6">
            <div class="flex flex-col">
                <label for="location" class="text-sm font-medium text-gray-600 mb-1">Location</label>
                <input type="text" id="location" name="location" required class="border border-gray-300 rounded-lg p-2 w-40 focus:ring-2 focus:ring-orange-400 focus:outline-none">
            </div>
            <div class="flex flex-col">
                <label for="price" class="text-sm font-medium text-gray-600 mb-1">Price</label>
                <input type="number" id="price" name="price" required class="border border-gray-300 rounded-lg p-2 w-60 focus:ring-2 focus:ring-orange-400 focus:outline-none">
            </div>
            <div class="flex flex-col">
                <label for="tour_operator_id" class="text-sm font-medium text-gray-600 mb-1">Tour Operator ID</label>
                <input type="number" id="tour_operator_id" name="tour_operator_id" required class="border border-gray-300 rounded-lg p-2 w-60 focus:ring-2 focus:ring-orange-400 focus:outline-none">
            </div>
            <button type="submit" class="bg-orange-500 text-white font-medium py-2 px-4 rounded-full shadow hover:bg-orange-600 transition" >Add</button>
        </form>
        <div class="bg-white shadow-md rounded-xl p-6 flex-1 overflow-hidden flex flex-col">
            <h3 class="text-xl font-bold mb-4">Destinations list</h3>
                <div class="overflow-auto flex-1">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-white border-b block sticky top-0 z-10">
                            <tr class="text-gray-600 grid grid-cols-7">
                                <th class="py-3">id</th>
                                <th class="py-3">location</th>
                                <th class="py-3">country</th>
                                <th class="py-3">price</th>
                                <th class="py-3">tour_operator_id</th>
                            </tr>
                        </thead>
                        <tbody class="block overflow-y-auto max-h-full">
                        <?php include '../partials/data.php'; ?>
                        <?php foreach ($destinations as $destination): ?>
                            <tr class="border-b hover:bg-gray-50 grid grid-cols-7">
                                <td class="py-3"><?= htmlspecialchars($destination['id']) ?></td>
                                <td class="py-3"><?= htmlspecialchars($destination['location']) ?></td>
                                <td class="py-3"><?= htmlspecialchars($destination['country']) ?></td>
                                <td class="py-3"><?= htmlspecialchars($destination['price']) ?></td>
                                <td class="py-3"><?= htmlspecialchars($destination['tour_operator_id']) ?></td>
                                <td class="py-3">
                                    <button class="updateBtn bg-orange-500 text-white font-medium py-1 px-3 rounded-full shadow hover:bg-orange-400 transition">Update</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <div id="updateModal" class="hidden flex fixed inset-0 z-50 items-center bg-black/40 justify-center p-4">
    <div class="w-full max-w-lg bg-white rounded-2xl shadow-2xl p-6 relative flex flex-col gap-6">
        <button id="closeUpdateModal" 
                class="cursor-pointer absolute top-3 right-3 p-1 rounded-full hover:bg-gray-200 transition">
            <img src="/ComparOperator/assets/img/icons/close.svg" alt="" class="w-5 h-5">
        </button>
        <h2 class="text-2xl font-bold text-orange-600">Update Destination</h2>
        <form id="updateDestinationForm" class="flex flex-col gap-4">
            <div class="flex flex-col">
                <label class="text-sm font-medium text-gray-600 mb-1" for="upd_location">Location</label>
                <input id="upd_location" name="location" type="text"
                       class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-400 outline-none"
                       required>
            </div>
            <div class="flex flex-col">
                <label class="text-sm font-medium text-gray-600 mb-1" for="upd_country">Country</label>
                <input id="upd_country" name="country" type="text"
                       class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-400 outline-none"
                       required>
            </div>
            <div class="flex flex-col">
                <label class="text-sm font-medium text-gray-600 mb-1" for="upd_price">Price</label>
                <input id="upd_price" name="price" type="number"
                       class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-400 outline-none"
                       required>
            </div>
            <div class="flex flex-col">
                <label class="text-sm font-medium text-gray-600 mb-1" for="upd_tour_operator_id">Tour Operator ID</label>
                <input id="upd_tour_operator_id" name="tour_operator_id" type="number"
                       class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-400 outline-none"
                       required>
            </div>
            <input type="hidden" id="upd_id" name="id">
            <div class="flex justify-end gap-3 pt-2">
                <button type="button"
                        id="cancelUpdate"
                        class="px-4 py-2 rounded-full border border-gray-300 text-gray-600 hover:bg-gray-100 transition">
                    Cancel
                </button>
                <button type="submit"
                        class="px-6 py-2 bg-orange-500 text-white font-medium rounded-full shadow hover:bg-orange-600 transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
    <script src="/ComparOperator/assets/js/admin_form.js"></script>
</body>
</html>
