<div class="container">
    <h2>Mon Encadreur</h2>

    <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'etudiant'): ?>

    <?php if ($encadreur): ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Informations de mon encadreur</h5>
            <p class="card-text"><strong>Nom:</strong> <?= htmlspecialchars($encadreur->getNom()) ?></p>
            <p class="card-text"><strong>Prénom:</strong> <?= htmlspecialchars($encadreur->getPrenom()) ?></p>
            <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($encadreur->getEmail()) ?></p>
            <p class="card-text"><strong>Domaine d'expertise:</strong> <?= htmlspecialchars($encadreur->getDomaine()) ?>
            </p>
        </div>
    </div>
    <?php else: ?>
    <div class="alert alert-info">
        Aucun encadreur ne vous a encore été affecté. Veuillez patienter ou faire une <a
            href="index.php?action=relance_etudiant">relance</a>.
    </div>
    <?php endif; ?>

    <div class="mt-3">
        <a href="index.php?action=dashboard_etudiant" class="btn btn-secondary">Retour au tableau de bord</a>
    </div>

    <?php else: ?>
    <div class="alert alert-danger">Vous n'êtes pas connecté en tant qu'étudiant.</div>
    <p><a href="index.php?action=connexion_etudiant">Se connecter</a></p>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layouts/default.php'; ?>