<header class="fixed top-0 left-0 w-full transition-all duration-300 z-50">
    <nav class="py-4 px-4 xl:px-70 md:px-30 justify-between items-center flex text-white">
        <div class="flex gap-8">
            <a class="hover:text-gray-200 text-2xl font-bold" href="/ComparOperator/index.php">ComparOperator</a>
            <ul class="flex gap-4">
                <?php if($_SERVER['REQUEST_URI']== '/ComparOperator/index.php'): ?>
                <li class="lg:block hidden hover:text-gray-200 text-lg font-bold"><a href="#Destinations">Destinations</a></li>
                <?php else: ?>
                <li class="lg:block hidden hover:text-gray-200 text-lg font-bold"><a href="#TourOperators">Tour Operators</a></li>
                <?php endif; ?>
                <li class="lg:block hidden hover:text-gray-200 text-lg font-bold"><a href="#Footer">About</a></li>
            </ul>
        </div>
        <button id="menuButton" class="lg:hidden cursor-pointer hover:text-orange-400">
            <img class="w-8 h-8" src="/ComparOperator/assets/img/icons/menu.svg" alt="">
        </button>
        <ul id="mobileMenu" class="lg:hidden translate-x-full transition-transform duration-300 ease-in-out flex flex-col text-slate-700 gap-4 absolute top-0 right-0 h-screen bg-white p-4 shadow-[-10px_0_15px_-5px_rgba(0,0,0,0.3)]">
            <button id="closeButton" class="self-end cursor-pointer hover:text-orange-400">
                <img class="w-8 h-8" src="/ComparOperator/assets/img/icons/close.svg" alt="">
            </button>
            <li class="hover:text-gray-200 text-xl font-bold border-b-1 pb-4 border-slate-700"><a href="/ComparOperator/index.php">Home</a></li>
            <li class="hover:text-gray-200 text-xl font-bold border-b-1 pb-4 border-slate-700"><a href="#Destinations">Destinations</a></li>
            <li class="hover:text-gray-200 text-xl font-bold border-b-1 pb-4 border-slate-700"><a href="#Footer">About</a></li>
        </ul>
    </nav>
</header>