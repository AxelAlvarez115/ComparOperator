<?php $authUser = currentUser(); ?>
<header class="fixed top-0 left-0 w-full transition-all duration-300 z-50">
    <nav class="py-4 px-4 md:px-30 xl:px-70 justify-between items-center flex text-white">

        <!-- Logo + nav links -->
        <div class="flex gap-8 items-center">
            <a class="hover:opacity-80 transition text-2xl font-bold tracking-tight" href="/ComparOperator/index.php">
                Compar<span class="text-orange-400">Operator</span>
            </a>
            <ul class="lg:flex hidden gap-6 items-center">
                <?php if (strpos($_SERVER['REQUEST_URI'], 'tour_operators') !== false): ?>
                    <li><a class="hover:text-orange-300 transition font-medium" href="#TourOperators">Tour Operators</a></li>
                <?php else: ?>
                    <li><a class="hover:text-orange-300 transition font-medium" href="#Destinations">Destinations</a></li>
                <?php endif; ?>
                <li><a class="hover:text-orange-300 transition font-medium" href="#Footer">À propos</a></li>
            </ul>
        </div>

        <!-- Desktop right — auth zone -->
        <div class="lg:flex hidden items-center gap-3">
            <?php if ($authUser): ?>
                <span class="text-sm text-white/70">
                    Bonjour, <strong class="text-white"><?= htmlspecialchars($authUser['username']) ?></strong>
                    <?php if (($authUser['role'] ?? 'user' ?? '') === 'admin'): ?>
                        <span class="ml-1 bg-orange-400/30 text-orange-200 text-xs font-semibold px-2 py-0.5 rounded-full">admin</span>
                    <?php endif; ?>
                </span>
                <?php if (($authUser['role'] ?? 'user' ?? '') === 'admin'): ?>
                    <a href="/ComparOperator/admin/index.php"
                       class="text-sm border border-white/40 hover:border-white rounded-full px-4 py-1.5 transition font-medium">
                        Admin
                    </a>
                <?php endif; ?>
                <a href="/ComparOperator/process/auth/logout.php"
                   class="text-sm bg-white/10 hover:bg-white/20 rounded-full px-4 py-1.5 transition font-medium">
                    Déconnexion
                </a>
            <?php else: ?>
                <a href="/ComparOperator/views/login.php"
                   class="text-sm border border-white/40 hover:border-white rounded-full px-4 py-1.5 transition font-medium">
                    Connexion
                </a>
            <?php endif; ?>
        </div>

        <!-- Mobile hamburger -->
        <button id="menuButton" class="lg:hidden cursor-pointer hover:text-orange-400 transition">
            <img class="w-7 h-7" src="/ComparOperator/assets/img/icons/menu.svg" alt="Menu">
        </button>

        <!-- Mobile menu -->
        <ul id="mobileMenu" class="lg:hidden translate-x-full transition-transform duration-300 ease-in-out
                flex flex-col text-slate-700 gap-0 absolute top-0 right-0 h-screen w-64
                bg-white shadow-[-12px_0_24px_-6px_rgba(0,0,0,0.15)]">
            <div class="flex items-center justify-between p-5 border-b">
                <span class="font-bold text-lg text-slate-800">Menu</span>
                <button id="closeButton" class="cursor-pointer hover:text-orange-400 transition">
                    <img class="w-6 h-6" src="/ComparOperator/assets/img/icons/close.svg" alt="Close">
                </button>
            </div>

            <?php if ($authUser): ?>
            <div class="px-5 py-3 bg-orange-50 border-b flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-orange-200 flex items-center justify-center text-orange-600 font-bold text-sm">
                    <?= strtoupper(substr($authUser['username'], 0, 1)) ?>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-800"><?= htmlspecialchars($authUser['username']) ?></p>
                    <p class="text-xs text-gray-400 capitalize"><?= htmlspecialchars($authUser['role'] ?? 'user') ?></p>
                </div>
            </div>
            <?php endif; ?>

            <li class="border-b">
                <a class="block px-5 py-4 hover:bg-orange-50 hover:text-orange-500 transition font-medium"
                   href="/ComparOperator/index.php">Accueil</a>
            </li>
            <li class="border-b">
                <a class="block px-5 py-4 hover:bg-orange-50 hover:text-orange-500 transition font-medium"
                   href="#Destinations">Destinations</a>
            </li>
            <li class="border-b">
                <a class="block px-5 py-4 hover:bg-orange-50 hover:text-orange-500 transition font-medium"
                   href="#Footer">À propos</a>
            </li>
            <?php if ($authUser && ($authUser['role'] ?? 'user' ?? '') === 'admin'): ?>
            <li class="border-b">
                <a class="block px-5 py-4 hover:bg-orange-50 hover:text-orange-500 transition font-medium"
                   href="/ComparOperator/admin/index.php">Admin Panel</a>
            </li>
            <?php endif; ?>
            <?php if ($authUser): ?>
            <li>
                <a class="block px-5 py-4 text-red-500 hover:bg-red-50 transition font-medium"
                   href="/ComparOperator/process/auth/logout.php">Déconnexion</a>
            </li>
            <?php else: ?>
            <li>
                <a class="block px-5 py-4 hover:bg-orange-50 hover:text-orange-500 transition font-medium"
                   href="/ComparOperator/views/login.php">Connexion</a>
            </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
