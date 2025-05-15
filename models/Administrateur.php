<?php

namespace App\Models;

// use Core\Database;
use Bahng\TpPoo\Core\Database;
use PDO;

class Administrateur
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }
    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM administrateurs WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    public function getAll()
    {
        $query = $this->db->query("SELECT * FROM administrateurs");
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function register($nom, $prenom, $email, $motDePasse)
    {
        $stmt = $this->db->prepare("INSERT INTO administrateurs (nom, prenom, email, mot_de_passe) VALUES (:nom, :prenom, :email, :mot_de_passe)");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mot_de_passe', $motDePasse);
        return $stmt->execute();
    }
    public function setEncadreur($etudiantId, $encadreurId)
    {
        $stmt = $this->db->prepare("UPDATE etudiants SET encadreur_id = :encadreur_id WHERE id = :etudiant_id");
        $stmt->bindParam(':encadreur_id', $encadreurId);
        $stmt->bindParam(':etudiant_id', $etudiantId);
        return $stmt->execute();
    }
}