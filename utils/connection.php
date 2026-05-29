<?php

// class Database {
// private $host = "localhost";
// private $dbname = "compar-operator";
// private $username = "root";
// private $password = "";
// private $charset = "utf8mb4";
// public $db;

// public function __construct() {
//     $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";
//     try {
//         $this->db = new PDO($dsn, $this->username, $this->password);
//         $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     } catch (PDOException $e) {
//         echo "Erreur de connexion : " . $e->getMessage();
//         die();
//     }
//     }
// }

try {
    $db = new PDO('mysql:host=localhost;dbname=comparoperator;charset=utf8mb4', "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

$db->exec("
    CREATE TABLE IF NOT EXISTS `user` (
        `id`         INT          NOT NULL AUTO_INCREMENT,
        `username`   VARCHAR(80)  NOT NULL,
        `email`      VARCHAR(255) NOT NULL,
        `password`   VARCHAR(255) NOT NULL,
        `role`       ENUM('admin','user') NOT NULL DEFAULT 'user',
        `created_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        UNIQUE KEY `uq_username` (`username`),
        UNIQUE KEY `uq_email`    (`email`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
");

// Insère les comptes par défaut si la table est vide
$count = (int) $db->query("SELECT COUNT(*) FROM `user`")->fetchColumn();
if ($count === 0) {
    $db->exec("
        INSERT INTO `user` (`username`, `email`, `password`, `role`) VALUES
        ('admin',    'admin@comparoperator.com',    '\$2y\$12\$/1oPDtz/7GNsB9ah8SSoreW3s.rkGNA7J/6Eob5qrsrs6INBIrw3u', 'admin'),
        ('visiteur', 'visiteur@comparoperator.com', '\$2y\$12\$aKV2A490.wN8ZMSwJn2L/OHODuISG0h3keeQdmx8T2YzH9z7/85BK', 'user')
    ");
}
?>