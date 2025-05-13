<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 1rem;
            text-align: center;
        }

        main {
            padding: 2rem;
            text-align: center;
        }

        a {
            display: inline-block;
            margin: 1rem;
            padding: 1rem 2rem;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
            font-size: 1.2rem;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <header>
        <h1>Bienvenue sur le projet de gestion des étudiants</h1>
    </header>
    <main>
        <h2>Fonctionnalités disponibles</h2>
        <a href="?action=liste_etudiants">Voir la liste des étudiants</a>
        <a href="?action=register">Inscrire un étudiant</a>
        <a href="?action=login">Connexion</a>
        <a href="?action=logout">Déconnexion</a>
    </main>
</body>

</html>