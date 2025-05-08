<div class="container">
    <h2>Liste des Encadreurs</h2>

    <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>

    <?php if (!empty($encadreurs)): ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Domaine</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($encadreurs as $encadreur): ?>
            <tr>
                <td><?= htmlspecialchars($encadreur->getId()) ?></td>
                <td><?= htmlspecialchars($encadreur->getNom()) ?></td>
                <td><?= htmlspecialchars($encadreur->getPrenom()) ?></td>
                <td><?= htmlspecialchars($encadreur->getEmail()) ?></td>
                <td><?= htmlspecialchars($encadreur->getDomaine()) ?></td>
                <td><a href="#" class="btn btn-sm btn-info">Voir le profil</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <div class="alert alert-info">
        Aucun encadreur n'est enregistré pour le moment.
    </div>
    <?php endif; ?>

    <div class="mt-3">
        <a href="index.php?action=dashboard_admin" class="btn btn-secondary">Retour au tableau de bord</a>
    </div>

    <?php else: ?>
    <div class="alert alert-danger">Vous n'êtes pas connecté en tant qu'administrateur.</div>
    <p><a href="index.php?action=connexion_admin">Se connecter</a></p>
    <?php endif; ?>
</div>