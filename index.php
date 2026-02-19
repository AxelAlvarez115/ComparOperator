<?php 
require_once __DIR__ . '/utils/autoloader.php';
require_once './utils/connection.php';
include 'partials/head.php';
$destinationRepository = new DestinationRepository($db);
$destinations = $destinationRepository->findAllMainDestination();
?>
<body>
    <?php include 'partials/header.php'; ?>
    <main>
        <?php include 'partials/presentation.php'; ?>
        <section id="Destinations" class="flex flex-col gap-4 bg-white px-4 md:px-30 xl:px-70 py-10 text-slate-700">
            <div class="flex justify-between items-center mb-4 font-bold">
                <h2 class="text-2xl">Destinations</h2>
                <button id="toggleHiddenCards" class="seeAllDestinationsBtn cursor-pointer text-orange-400">See all ↓</button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- boucle foreach affiche des cards destinations -->
                <?php
                foreach ($destinations as $destination) {
                    include 'partials/cards/card_destination.php';
                }
                ?>
            </div>
                <div id="reviewModal" class="fixed inset-0 bg-black/50 hidden justify-center items-center">
                <form method="POST" action="/process/post_review" class="bg-white p-6 rounded-xl w-96 shadow-lg relative">
                    <button class="closeModal absolute top-2 right-3 text-gray-600 hover:text-black text-2xl">
                        ×
                    </button>
                    <h2 class="text-xl font-bold mb-4">Let a review</h2>
                    <textarea class="reviewInput border w-full p-2 rounded-lg"
                            placeholder="Write your review here..."
                            rows="4"></textarea>

                    <button class="submitReview mt-4 w-full bg-orange-400 text-white rounded-full p-2 hover:bg-white hover:text-orange-400 border-2 border-orange-400">
                        Send Review
                    </button>
                    <div class="reviewsContainer mt-4"></div>
                </form>
            </div>
        </section>
    </main>
    <?php include 'partials/footer.php'; ?>
    <?php include 'partials/main_scripts.php'; ?>
    <script src="/ComparOperator/assets/js/destination.js"></script>
</body>