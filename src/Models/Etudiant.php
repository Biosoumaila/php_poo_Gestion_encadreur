<?php

namespace Bahng\TpPoo\Models;

class Etudiant
{
    private $db;

    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $filiere;
    private $anneeFormation;

    public function __construct($id, $nom, $prenom, $email, $filiere, $anneeFormation)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->filiere = $filiere;
        $this->anneeFormation = $anneeFormation;
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
}