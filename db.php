<?php

class Database {
private $host = "localhost";
private $dbname = "comparoperator";
private $username = "root";
private $password = "";
private $charset = "utf8mb4";
public $pdo;

public function __construct() {
    $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";
    try {
        $this->pdo = new PDO($dsn, $this->username, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
        die();
    }
    }
}
?>