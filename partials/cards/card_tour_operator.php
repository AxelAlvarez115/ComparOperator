<article class="flex justify-between items-center border border-slate-200 bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition-shadow">
    <div class="flex gap-4 items-center">
        <div class="w-14 h-14 rounded-full bg-orange-50 flex items-center justify-center shrink-0">
            <img class="w-8 h-8 opacity-60" src="/ComparOperator/assets/img/icons/account_circle.svg"
                 alt="<?= htmlspecialchars($tourOperator->getName()) ?>">
        </div>
        <div>
            <div class="flex items-center gap-2">
                <h3 class="font-bold text-slate-800"><?= htmlspecialchars($tourOperator->getName()) ?></h3>
                <?php if ($tourOperator->getIsPremium()): ?>
                    <span class="text-xs bg-orange-100 text-orange-600 font-semibold px-2 py-0.5 rounded-full">Premium</span>
                <?php endif; ?>
            </div>
            <a href="<?= htmlspecialchars($tourOperator->getLink()) ?>" target="_blank"
               class="text-xs text-blue-500 hover:underline"><?= htmlspecialchars($tourOperator->getLink()) ?></a>
            <?php if ($tourOperator->getPrice() !== null): ?>
                <p class="text-teal-600 font-bold mt-0.5">€<?= $tourOperator->getPrice() ?></p>
            <?php endif; ?>
        </div>
    </div>
    <div class="flex items-center gap-3">
        <?php if (isLoggedIn()): ?>
        <button
            class="reviewBtn cursor-pointer bg-orange-400 hover:bg-white hover:text-orange-400 text-white border-2 border-orange-400 rounded-full px-4 py-1.5 text-sm font-medium transition-colors"
            data-operator-id="<?= $tourOperator->getId() ?>"
            data-operator-name="<?= htmlspecialchars($tourOperator->getName()) ?>">
            Reviews
        </button>
        <?php else: ?>
        <a href="/ComparOperator/views/login.php?redirect=<?= urlencode($_SERVER['REQUEST_URI'] ?? '/ComparOperator/') ?>"
            class="bg-orange-400 hover:bg-white hover:text-orange-400 text-white border-2 border-orange-400 rounded-full px-4 py-1.5 text-sm font-medium transition-colors">
            Reviews
        </a>
        <?php endif; ?>
        <div class="flex items-center gap-1 bg-orange-50 border border-orange-200 rounded-full px-3 py-1.5">
            <img src="/ComparOperator/assets/img/icons/star_rate.svg" alt="star" class="w-4 h-4">
            <span class="text-sm font-bold text-orange-500"><?= htmlspecialchars($tourOperator->getGradeTotal()) ?></span>
        </div>
    </div>
</article>
