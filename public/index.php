<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../core/Database.php';

use App\Controllers\EncadreurController;
use App\Controllers\EtudiantController;
use Bahng\TpPoo\Core\Database;
use App\Controllers\AdministrateurController;


$database = new Database();

$adminController = new AdministrateurController($database);
$encadreurController = new EncadreurController($database);
$etudiantController = new EtudiantController($database);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {

        case 'dashboard_admin':
            if (!isset($_SESSION['admin'])) {
                header('Location: ?action=login_admin');
                exit;
            }
            // Instancie les modèles pour la vue
            $etudiantModel = new \App\Models\Etudiant($database);
            $encadreurModel = new \App\Models\Encadreur($database);
            require __DIR__ . '/../views/admin/dashboard.php';
            break;

        case 'register_admin':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $adminController->register($_POST);
            } else {
                require __DIR__ . '/../views/admin/register.php';
            }
            break;

        case 'login_admin':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $adminController->login($_POST);
            } else {
                require __DIR__ . '/../views/admin/login.php';
            }
            break;

        case 'assign_encadreur':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $adminController->assignEncadreurToEtudiant($_POST['etudiant_id'], $_POST['encadreur_id']);
            }
            break;

        case 'dashboard_admin':
            if (!isset($_SESSION['admin'])) {
                header('Location: ?action=login_admin');
                exit;
            }
            // Passe les modèles à la vue
            $etudiantModel = $etudiantController->getModel();
            $encadreurModel = $encadreurController->getModel();
            require __DIR__ . '/../views/admin/dashboard.php';
            break;

        case 'dashboard_etudiant':
            if (!isset($_SESSION['etudiant'])) {
                header('Location: ?action=login_etudiant');
                exit;
            }
            require __DIR__ . '/../views/etudiants/dashboard.php';
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
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $etudiantController->login($_POST); // Va faire la redirection vers dashboard_etudiant si OK
            } else {
                require __DIR__ . '/../views/etudiants/login.php';
            }
            break;

        case 'soumettre_cahier_de_charge':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $etudiantController->soumettreCahierDeCharge($_POST, $_FILES);
            }
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