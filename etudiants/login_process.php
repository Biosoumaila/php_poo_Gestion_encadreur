<?php
require_once '../database.php';
require_once 'etudiant.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Validation des données (à améliorer pour une application réelle)
    if (empty($email) || empty($mot_de_passe)) {
        header("Location: login.php?error=empty_fields");
        exit();
    }

    $database = new Database();
    $etudiant = new Etudiant($database);

    $loggedInEtudiant = $etudiant->login($email, $mot_de_passe);

    if ($loggedInEtudiant) {
        // Démarrer la session et stocker les informations de l'utilisateur
        session_start();
        $_SESSION['etudiant_id'] = $loggedInEtudiant['id'];
        $_SESSION['etudiant_nom'] = $loggedInEtudiant['nom'];
        $_SESSION['etudiant_prenom'] = $loggedInEtudiant['prenom'];
        $_SESSION['etudiant_email'] = $loggedInEtudiant['email'];
        $_SESSION['etudiant_mot_de_passe'] = $loggedInEtudiant['mot_de_passe'];
        $_SESSION['etudiant_filiere'] = $loggedInEtudiant['filiere'];
        $_SESSION['etudiant_annee_formation'] = $loggedInEtudiant['annee_formation'];

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