<?php
require __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../controllers/EncadreurController.php';
require_once __DIR__ . '/../models/Encadreur.php';

$title = 'Dashboard Encadreur';
$headerTitle = 'Tableau de bord Encadreur';

ob_start();
?>
<style>
.container {
    padding: 2rem;
}

h1 {
    color: #007bff;
    text-align: center;
    margin-bottom: 1rem;
}

ul {
    list-style: none;
    padding: 0;
}

ul li {
    background-color: white;
    margin: 0.5rem 0;
    padding: 1rem;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
</style>
<div class="container">
    <h1>Bienvenue, <?= $_SESSION['encadreur']['prenom'] . ' ' . $_SESSION['encadreur']['nom']; ?></h1>
    <h2>Domaine : <?= $_SESSION['encadreur']['domaine']; ?></h2>
    <h3>Étudiants encadrés :</h3>
    <ul>
        <?php foreach ($etudiants as $etudiant): ?>
        <li><?= htmlspecialchars($etudiant['prenom'] . ' ' . $etudiant['nom']); ?> -
            <?= htmlspecialchars($etudiant['filiere']); ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>