<?php

namespace App\Models;

use PDO;

class Etudiant
{
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $filiere;
    private $anneeFormation;
    private $motDePasse;

    private $db; // Connexion à la base de données

    public function __construct($database = null)
    {
        if ($database) {
            $this->db = $database->getConnection();
        }
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getFiliere()
    {
        return $this->filiere;
    }

    public function getAnneeFormation()
    {
        return $this->anneeFormation;
    }

    // Setters
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setFiliere($filiere)
    {
        $this->filiere = $filiere;
    }

    public function setAnneeFormation($anneeFormation)
    {
        $this->anneeFormation = $anneeFormation;
    }

    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
    }

    // Méthode pour enregistrer un étudiant dans la base de données
    public function register($nom, $prenom, $email, $filiere, $anneeFormation, $motDePasse)
    {
        $query = "INSERT INTO etudiants (nom, prenom, email, filiere, annee_formation, mot_de_passe) 
                  VALUES (:nom, :prenom, :email, :filiere, :annee_formation, :mot_de_passe)";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':filiere', $filiere);
        $stmt->bindParam(':annee_formation', $anneeFormation);
        $stmt->bindParam(':mot_de_passe', $motDePasse);

        return $stmt->execute();
    }

    // Méthode pour trouver un étudiant par email
    public function findByEmail($email)
    {
        $query = "SELECT * FROM etudiants WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer tous les étudiants
    public function getAllEtudiants()
    {
        $query = "SELECT * FROM etudiants";
        $stmt = $this->db->query($query);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}