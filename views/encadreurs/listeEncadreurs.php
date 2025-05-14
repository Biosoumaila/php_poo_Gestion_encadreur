<?php

$title = 'Liste des Encadreurs';
$headerTitle = 'Liste des Encadreurs';

ob_start();
?>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f9;
}

.container {
    padding: 2rem;
}

h1 {
    color: #007bff;
    text-align: center;
    margin-bottom: 1rem;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 0 auto;
    background-color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    overflow: hidden;
}

thead {
    background-color: #007bff;
    color: white;
}

thead th {
    padding: 1rem;
    text-align: left;
}

tbody tr:nth-child(even) {
    background-color: #f4f4f9;
}

tbody tr:hover {
    background-color: #e9ecef;
}

tbody td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

tbody tr:last-child td {
    border-bottom: none;
}
</style>
<div class="container">
    <h1>Liste des Encadreurs</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Domaine</th>
                <th>Date d'inscription</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($encadreurs as $encadreur): ?>
            <tr>
                <td><?= htmlspecialchars($encadreur['id']) ?></td>
                <td><?= htmlspecialchars($encadreur['nom']) ?></td>
                <td><?= htmlspecialchars($encadreur['prenom']) ?></td>
                <td><?= htmlspecialchars($encadreur['email']) ?></td>
                <td><?= htmlspecialchars($encadreur['domaine']) ?></td>
                <td><?= htmlspecialchars($encadreur['date_inscription']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>