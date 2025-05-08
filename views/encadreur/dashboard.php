<div class="container">
    <h2>Tableau de bord Encadreur</h2>

    <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'encadreur'): ?>
    <p>Bienvenue, **<?= htmlspecialchars($encadreur->getPrenom()) ?> <?= htmlspecialchars($encadreur->getNom()) ?>** !
    </p>
    <p>Votre identifiant encadreur est : <?= htmlspecialchars($encadreur->getId()) ?></p>
    <p>Votre domaine d'expertise : <?= htmlspecialchars($encadreur->getDomaine()) ?></p>

    <div class="mt-4">
        <h3>Actions disponibles :</h3>
        <ul class="list-group">
            <li class="list-group-item"><a href="index.php?action=profil_encadreur">Consulter mon profil</a></li>
            <li class="list-group-item"><a href="index.php?action=liste_etudiants_encadreur">Voir la liste de mes
                    étudiants</a></li>
            <li class="list-group-item"><a href="index.php?action=logout_encadreur">Se déconnecter</a></li>
        </ul>
    </div>

    <?php if (!empty($etudiantsEncadres)): ?>
    <div class="mt-4">
        <h3>Vos étudiants encadrés :</h3>
        <ul class="list-group">
            <?php foreach ($etudiantsEncadres as $etudiant): ?>
            <li class="list-group-item">
                <?= htmlspecialchars($etudiant->getPrenom()) ?> <?= htmlspecialchars($etudiant->getNom()) ?>
                (<?= htmlspecialchars($etudiant->getFiliere()) ?>,
                <?= htmlspecialchars($etudiant->getAnneeFormation()) ?>)
                <a href="#" class="btn btn-sm btn-info float-right">Voir le profil</a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php else: ?>
    <div class="mt-4 alert alert-info">
        Vous n'avez pas encore d'étudiant à encadrer.
    </div>
    <?php endif; ?>

    <?php else: ?>
    <div class="alert alert-danger">Vous n'êtes pas connecté en tant qu'encadreur.</div>
    <p><a href="index.php?action=connexion_encadreur">Se connecter</a></p>
    <?php endif; ?>
</div>