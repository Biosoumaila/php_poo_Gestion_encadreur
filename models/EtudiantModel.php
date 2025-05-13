<?php

namespace Bahng\TpPoo\Models;

use PDO;

class EtudiantModel
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database->getConnection();
    }

    public function getAllEtudiants()
    {
        $query = $this->db->query("SELECT * FROM etudiants");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function register($nom, $prenom, $email, $filiere, $anneeFormation, $motDePasse)
    {
        $query = $this->db->prepare("INSERT INTO etudiants (nom, prenom, email, filiere, annee_formation, mot_de_passe) 
                                  VALUES (:nom, :prenom, :email, :filiere, :annee_formation, :mot_de_passe)");
        $query->bindParam(':nom', $nom);
        $query->bindParam(':prenom', $prenom);
        $query->bindParam(':email', $email);
        $query->bindParam(':filiere', $filiere);
        $query->bindParam(':annee_formation', $anneeFormation);
        $query->bindParam(':mot_de_passe', $motDePasse);

        return $query->execute();
    }

    public function findByEmail($email)
    {
        $query = $this->db->prepare("SELECT * FROM etudiants WHERE email = :email");
        $query->bindParam(':email', $email);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function soumettreCahierDeCharge($etudiantId, $nomBinome, $fileName)
    {
        $query = $this->db->prepare("INSERT INTO cahiers_charges (etudiant_id, nom_binome, fichier) 
                                 VALUES (:etudiant_id, :nom_binome, :fichier)");
        $query->bindParam(':etudiant_id', $etudiantId);
        $query->bindParam(':nom_binome', $nomBinome);
        $query->bindParam(':fichier', $fileName);

        return $query->execute();
    }

    public function getCahierDeCharge($etudiantId)
    {
        $query = $this->db->prepare("SELECT * FROM cahiers_charges WHERE etudiant_id = :etudiant_id ORDER BY date_soumission DESC LIMIT 1");
        $query->bindParam(':etudiant_id', $etudiantId);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getEncadreur($etudiantId)
    {
        $query = $this->db->prepare("SELECT encadreurs.nom, encadreurs.prenom 
                                     FROM etudiants 
                                     LEFT JOIN encadreurs ON etudiants.encadreur_id = encadreurs.id 
                                     WHERE etudiants.id = :id");
        $query->bindParam(':id', $etudiantId);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function faireRelance($etudiantId)
    {
        $query = $this->db->prepare("INSERT INTO relances (etudiant_id, date_relance) VALUES (:etudiant_id, NOW())");
        $query->bindParam(':etudiant_id', $etudiantId);

        return $query->execute();
    }
}