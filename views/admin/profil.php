<div class="container">
    <h2>Mon Profil Administrateur</h2>

    <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Informations personnelles</h5>
            <p class="card-text"><strong>Nom:</strong> <?= htmlspecialchars($admin->getNom()) ?></p>
            <p class="card-text"><strong>Prénom:</strong> <?= htmlspecialchars($admin->getPrenom()) ?></p>
            <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($admin->getEmail()) ?></p>
        </div>
    </div>

    <div class="mt-4">
        <a href="index.php?action=dashboard_admin" class="btn btn-secondary">Retour au tableau de bord</a>
    </div>

    <?php else: ?>
    <div class="alert alert-danger">Vous n'êtes pas connecté en tant qu'administrateur.</div>
    <p><a href="index.php?action=connexion_admin">Se connecter</a></p>
    <?php endif; ?>
</div>