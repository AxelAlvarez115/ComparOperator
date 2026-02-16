<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Admin Tour Operators</title>
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
            <h2 class="text-3xl font-bold">Tour Operators</h2>
            <form class="flex items-center gap-6 bg-white shadow-lg rounded-2xl p-6">
                <div class="flex flex-col">
                    <label for="name" class="text-sm font-medium text-gray-600 mb-1">Name</label>
                    <input type="text" id="name" name="name" required class="border border-gray-300 rounded-lg p-2 w-40 focus:ring-2 focus:ring-orange-400 focus:outline-none">
                </div>
                <div class="flex flex-col">
                    <label for="link" class="text-sm font-medium text-gray-600 mb-1">Link</label>
                    <input type="url" id="link" name="link" required class="border border-gray-300 rounded-lg p-2 w-60 focus:ring-2 focus:ring-orange-400 focus:outline-none">
                </div>
                <div class="flex flex-col">
                    <label for="grade_count" class="text-sm font-medium text-gray-600 mb-1">Grade Count</label>
                    <input type="number" id="grade_count" name="grade_count" required class="border border-gray-300 rounded-lg p-2 w-20 focus:ring-2 focus:ring-orange-400 focus:outline-none">
                </div>
                <div class="flex flex-col">
                    <label for="grade_total" class="text-sm font-medium text-gray-600 mb-1">Grade Total</label>
                    <input type="number" id="grade_total" name="grade_total" required class="border border-gray-300 rounded-lg p-2 w-20 focus:ring-2 focus:ring-orange-400 focus:outline-none">
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="is_premium" name="is_premium" class="w-5 h-5 text-orange-500 border-gray-300 rounded focus:ring-orange-400" >
                    <label for="is_premium" class="text-sm font-medium text-gray-700">Is Premium</label>
                </div>
                <button type="submit" class="bg-orange-500 text-white font-medium py-2 px-4 rounded-full shadow hover:bg-orange-400 transition" >Add</button>
            </form>
            <div class="bg-white shadow-md rounded-xl p-6 flex-1 overflow-hidden flex flex-col">
                <h3 class="text-xl font-bold mb-4">Tour Operators list</h3>
                <div class="overflow-auto flex-1">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-white border-b block sticky top-0 z-10">
                            <tr class="text-gray-600 grid grid-cols-7">
                                <th class="py-3">id</th>
                                <th class="py-3">Name</th>
                                <th class="py-3">link</th>
                                <th class="py-3">grade_count</th>
                                <th class="py-3">grade_total</th>
                                <th class="py-3">is_premium</th>
                                <th class="py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="block overflow-y-auto max-h-full">
                            <?php include '../../partials/data_operators.php'; ?>
                            <?php foreach ($tour_operators as $operator): ?>
                            <tr class="border-b hover:bg-gray-50 grid grid-cols-7">
                                <td class="py-3"><?= htmlspecialchars($operator['id']) ?></td>
                                <td class="py-3"><?= htmlspecialchars($operator['name']) ?></td>
                                <td class="py-3"><?= htmlspecialchars($operator['link']) ?></td>
                                <td class="py-3"><?= htmlspecialchars($operator['grade_count']) ?></td>
                                <td class="py-3"><?= htmlspecialchars($operator['grade_total']) ?></td>
                                <td class="py-3"><?= htmlspecialchars($operator['is_premium']) ?></td>
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
        <h2 class="text-2xl font-bold text-orange-600">Update Tour Operator</h2>
        <form id="updateTourOperatorForm" class="flex flex-col gap-4">
            <div class="flex flex-col">
                <label class="text-sm font-medium text-gray-600 mb-1" for="upd_name">Name</label>
                <input id="upd_name" name="name" type="text"
                       class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-400 outline-none"
                       required>
            </div>
            <div class="flex flex-col">
                <label class="text-sm font-medium text-gray-600 mb-1" for="upd_link">Link</label>
                <input id="upd_link" name="link" type="text"
                       class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-400 outline-none"
                       required>
            </div>
            <div class="flex flex-col">
                <label class="text-sm font-medium text-gray-600 mb-1" for="upd_grade">Grade Count</label>
                <input id="upd_grade" name="grade_count" type="number"
                       class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-400 outline-none"
                       required>
            </div>
            <div class="flex flex-col">
                <label class="text-sm font-medium text-gray-600 mb-1" for="upd_grade_total">Grade Total</label>
                <input id="upd_grade_total" name="grade_total" type="number"
                       class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-400 outline-none"
                       required>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-600 mb-1" for="upd_is_premium">Is Premium</label>
                <input id="upd_is_premium" name="is_premium" type="checkbox"
                       class="w-5 h-5 text-orange-500 border-gray-300 rounded focus:ring-orange-400">
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
