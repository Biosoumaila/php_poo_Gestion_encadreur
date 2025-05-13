<?php

namespace Bahng\TpPoo\Core;

use PDO;
use PDOException;

class Database
{
    private $conn;

    public function __construct()
    {
        $config = require __DIR__ . '/../config/config.php'; // Chemin mis à jour
        $dbConfig = $config['database'];

        try {
            $dsn = "mysql:host=" . $dbConfig['host'] . ";dbname=" . $dbConfig['dbname'] . ";charset=" . $dbConfig['charset'];
            $this->conn = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}