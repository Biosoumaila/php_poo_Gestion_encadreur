<div class="container">
    <h2>Demande de Relance d'Encadreur</h2>

    <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'etudiant'): ?>

    <?php if (isset($message)): ?>
    <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
    <?php else: ?>
    <p>Vous pouvez soumettre une demande de relance si aucun encadreur ne vous a été affecté.</p>
    <p>En soumettant cette demande, l'administrateur sera informé de votre situation.</p>

    <form action="index.php?action=relance_etudiant" method="post">
        <button type="submit" class="btn btn-warning">Soumettre une demande de relance</button>
    </form>
    <?php endif; ?>

    <div class="mt-3">
        <a href="index.php?action=dashboard_etudiant" class="btn btn-secondary">Retour au tableau de bord</a>
    </div>

    <?php else: ?>
    <div class="alert alert-danger">Vous n'êtes pas connecté en tant qu'étudiant.</div>
    <p><a href="index.php?action=connexion_etudiant">Se connecter</a></p>
    <?php endif; ?>
</div>