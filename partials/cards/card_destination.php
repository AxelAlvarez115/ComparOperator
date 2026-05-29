<article
    onclick="location.href='/ComparOperator/views/tour_operators.php?location=<?= urlencode($destination->getLocation()) ?>'"
    class="destination-card group cursor-pointer rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow duration-300 bg-white">
    <div class="relative overflow-hidden aspect-[4/3]">
        <img
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
            src="/ComparOperator/assets/img/cities/<?= htmlspecialchars($destination->getImage()) ?>"
            alt="<?= htmlspecialchars($destination->getLocation()) ?>">
        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
    </div>
    <div class="p-4 flex justify-between items-start">
        <div>
            <h3 class="font-bold text-slate-800"><?= htmlspecialchars($destination->getLocation()) ?></h3>
            <p class="text-sm text-slate-500"><?= htmlspecialchars($destination->getCountry()) ?></p>
        </div>
        <div class="text-right">
            <p class="text-xs text-gray-400">from</p>
            <span class="text-teal-600 font-bold">€<?= htmlspecialchars($destination->getPrice()) ?></span>
        </div>
    </div>
</article>
