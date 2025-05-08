<?php
session_start();

require_once __DIR__ . '/controllers/EtudiantController.php';
require_once __DIR__ . '/controllers/EncadreurController.php';
require_once __DIR__ . '/controllers/AdminController.php';

$action = $_GET['action'] ?? 'accueil';

$etudiantController = new EtudiantController();
$encadreurController = new EncadreurController();
$adminController = new AdminController();

switch ($action) {
    case 'accueil':
        ob_start();
        require __DIR__ . '/views/accueil.php'; // Créez ce fichier accueil.php dans votre dossier views
        $content = ob_get_clean();
        require __DIR__ . '/views/layouts/default.php';
        break;

    // Routes Étudiant
    case 'enregistrement_etudiant':
        $etudiantController->enregistrement();
        break;
    case 'connexion_etudiant':
        $etudiantController->connexion();
        break;
    case 'dashboard_etudiant':
        $etudiantController->dashboard();
        break;
    case 'profil_etudiant':
        $etudiantController->profil();
        break;
    case 'soumettre_cahier':
        $etudiantController->soumettreCahier();
        break;
    case 'voir_encadreur':
        $etudiantController->voirEncadreur();
        break;
    case 'relance_etudiant':
        $etudiantController->relance();
        break;
    case 'logout_etudiant':
        $etudiantController->logout();
        break;

    // Routes Encadreur
    case 'enregistrement_encadreur':
        $encadreurController->enregistrement();
        break;
    case 'connexion_encadreur':
        $encadreurController->connexion();
        break;
    case 'dashboard_encadreur':
        $encadreurController->dashboard();
        break;
    case 'profil_encadreur':
        $encadreurController->profil();
        break;
    case 'liste_etudiants_encadreur':
        $encadreurController->listeEtudiants();
        break;
    case 'logout_encadreur':
        $encadreurController->logout();
        break;

    // Routes Admin
    case 'connexion_admin':
        $adminController->connexion();
        break;
    case 'dashboard_admin':
        $adminController->dashboard();
        break;
    case 'profil_admin':
        $adminController->profil();
        break;
    case 'liste_etudiants_admin':
        $adminController->listeEtudiants();
        break;
    case 'liste_encadreurs_admin':
        $adminController->listeEncadreurs();
        break;
    case 'affecter_encadreur_admin':
        $adminController->affecterEncadreur();
        break;
    case 'logout_admin':
        $adminController->logout();
        break;

    default:
        // Gérer les erreurs 404 (page non trouvée)
        require __DIR__ . '/views/erreurs/404.php';
        break;
}