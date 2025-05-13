<?php

// require '../database.php';
require_once '../database.php';
require_once 'encadreur.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $domaine = $_POST['domaine'];

    // Validation des données (à améliorer pour une application réelle)
    if (empty($nom) || empty($email) || empty($mot_de_passe)) {
        header("Location: register.php?error=empty_fields");
        exit();
    }

    $database = new Database();
    $encadreur = new Encadreur($database);

    if ($encadreur->register($nom, $prenom, $email, $mot_de_passe, $domaine)) {
        header("Location: register.php?success=registered");
        exit();
    } else {
        header("Location: register.php?error=email_exists");
        exit();
    }
} else {
    // Si on accède directement au fichier sans soumettre le formulaire
    header("Location: register.php");
    exit();
}