<div class="container">
    <h2>Affecter un Encadreur à un Étudiant</h2>

    <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>

    <?php if (isset($erreur)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($erreur) ?></div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form action="index.php?action=affecter_encadreur_admin" method="post">
        <div class="mb-3">
            <label for="etudiant_id" class="form-label">Étudiant à affecter :</label>
            <select class="form-control" id="etudiant_id" name="etudiant_id" required>
                <option value="">Sélectionner un étudiant</option>
                <?php if (!empty($etudiants)): ?>
                <?php foreach ($etudiants as $etudiant): ?>
                <option value="<?= htmlspecialchars($etudiant->getId()) ?>"
                    <?php if (isset($_GET['etudiant_id']) && $_GET['etudiant_id'] == $etudiant->getId()) echo 'selected'; ?>>
                    <?= htmlspecialchars($etudiant->getNom()) ?> <?= htmlspecialchars($etudiant->getPrenom()) ?>
                    (<?= htmlspecialchars($etudiant->getFiliere()) ?>)
                </option>
                <?php endforeach; ?>
                <?php else: ?>
                <option value="" disabled>Aucun étudiant inscrit</option>
                <?php endif; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="encadreur_id" class="form-label">Encadreur à affecter :</label>
            <select class="form-control" id="encadreur_id" name="encadreur_id" required>
                <option value="">Sélectionner un encadreur</option>
                <?php if (!empty($encadreurs)): ?>
                <?php foreach ($encadreurs as $encadreur): ?>
                <option value="<?= htmlspecialchars($encadreur->getId()) ?>">
                    <?= htmlspecialchars($encadreur->getNom()) ?> <?= htmlspecialchars($encadreur->getPrenom()) ?>
                    (<?= htmlspecialchars($encadreur->getDomaine()) ?>)
                </option>
                <?php endforeach; ?>
                <?php else: ?>
                <option value="" disabled>Aucun encadreur enregistré</option>
                <?php endif; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Affecter l'encadreur</button>
    </form>

    <div class="mt-3">
        <a href="index.php?action=liste_etudiants_admin" class="btn btn-secondary">Retour à la liste des étudiants</a>
        <a href="index.php?action=dashboard_admin" class="btn btn-secondary ml-2">Retour au tableau de bord</a>
    </div>

    <?php else: ?>
    <div class="alert alert-danger">Vous n'êtes pas connecté en tant qu'administrateur.</div>
    <p><a href="index.php?action=connexion_admin">Se connecter</a></p>
    <?php endif; ?>
</div>