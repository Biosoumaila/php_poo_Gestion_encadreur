<?php


require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../core/Database.php';

use Bahng\TpPoo\Core\Database;
use Bahng\TpPoo\Controllers\EtudiantController;

$database = new Database();
$etudiantController = new EtudiantController($database);

session_start();

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'dashboard':
            if (isset($_SESSION['etudiant'])) {
                require __DIR__ . '/../views/etudiants/dashboard.php';
            } else {
                header('Location: ?action=login');
                exit();
            }
            break;

        case 'liste_etudiants':
            $etudiantController->afficherListeEtudiants();
            break;

        case 'register':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $etudiantController->register($_POST); // Gère l'inscription avec mot de passe
            } else {
                require __DIR__ . '/../views/etudiants/register.php';
            }
            break;

        case 'login':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $etudiantController->login($_POST); // Gère la connexion
            } else {
                require __DIR__ . '/../views/etudiants/login.php';
            }
            break;

        case 'logout':
            $etudiantController->logout(); // Gère la déconnexion
            break;

        case 'soumettre_cahier':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $etudiantController->soumettreCahierDeCharge($_POST, $_FILES); // Passez les données du formulaire et les fichiers téléversés
            }
            break;

        case 'faire_relance':
            $etudiantController->faireRelance();
            break;

        default:
            require __DIR__ . '/../views/home.php'; // Charge la page d'accueil
            break;
    }
} else {
    require __DIR__ . '/../views/home.php'; // Charge la page d'accueil par défaut
}