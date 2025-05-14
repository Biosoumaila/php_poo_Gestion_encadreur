<?php
require __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../controllers/EncadreurController.php';
require_once __DIR__ . '/../models/Encadreur.php';
require_once __DIR__ . '/../models/Etudiant.php';

use App\Models\Encadreur;
use App\Models\Etudiant;
use App\Models\Database;
use App\Controllers\EncadreurController;

$title = 'Page d\'accueil';
$headerTitle = 'Bienvenue sur l\'application de gestion';

ob_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        /* Styles généraux */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            overflow-x: hidden;
        }

        /* Barre de navigation */
        .navbar {
            background-color: #007bff;
            color: white;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .navbar h1 {
            margin: 0;
            font-size: 1.5rem;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 1rem;
            font-size: 1rem;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        /* Conteneur principal */
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem;
            gap: 2rem;
        }

        /* Sections */
        .section {
            background-color: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 600px;
            text-align: center;
        }

        .section h2 {
            color: #007bff;
            margin-bottom: 1rem;
        }

        .section p {
            font-size: 1rem;
            color: #333;
            margin-bottom: 1rem;
        }

        .section a {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
        }

        .section a:hover {
            background-color: #0056b3;
        }

        /* Barre de défilement */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #007bff;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>
    <!-- Barre de navigation -->
    <div class="navbar">
        <h1><?= $headerTitle ?></h1>
        <div>
            <a href="?action=register_etudiant">Inscription Etudiant</a>
            <a href="?action=login_etudiant">connexion Etudiant</a>
            <a href="?action=register_encadreur">Inscription encadreur</a>
            <a href="?action=login_encadreur">connexion encadreur</a>

        </div>
    </div>

    <!-- Contenu principal -->
    <div class="container">
        <div class="section">
            <h2>Gestion des étudiants</h2>
            <p>Accédez à la liste des étudiants et gérez leurs informations.</p>
            <a href="?action=liste_etudiants">Voir les étudiants</a>
        </div>
        <div class="section">
            <h2>Encadreurs</h2>
            <a href="?action=register_encadreur">S'inscrire</a>
            <a href="?action=login_encadreur" style="margin-top: 1rem;">Se connecter</a>
        </div>
        <div class="section">
            <h2>Étudiants</h2>
            <a href="?action=register_etudiant">S'inscrire</a>
            <a href="?action=login_etudiant" style="margin-top: 1rem;">Se connecter</a>
        </div>
    </div>
</body>

</html>
<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
?>