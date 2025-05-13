<?php

class Database
{
    private $host = "localhost"; // Remplace par ton hôte MySQL
    private $dbname = "gestion_encadreur"; // Remplace par le nom de ta base de données
    private $username = "root"; // Remplace par ton nom d'utilisateur MySQL
    private $password = ""; // Remplace par ton mot de passe MySQL
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
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