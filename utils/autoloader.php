<?php

spl_autoload_register(function ($className) {
    // Base directory (src)
    $baseDir = __DIR__ . '/../classes/';
    
    // Déterminer le répertoire en fonction du suffixe du nom de la classe
    switch (true) {
        case substr($className, -7) === 'Manager':
            $directory = 'managers';
            break;
        case substr($className, -10) === 'Repository':
            $directory = 'repositorys';
            break;
        default:
            $directory = 'basics';
            break;
    }

    // Construire le chemin complet du fichier
    $file = $baseDir . $directory . '/' . $className . '.php';

    // Charge le fichier si trouvé
    if (file_exists($file)) {
        require $file;
    }
});