<?php

namespace App\Models;

use PDO;

class Encadreur
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database->getConnection();
    }

    public function getAll()
    {
        $query = $this->db->query("SELECT * FROM encadreurs");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function register($nom, $prenom, $email, $motDePasse, $domaine)
    {
        $query = $this->db->prepare("INSERT INTO encadreurs (nom, prenom, email, mot_de_passe, domaine) VALUES (:nom, :prenom, :email, :motDePasse, :domaine)");
        $query->bindParam(':nom', $nom);
        $query->bindParam(':prenom', $prenom);
        $query->bindParam(':email', $email);
        $query->bindParam(':motDePasse', $motDePasse);
        $query->bindParam(':domaine', $domaine);

        return $query->execute();
    }

    public function findByEmail($email)
    {
        $query = $this->db->prepare("SELECT * FROM encadreurs WHERE email = :email");
        $query->bindParam(':email', $email);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProfile($id, $nom, $prenom, $email, $domaine)
    {
        $query = $this->db->prepare("UPDATE encadreurs SET nom = :nom, prenom = :prenom, email = :email, domaine = :domaine WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->bindParam(':nom', $nom);
        $query->bindParam(':prenom', $prenom);
        $query->bindParam(':email', $email);
        $query->bindParam(':domaine', $domaine);

        return $query->execute();
    }

    public function setEtudiant($encadreurId, $etudiantId)
    {
        $stmt = $this->db->prepare("UPDATE encadreurs SET etudiant_id = :etudiant_id WHERE id = :encadreur_id");
        $stmt->bindParam(':etudiant_id', $etudiantId);
        $stmt->bindParam(':encadreur_id', $encadreurId);
        return $stmt->execute();
    }
    public function getAllEncadreurs()
    {
        $query = "SELECT * FROM encadreurs";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}