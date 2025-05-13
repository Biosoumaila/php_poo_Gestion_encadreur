<?php
require_once '../database.php';
require_once 'encadreur.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Validation des données (à améliorer pour une application réelle)
    if (empty($email) || empty($mot_de_passe)) {
        header("Location: login.php?error=empty_fields");
        exit();
    }

    $database = new Database();
    $encadreur = new Encadreur($database);

    $loggedInEtudiant = $encadreur->login($email, $mot_de_passe);

    if ($loggedInEncadreur) {
        // Démarrer la session et stocker les informations de l'utilisateur
        session_start();
        $_SESSION['encadreur_id'] = $loggedInEncadreur['id'];
        $_SESSION['encadreur_nom'] = $loggedInEncadreur['nom'];
        $_SESSION['encadreur_prenom'] = $loggedInEncadreur['prenom'];
        $_SESSION['encadreur_email'] = $loggedInEncadreur['email'];
        $_SESSION['encadreur_mot_de_passe'] = $loggedInEncadreur['mot_de_passe'];
        $_SESSION['encadreur_domaine'] = $loggedInEncadreur['domaine'];

        // Rediriger vers une page protégée (par exemple, dashboard.php)
        header("Location: dashboard.php");
        exit();
    } else {
        header("Location: login.php?error=invalid_credentials");
        exit();
    }
} else {
    // Si on accède directement au fichier sans soumettre le formulaire
    header("Location: login.php");
    exit();
}