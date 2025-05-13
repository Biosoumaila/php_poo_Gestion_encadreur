<?php

namespace App\Models;

class Etudiant
{
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

    // Ajoutez des getters si nécessaire
    public function getNom()
    {
        return $this->nom;
    }
}