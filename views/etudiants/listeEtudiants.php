<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Encadreurs</title>
</head>

<body>
    <h1>Liste des Encadreurs</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($encadreurs as $encadreur): ?>
                <tr>
                    <td><?= htmlspecialchars($encadreur['id']) ?></td>
                    <td><?= htmlspecialchars($encadreur['nom']) ?></td>
                    <td><?= htmlspecialchars($encadreur['prenom']) ?></td>
                    <td><?= htmlspecialchars($encadreur['email']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>