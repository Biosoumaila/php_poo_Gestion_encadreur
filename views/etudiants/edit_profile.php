<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['etudiant'])) {
    header('Location: ?action=login_etudiant');
    exit;
}

$etudiant = $_SESSION['etudiant'];
?>
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
        <input type="file" name="cahier_de_charge" required>
        <button type="submit">Soumettre</button>
    </form>
    <button type="submit" class="logout-button">Se déconnecter</button>
</div>
<?php
$content = ob_get_clean(); // Capture le contenu et le stocke dans $content
require __DIR__ . '/../layout.php'; // Inclut le layout
?>