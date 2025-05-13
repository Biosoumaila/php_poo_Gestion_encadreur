<?php


require_once __DIR__ . '/../vendor/autoload.php';

use Bahng\TpPoo\Controllers\EtudiantController;
use Bahng\TpPoo\Core\Database;

$database = new Database();
$etudiantController = new EtudiantController($database);

$action = $_GET['action'] ?? 'home';

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

    default:
        require __DIR__ . '/../views/home.php'; // Charge la page d'accueil
        break;
}