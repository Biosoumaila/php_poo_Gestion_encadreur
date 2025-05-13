<?php

require_once 'etudiants/etudiant.php';
require_once 'database.php';
require_once 'encadreurs/encadreur.php';

$database = new Database();
$etudiantController = new Etudiant($database);
$encadreurController = new Encadreur($database); // Instantiate Encadreur controller
// $administrateurController = new Administrateur($database); // Instantiate Administrateur controller

session_start();
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        // Student actions
        case 'enregistrerRelance':
            $etudiantController->enregistrerRelance();
            break;
        case 'relance_etudiant': // Pour afficher le formulaire de relance
            $etudiantController->relance();
            break;
        case 'register':
            require 'etudiants/register.php';
            break;
        case 'login':
            require 'etudiants/login.php';
            break;
        case 'logout':
            $etudiantController->logout();
            break;

        // Encadreur (Supervisor) actions
        case 'liste_etudiants': // Example: List supervised students
            // $encadreurController->listerEtudiants();
            break;
        case 'valider_rapport': // Example: Validate a student report
            // $encadreurController->validerRapport();
            break;
        case 'login_encadreur': // Login page for encadreurs
            require 'encadreurs/login.php'; // Assuming you'll create this file
            break;
        case 'dashboard_encadreur': // Dashboard for encadreurs
            // Logic to display encadreur dashboard
            echo "Dashboard Encadreur";
            break;

        // Administrateur (Administrator) actions
        case 'gestion_utilisateurs': // Example: Manage users
            $administrateurController->gererUtilisateurs();
            break;
        case 'ajouter_utilisateur': // Example: Add a new user
            $administrateurController->ajouterUtilisateur();
            break;
        case 'login_admin': // Login page for administrators
            require 'administrateurs/login.php'; // Assuming you'll create this file
            break;
        case 'dashboard_admin': // Dashboard for administrators
            // Logic to display admin dashboard
            echo "Dashboard Administrateur";
            break;

        default:
            echo "Action inconnue.";
            break;
    }
} else {
    // Redirect to the default login page (you might want to make this more dynamic)
    header('Location: etudiants/login.php');
    exit();
}