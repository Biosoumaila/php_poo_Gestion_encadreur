<div class="container">
    <h2>Mon Profil Étudiant</h2>

    <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'etudiant'): ?>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Informations personnelles</h5>
            <p class="card-text"><strong>Nom:</strong> <?= htmlspecialchars($etudiant->getNom()) ?></p>
            <p class="card-text"><strong>Prénom:</strong> <?= htmlspecialchars($etudiant->getPrenom()) ?></p>
            <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($etudiant->getEmail()) ?></p>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Informations académiques</h5>
            <p class="card-text"><strong>Filière:</strong> <?= htmlspecialchars($etudiant->getFiliere()) ?></p>
            <p class="card-text"><strong>Année de formation:</strong>
                <?= htmlspecialchars($etudiant->getAnneeFormation()) ?></p>
        </div>
    </div>

    <?php if ($etudiant->getEncadreur()): ?>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Mon Encadreur</h5>
            <p class="card-text"><strong>Nom:</strong> <?= htmlspecialchars($etudiant->getEncadreur()->getNom()) ?></p>
            <p class="card-text"><strong>Prénom:</strong>
                <?= htmlspecialchars($etudiant->getEncadreur()->getPrenom()) ?></p>
            <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($etudiant->getEncadreur()->getEmail()) ?>
            </p>
            <p class="card-text"><strong>Domaine:</strong>
                <?= htmlspecialchars($etudiant->getEncadreur()->getDomaine()) ?></p>
        </div>
    </div>
    <?php else: ?>
    <div class="alert alert-info mt-3">
        Aucun encadreur ne vous a encore été affecté.
    </div>
    <?php endif; ?>

    <div class="mt-4">
        <a href="index.php?action=dashboard_etudiant" class="btn btn-secondary">Retour au tableau de bord</a>
    </div>

    <?php else: ?>
    <div class="alert alert-danger">Vous n'êtes pas connecté en tant qu'étudiant.</div>
    <p><a href="index.php?action=connexion_etudiant">Se connecter</a></p>
    <?php endif; ?>
</div>