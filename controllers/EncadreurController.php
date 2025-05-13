<?php

namespace App\Controllers;

use App\Models\Encadreur;

class EncadreurController
{
    private $encadreurModel;

    public function __construct()
    {
        $this->encadreurModel = new Encadreur();
    }

    public function afficherListeEncadreurs()
    {
        $encadreurs = $this->encadreurModel->getAll();
        require __DIR__ . '/../Views/encadreurs/listeEncadreurs.php';
    }
}