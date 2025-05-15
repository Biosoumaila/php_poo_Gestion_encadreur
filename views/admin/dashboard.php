<?php
$title = "Dashboard Administrateur";
$headerTitle = "Dashboard Administrateur";

$etudiants = $etudiantModel->getAllEtudiants();
$encadreurs = $encadreurModel->getAllEncadreurs();
ob_start();
?>
<div
    style="max-width:700px;margin:2rem auto;padding:2rem;background:#fff;border-radius:10px;box-shadow:0 4px 8px rgba(0,0,0,0.2);">
    <h2>Bienvenue, <?= htmlspecialchars($_SESSION['admin']['nom'] ?? '') ?>
        <?= htmlspecialchars($_SESSION['admin']['prenom'] ?? '') ?>
    </h2>
    <p>Vous êtes connecté en tant qu'administrateur.</p>
    <!-- Ajoute ici les liens ou tableaux pour attribuer les encadreurs/étudiants -->
</div>
<?php
$etudiants = $etudiantModel->getAllEtudiants();
$encadreurs = $encadreurModel->getAllEncadreurs();
?>
<h3>Assigner un encadreur à un étudiant</h3>
<form method="POST" action="?action=assign_encadreur">
    <select name="etudiant_id" required>
        <option value="">Choisir un étudiant</option>
        <?php foreach ($etudiants as $etudiant): ?>
            <option value="<?= $etudiant['id'] ?>">
                <?= htmlspecialchars($etudiant['nom'] . ' ' . $etudiant['prenom']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <select name="encadreur_id" required>
        <option value="">Choisir un encadreur</option>
        <?php foreach ($encadreurs as $encadreur): ?>
            <option value="<?= $encadreur['id'] ?>">
                <?= htmlspecialchars($encadreur['nom'] . ' ' . $encadreur['prenom']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Assigner</button>
</form>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>