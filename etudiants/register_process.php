<?php

// require '../database.php';
require_once '../database.php';
require_once 'etudiant.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $filiere = $_POST['filiere'];
    $annee_formation = $_POST['annee_formation'];

    // Validation des données (à améliorer pour une application réelle)
    if (empty($nom) || empty($email) || empty($mot_de_passe)) {
        header("Location: register.php?error=empty_fields");
        exit();
    }

    $database = new Database();
    $etudiant = new Etudiant($database);

    if ($etudiant->register($nom, $prenom, $email, $mot_de_passe, $filiere, $annee_formation)) {
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