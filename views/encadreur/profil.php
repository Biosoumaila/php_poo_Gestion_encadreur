<div class="container">
    <h2>Mon Profil Encadreur</h2>

    <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'encadreur'): ?>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Informations personnelles</h5>
            <p class="card-text"><strong>Nom:</strong> <?= htmlspecialchars($encadreur->getNom()) ?></p>
            <p class="card-text"><strong>Prénom:</strong> <?= htmlspecialchars($encadreur->getPrenom()) ?></p>
            <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($encadreur->getEmail()) ?></p>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Informations professionnelles</h5>
            <p class="card-text"><strong>Domaine d'expertise:</strong> <?= htmlspecialchars($encadreur->getDomaine()) ?>
            </p>
        </div>
    </div>

    <div class="mt-4">
        <a href="index.php?action=dashboard_encadreur" class="btn btn-secondary">Retour au tableau de bord</a>
    </div>

    <?php else: ?>
    <div class="alert alert-danger">Vous n'êtes pas connecté en tant qu'encadreur.</div>
    <p><a href="index.php?action=connexion_encadreur">Se connecter</a></p>
    <?php endif; ?>
</div>