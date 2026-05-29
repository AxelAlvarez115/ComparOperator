<article class="w-full border border-gray-100 rounded-xl p-3 bg-gray-50 flex justify-between items-start gap-4">
    <div class="flex-1 min-w-0">
        <div class="flex items-center gap-2 mb-1">
            <span class="font-semibold text-sm text-slate-800"><?= htmlspecialchars($review->getUsername()) ?></span>
            <span class="text-xs text-gray-400">·</span>
            <span class="text-xs text-gray-400 italic">today</span>
        </div>
        <p class="text-sm text-gray-700 leading-relaxed"><?= htmlspecialchars($review->getContent()) ?></p>
    </div>
    <?php if ($review->getGrade() !== null): ?>
    <div class="flex items-center gap-1 bg-orange-50 border border-orange-200 rounded-full px-2.5 py-1 shrink-0">
        <span class="text-xs font-bold text-orange-500"><?= $review->getGrade() ?></span>
        <img src="/ComparOperator/assets/img/icons/star_rate.svg" alt="star" class="w-3.5 h-3.5">
    </div>
    <?php endif; ?>
</article>
