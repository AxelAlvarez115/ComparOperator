<?php
require_once __DIR__ . '/utils/autoloader.php';
require_once __DIR__ . '/utils/connection.php';
require_once __DIR__ . '/utils/session.php';

$destinationRepository = new DestinationRepository($db);
$destinations = $destinationRepository->findAllMainDestination();

include 'partials/head.php';
?>
<body>
    <?php include 'partials/header.php'; ?>
    <main>
        <?php include 'partials/presentation.php'; ?>
        <section id="Destinations" class="flex flex-col gap-4 bg-white px-4 md:px-30 xl:px-70 py-10 text-slate-700">
            <div class="flex justify-between items-center mb-4 font-bold">
                <h2 class="text-2xl">Destinations</h2>
                <button id="toggleHiddenCards" class="seeAllDestinationsBtn cursor-pointer text-orange-400 hover:underline">
                    See all ↓
                </button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php foreach ($destinations as $destination): ?>
                    <?php include 'partials/cards/card_destination.php'; ?>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
    <?php include 'partials/footer.php'; ?>
    <?php include 'partials/main_scripts.php'; ?>
    <script src="/ComparOperator/assets/js/destination.js"></script>
</body>
