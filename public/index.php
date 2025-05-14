<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../core/Database.php';

use App\Controllers\EncadreurController;
use App\Controllers\EtudiantController;
use Bahng\TpPoo\Core\Database;

$database = new Database();
$encadreurController = new EncadreurController($database);
$etudiantController = new EtudiantController($database);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'dashboard_etudiant':
            if (!isset($_SESSION['etudiant'])) {
                header('Location: ?action=login_etudiant'); // Redirige vers la page de connexion si non connecté
                exit;
            }
            require __DIR__ . '/../views/etudiants/dashboard.php'; // Charge la vue du tableau de bord
            break;

        case 'dashboard_encadreur':
            if (!isset($_SESSION['encadreur'])) {
                header('Location: ?action=login_encadreur');
                exit;
            }
            require __DIR__ . '/../views/encadreurs/dashboard.php';
            break;

        case 'about':
            require __DIR__ . '/../views/about.php'; // Créez un fichier about.php si nécessaire
            break;

        case 'contact':
            require __DIR__ . '/../views/contact.php'; // Créez un fichier contact.php si nécessaire
            break;

        case 'register_encadreur':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $encadreurController->register($_POST);
            } else {
                require __DIR__ . '/../views/encadreurs/registerEncadreur.php';
            }
            break;

        case 'login_encadreur':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $encadreurController->login($_POST);
            } else {
                require __DIR__ . '/../views/encadreurs/loginEncadreur.php';
            }
            break;

        case 'register_etudiant':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $etudiantController->register($_POST);
            } else {
                require __DIR__ . '/../views/etudiants/register.php';
            }
            break;

        case 'login_etudiant':
            require __DIR__ . '/../views/etudiants/login.php'; // Créez ce fichier si nécessaire
            break;

        case 'logout':
            session_start();
            session_destroy();
            header('Location: ?action=login_etudiant'); // Redirige vers la page de connexion
            exit;

        default:
            require __DIR__ . '/../views/home.php';
            break;
    }
} else {
    require __DIR__ . '/../views/home.php';
}