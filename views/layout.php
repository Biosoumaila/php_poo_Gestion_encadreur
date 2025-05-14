<?php
require __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../controllers/EncadreurController.php';
require_once __DIR__ . '/../models/Encadreur.php';
require_once __DIR__ . '/../models/Etudiant.php';
use App\Models\Encadreur;
use App\Models\Etudiant;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Application de gestion' ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            width: 250px;
            background-color: #007bff;
            color: white;
            padding: 1rem;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 0.8rem 1rem;
            margin: 0.5rem 0;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background-color: #0056b3;
        }

        .content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
            background-color: #f4f4f9;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 1rem;
            text-align: center;
        }

        footer {
            background-color: #007bff;
            color: white;
            text-align: center;
            /* padding: 0.25rem; */
            position: fixed;
            bottom: 0;
            width: calc(100% - 250px);
            /* width: calc(auto); */
            /* left: 250px; */
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>Menu</h2>
        <a href="?action=home">Accueil</a>
        <a href="?action=dashboard_etudiant">Dashboard Étudiant</a>
        <a href="?action=register_etudiant">Inscription Etudiant</a>
        <a href="?action=login_etudiant">Connexion Etudiant</a>
        <a href="?action=dashboard_encadreur">Dashboard Encadreur</a>
        <a href="?action=register_encadreur">Inscription Encadreur</a>
        <a href="?action=login_encadreur">Connexion Encadreur</a>
        <a href="?action=logout">Déconnexion</a>
    </div>
    <div class="content">
        <header>
            <h1><?= $headerTitle ?? 'Bienvenue' ?></h1>
        </header>
        <?= $content ?? '<p>Contenu non disponible.</p>' ?>
    </div>
    <footer>
        <p>&copy; 2025 - Application de gestion</p>
    </footer>
</body>

</html>