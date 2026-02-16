<card onclick="location.href='/ComparOperator/views/tour_operators.php?location=<?= urlencode($destination['location']) ?>'" class="destination-card cursor-pointer relative rounded-xl aspect-[4/5] mb-4">
    <div class="relative overflow-hidden rounded-xl aspect-[4/5] mb-4">
        <img class="hover:scale-120 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="/ComparOperator/assets/img/cities/<?= $destination['img'] ?>" alt="Paris">
    </div>
    <div class="flex justify-between items-start">
        <div class="">
            <h3 class="font-bold"><?= $destination['location'] ?></h3>
            <p class="text-sm "><?= $destination['country'] ?></p>
        </div>
        <div class="text-right">
            <p class="text-xs text-gray-400">from</p>
            <span class="text-teal-600 font-bold">€<?= $destination['price'] ?></span>
        </div>
    </div>
</card>