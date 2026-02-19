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
    $db = new PDO('mysql:host=localhost;dbname=compar-operator', "root", "");
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>