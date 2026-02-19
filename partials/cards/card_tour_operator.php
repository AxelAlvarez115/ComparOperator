<card class="flex justify-between items-center border border-slate-300 p-4 rounded-lg font-bold">
    <div class="flex gap-4 items-center">
        <img class="w-17 h-17" src="/ComparOperator/assets/img/icons/account_circle.svg" alt="<?= htmlspecialchars($tour_operator->getName()) ?>">
        <div>
            <h3><?= htmlspecialchars($tour_operator->getName()) ?></h3>
            <span class="text-teal-600">€<?= htmlspecialchars($tour_operator->getPrice()) ?></span>
        </div>
    </div>
    <div class="flex items-center gap-4">
        <button id="<?= $tour_operator->getId() ?>" class="reviewBtn cursor-pointer bg-orange-400 hover:bg-white hover:text-orange-400 text-white border-2 border-orange-400 rounded-full p-2">Review</button>
        <button class="flex gap-1.5 cursor-pointer bg-orange-400 hover:bg-white hover:text-orange-400 text-white border-2 border-orange-400 rounded-full p-1.5 transition-colors">
            <span class="ml-1.5"><?= htmlspecialchars($tour_operator->getGradeTotal()) ?></span>
            <img src="/ComparOperator/assets/img/icons/star_rate.svg" alt="star-rate">
        </button>
    </div>
</card>
