<div class="container">
    <h2>Soumettre mon Cahier des Charges</h2>

    <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'etudiant'): ?>

    <?php if (isset($erreur)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($erreur) ?></div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form action="index.php?action=soumettre_cahier" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nom_binome" class="form-label">Nom du binôme (si applicable) :</label>
            <input type="text" class="form-control" id="nom_binome" name="nom_binome">
            <small class="form-text text-muted">Laissez vide si vous travaillez seul.</small>
        </div>
        <div class="mb-3">
            <label for="cahier" class="form-label">Fichier du cahier des charges :</label>
            <input type="file" class="form-control" id="cahier" name="cahier" accept=".pdf,.doc,.docx" required>
            <small class="form-text text-muted">Formats acceptés : PDF, DOC, DOCX. Taille maximale : [définir une taille
                limite].</small>
        </div>
        <button type="submit" class="btn btn-primary">Soumettre le cahier des charges</button>
    </form>

    <div class="mt-3">
        <a href="index.php?action=dashboard_etudiant" class="btn btn-secondary">Retour au tableau de bord</a>
    </div>

    <?php else: ?>
    <div class="alert alert-danger">Vous n'êtes pas connecté en tant qu'étudiant.</div>
    <p><a href="index.php?action=connexion_etudiant">Se connecter</a></p>
    <?php endif; ?>
</div>