<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Étudiant</title>
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
        }

        .info,
        .actions {
            background-color: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 2rem;
        }

        .actions form {
            margin-top: 1rem;
        }

        input,
        textarea,
        button {
            width: 100%;
            padding: 0.8rem;
            margin: 0.5rem 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <header>
        <h1>Dashboard Étudiant</h1>
    </header>
    <main>
        <div class="info">
            <h2>Bienvenue, <?= $_SESSION['etudiant']['prenom'] . ' ' . $_SESSION['etudiant']['nom']; ?> !</h2>
            <p><strong>Email :</strong> <?= $_SESSION['etudiant']['email']; ?></p>
            <p><strong>Filière :</strong> <?= $_SESSION['etudiant']['filiere']; ?></p>
            <p><strong>Année de formation :</strong> <?= $_SESSION['etudiant']['annee_formation']; ?></p>
        </div>

        <div class="actions">
            <h3>Soumettre votre cahier de charge</h3>
            <form method="POST" action="?action=soumettre_cahier" enctype="multipart/form-data">
                <input type="text" name="nom_binome" placeholder="Nom du binôme (facultatif)">
                <input type="file" name="cahiers_charges" required>
                <button type="submit">Soumettre</button>
            </form>
        </div>

        <div class="actions">
            <h3>Vérifier votre encadreur</h3>
            <?php
            $encadreur = $etudiantController->verifierEncadreur();
            if ($encadreur): ?>
                <p><strong>Encadreur :</strong> <?= $encadreur['prenom'] . ' ' . $encadreur['nom']; ?></p>
            <?php else: ?>
                <p>Aucun encadreur n'a été affecté pour le moment.</p>
                <form method="POST" action="?action=faire_relance">
                    <button type="submit">Faire une relance</button>
                </form>
            <?php endif; ?>
        </div>
    </main>
</body>

</html>