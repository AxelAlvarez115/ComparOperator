<?php 
require_once  '../utils/autoloader.php';
require_once '../utils/connection.php';
include '../partials/head.php';
$tourOperatorRepository = new TourOperatorRepository($db);
$tourOperators = $tourOperatorRepository->findByLocation($_GET['location'] ?? '');
?>
<body>
    <?php include '../partials/header.php'; ?>
    <main>
        <?php include '../partials/presentation.php'; ?>
        <section id="TourOperators" class="flex flex-col gap-4 bg-white px-4 xl:px-70 md:px-30 py-10 text-slate-700">
    <div class="flex justify-between items-center mb-4 font-bold">
        <h2 class="text-2xl">Tour Operators for <?= htmlspecialchars($_GET['location'] ?? '') ?></h2>
    </div>
    <div class="flex flex-col gap-4">
        <!-- boucle foreach affiche des cards tour operators -->
         <?php
         foreach ($tourOperators as $tourOperator) {
            include '../partials/cards/card_tour_operator.php';
         }
         ?>
    </div>
    </section>
    <div id="reviewModal" class="px-4 md:px-30 xl:px-70 fixed inset-0 bg-black/50 hidden justify-center items-center">
        <div class="w-full p-6 bg-white rounded-xl shadow-lg relative">
            <button id="closeModal" class="cursor-pointer absolute top-3 right-3 p-1 rounded-full hover:bg-gray-200 transition">
                <img src="/ComparOperator/assets/img/icons/close.svg" alt="">
            </button>
            <h2 class="text-xl font-bold mb-4">Reviews</h2>
            <div class="max-h-64 overflow-y-auto mb-4 flex flex-col gap-2">
                <?php 
                for ($i = 1; $i <= 5; $i++) {
                include '../partials/cards/card_review.php';
                }
                ?>
            </div>
            <h2 class="text-xl font-bold mb-4">Let a Review</h2>
            <form class="flex text-lg p-2 items-center rounded-full bg-gray-100 border border-gray-300" id="chat-form">
                <input class="p-2 w-1/6 border-r border-gray-300 outline-none rounded-l-full" type="text" id="username" name="username" placeholder="Username" required>
                <input class="p-2 pl-4 w-5/6 outline-none rounded-r-full" type="text" id="content" name="content" placeholder="Type your message..." required>
                <button type="submit" class="hidden"></button>
            </form>
            <div class="reviewsContainer mt-4"></div>
        </div>
    </div>
    </main>
    <?php include '../partials/footer.php'; ?>
    <?php include '../partials/main_scripts.php'; ?>
    <script src="/ComparOperator/assets/js/review_form.js"></script>
</body>