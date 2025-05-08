<div class="container">
    <h2>Liste de mes Étudiants</h2>

    <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'encadreur'): ?>

    <?php if (!empty($etudiants)): ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Filière</th>
                <th>Année de formation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($etudiants as $etudiant): ?>
            <tr>
                <td><?= htmlspecialchars($etudiant->getId()) ?></td>
                <td><?= htmlspecialchars($etudiant->getNom()) ?></td>
                <td><?= htmlspecialchars($etudiant->getPrenom()) ?></td>
                <td><?= htmlspecialchars($etudiant->getFiliere()) ?></td>
                <td><?= htmlspecialchars($etudiant->getAnneeFormation()) ?></td>
                <td><a href="#" class="btn btn-sm btn-info">Voir le profil</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <div class="alert alert-info">
        Vous n'avez aucun étudiant à encadrer pour le moment.
    </div>
    <?php endif; ?>

    <div class="mt-3">
        <a href="index.php?action=dashboard_encadreur" class="btn btn-secondary">Retour au tableau de bord</a>
    </div>

    <?php else: ?>
    <div class="alert alert-danger">Vous n'êtes pas connecté en tant qu'encadreur.</div>
    <p><a href="index.php?action=connexion_encadreur">Se connecter</a></p>
    <?php endif; ?>
</div>