<?php
require_once __DIR__ . '/../utils/autoloader.php';
require_once __DIR__ . '/../utils/connection.php';
require_once __DIR__ . '/../utils/session.php';

$location     = $_GET['location'] ?? '';
$manager      = new Manager($db);
$tourOperators = $manager->getOperatorsByLocation($location);

include '../partials/head.php';
?>
<body>
    <?php include '../partials/header.php'; ?>
    <main>
        <?php include '../partials/presentation.php'; ?>
        <section id="TourOperators" class="flex flex-col gap-4 bg-white px-4 md:px-30 xl:px-70 py-10 text-slate-700">
            <div class="flex justify-between items-center mb-4 font-bold">
                <div>
                    <h2 class="text-2xl">Tour Operators</h2>
                    <p class="text-sm font-normal text-gray-500 mt-1">
                        <?= count($tourOperators) ?> operator<?= count($tourOperators) !== 1 ? 's' : '' ?>
                        for <span class="font-semibold text-slate-700"><?= htmlspecialchars($location) ?></span>
                    </p>
                </div>
                <a href="/ComparOperator/index.php" class="text-sm text-orange-400 hover:underline">← Back</a>
            </div>

            <?php if (empty($tourOperators)): ?>
            <div class="text-center py-16 text-gray-400">
                <p class="text-lg">No tour operators found for this destination.</p>
            </div>
            <?php else: ?>
            <div class="flex flex-col gap-4">
                <?php foreach ($tourOperators as $tourOperator): ?>
                    <?php include '../partials/cards/card_tour_operator.php'; ?>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </section>

        <!-- Review Modal -->
        <div id="reviewModal" class="fixed inset-0 bg-black/50 hidden justify-center items-center z-50 px-4">
            <div class="w-full max-w-lg bg-white rounded-2xl shadow-2xl relative overflow-hidden">
                <div class="flex items-center justify-between p-5 border-b border-gray-100">
                    <h2 class="text-xl font-bold" id="modalOperatorName">Reviews</h2>
                    <button id="closeModal" class="cursor-pointer p-1 rounded-full hover:bg-gray-100 transition">
                        <img src="/ComparOperator/assets/img/icons/close.svg" alt="close" class="w-5 h-5">
                    </button>
                </div>

                <div id="reviewsContainer" class="max-h-64 overflow-y-auto p-5 flex flex-col gap-3">
                    <p class="text-gray-400 text-sm text-center py-4" id="noReviewsMsg">No reviews yet. Be the first!</p>
                </div>

                <div class="p-5 border-t border-gray-100">
                    <h3 class="font-semibold mb-3">Leave a review</h3>
                    <form id="reviewForm" class="flex flex-col gap-3">
                        <input type="hidden" id="operatorId" name="tour_operator_id">
                        <div class="flex gap-2">
                            <input
                                class="border border-gray-300 rounded-lg p-2.5 w-1/3 outline-none focus:ring-2 focus:ring-orange-400 text-sm"
                                type="text"
                                id="reviewUsername"
                                name="username"
                                placeholder="Your name"
                                required>
                            <input
                                class="border border-gray-300 rounded-lg p-2.5 flex-1 outline-none focus:ring-2 focus:ring-orange-400 text-sm"
                                type="text"
                                id="reviewContent"
                                name="content"
                                placeholder="Share your experience..."
                                required>
                        </div>
                        <button
                            type="submit"
                            class="bg-orange-400 text-white font-medium py-2.5 rounded-full hover:bg-orange-500 transition">
                            Send Review
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include '../partials/footer.php'; ?>
    <?php include '../partials/main_scripts.php'; ?>
    <script src="/ComparOperator/assets/js/review_form.js"></script>
</body>
