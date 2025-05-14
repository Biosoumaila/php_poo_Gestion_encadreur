<?php

namespace App\Controllers;

use App\Models\Encadreur;

class EncadreurController
{
    private $encadreurModel;
    private $db;

    public function __construct($database)
    {
        $this->encadreurModel = new Encadreur($database);
    }

    public function afficherListeEncadreurs()
    {
        $encadreurs = $this->encadreurModel->getAll();
        require __DIR__ . '/../views/encadreurs/listeEncadreurs.php';
    }

    public function register($data)
    {
        $nom = $data['nom'];
        $prenom = $data['prenom'];
        $email = $data['email'];
        $motDePasse = password_hash($data['mot_de_passe'], PASSWORD_BCRYPT);
        $domaine = $data['domaine'];

        if ($this->encadreurModel->register($nom, $prenom, $email, $motDePasse, $domaine)) {
            $_SESSION['success_message'] = "Inscription réussie.";
            header('Location: ?action=login_encadreur');
        } else {
            $_SESSION['error_message'] = "Erreur lors de l'inscription.";
            header('Location: ?action=register_encadreur');
        }
        exit();
    }

    public function login($data)
    {
        $email = $data['email'];
        $motDePasse = $data['mot_de_passe'];

        // Rechercher l'encadreur par email
        $encadreur = $this->encadreurModel->findByEmail($email);

        if ($encadreur && password_verify($motDePasse, $encadreur['mot_de_passe'])) {
            // Connexion réussie, stocker les informations dans la session
            $_SESSION['encadreur'] = $encadreur;
            header('Location: ?action=dashboard_encadreur');
        } else {
            // Connexion échouée, rediriger avec un message d'erreur
            $_SESSION['error_message'] = "Email ou mot de passe incorrect.";
            header('Location: ?action=login_encadreur');
        }
        exit();
    }

    public function dashboard()
    {
        // Vérifiez si l'encadreur est connecté
        if (!isset($_SESSION['encadreur'])) {
            header('Location: ?action=login_encadreur');
            exit();
        }

        // Récupérez les informations de l'encadreur connecté
        $encadreurId = $_SESSION['encadreur']['id'];
        $etudiants = $this->encadreurModel->getEtudiantsEncadres($encadreurId);

        // Chargez la vue du tableau de bord
        require __DIR__ . '/../views/encadreurs/dashboardEncadreur.php';
    }

    public function updateProfile($data)
    {
        // Vérifiez si l'encadreur est connecté
        if (!isset($_SESSION['encadreur'])) {
            header('Location: ?action=login_encadreur');
            exit();
        }

        // Récupérez l'ID de l'encadreur connecté
        $encadreurId = $_SESSION['encadreur']['id'];

        // Mettez à jour les informations
        $nom = $data['nom'];
        $prenom = $data['prenom'];
        $email = $data['email'];
        $domaine = $data['domaine'];

        $success = $this->encadreurModel->updateProfile($encadreurId, $nom, $prenom, $email, $domaine);

        if ($success) {
            // Mettez à jour les informations dans la session
            $_SESSION['encadreur']['nom'] = $nom;
            $_SESSION['encadreur']['prenom'] = $prenom;
            $_SESSION['encadreur']['email'] = $email;
            $_SESSION['encadreur']['domaine'] = $domaine;

            $_SESSION['success_message'] = "Profil mis à jour avec succès.";
            header('Location: ?action=dashboard_encadreur');
        } else {
            $_SESSION['error_message'] = "Erreur lors de la mise à jour du profil.";
            header('Location: ?action=edit_profile_encadreur');
        }
        exit();
    }
}