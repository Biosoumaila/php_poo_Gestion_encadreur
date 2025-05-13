<?php
// require '../database.php';
require_once './database.php';
class Relance
{
    private $db;
    private $etudiant_id;
    private $date_relance;


    // ... autres propriétés ...

    public function __construct(Database $database)
    { // Accepte un objet Database
        $this->db = $database;
    }

    public function setEtudiant_id($etudiant_id)
    {
        $this->etudiant_id = $etudiant_id;
    }

    public function setDate_relance($date_relance)
    {
        $this->date_relance = $date_relance;
    }

    // ... setters pour les autres propriétés ...

    public function create()
    {
        try {
            $stmt = $this->db->getConnection()->prepare("INSERT INTO relances (etudiant_id, date_relance) VALUES (:etudiant_id, :date_relance)");
            $stmt->bindParam(':etudiant_id', $this->etudiant_id);
            $stmt->bindParam(':date_relance', $this->date_relance);
            return $stmt->execute();
        } catch (PDOException $e) {

            return false;
        }
    }

    // ... autres méthodes pour récupérer les relance, etc. ...
}