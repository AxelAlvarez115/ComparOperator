<card onclick="location.href='/ComparOperator/views/tour_operators.php?location=<?= urlencode($destination->getLocation()) ?>'" class="destination-card cursor-pointer relative rounded-xl aspect-[4/5] mb-4">
    <div class="relative overflow-hidden rounded-xl aspect-[4/5] mb-4">
        <img class="hover:scale-120 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="/ComparOperator/assets/img/cities/<?= $destination->getImage() ?>" alt="<?= htmlspecialchars($destination->getLocation()) ?>">
    </div>
    <div class="flex justify-between items-start">
        <div class="">
            <h3 class="font-bold"><?= htmlspecialchars($destination->getLocation()) ?></h3>
            <p class="text-sm"><?= htmlspecialchars($destination->getCountry()) ?></p>
        </div>
        <div class="text-right">
            <p class="text-xs text-gray-400">from</p>
            <span class="text-teal-600 font-bold">€<?= htmlspecialchars($destination->getPrice()) ?></span>
        </div>
    </div>
</card>