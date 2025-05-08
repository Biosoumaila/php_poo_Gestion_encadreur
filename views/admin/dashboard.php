<div class="container">
    <h2>Tableau de bord Administrateur</h2>

    <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
    <p>Bienvenue, **<?= htmlspecialchars($admin->getPrenom()) ?> <?= htmlspecialchars($admin->getNom()) ?>** !</p>
    <p>Votre identifiant administrateur est : <?= htmlspecialchars($admin->getId()) ?></p>

    <div class="mt-4">
        <h3>Actions rapides :</h3>
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Gestion des Étudiants</h5>
                        <p class="card-text">Consultez et gérez la liste des étudiants inscrits.</p>
                        <a href="index.php?action=liste_etudiants_admin" class="btn btn-sm btn-light">Voir les
                            étudiants</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Gestion des Encadreurs</h5>
                        <p class="card-text">Consultez la liste des encadreurs enregistrés.</p>
                        <a href="index.php?action=liste_encadreurs_admin" class="btn btn-sm btn-light">Voir les
                            encadreurs</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Affectation des Encadreurs</h5>
                        <p class="card-text">Attribuez des encadreurs aux étudiants.</p>
                        <a href="index.php?action=affecter_encadreur_admin" class="btn btn-sm btn-light">Affecter un
                            encadreur</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <h3>Autres actions :</h3>
        <ul class="list-group">
            <li class="list-group-item"><a href="index.php?action=profil_admin">Consulter mon profil</a></li>
            <li class="list-group-item"><a href="index.php?action=logout_admin">Se déconnecter</a></li>
        </ul>
    </div>

    <?php else: ?>
    <div class="alert alert-danger">Vous n'êtes pas connecté en tant qu'administrateur.</div>
    <p><a href="index.php?action=connexion_admin">Se connecter</a></p>
    <?php endif; ?>
</div>