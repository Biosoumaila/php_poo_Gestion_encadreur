<div class="container">
    <h2>Tableau de bord Étudiant</h2>

    <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'etudiant'): ?>
    <p>Bienvenue, **<?= htmlspecialchars($etudiant->getPrenom()) ?> <?= htmlspecialchars($etudiant->getNom()) ?>** !</p>
    <p>Votre identifiant étudiant est : <?= htmlspecialchars($etudiant->getId()) ?></p>
    <p>Votre filière : <?= htmlspecialchars($etudiant->getFiliere()) ?></p>
    <p>Votre année de formation : <?= htmlspecialchars($etudiant->getAnneeFormation()) ?></p>

    <div class="mt-4">
        <h3>Actions disponibles :</h3>
        <ul class="list-group">
            <li class="list-group-item"><a href="index.php?action=profil_etudiant">Consulter mon profil</a></li>
            <li class="list-group-item"><a href="index.php?action=voir_encadreur">Voir mon encadreur</a></li>
            <li class="list-group-item"><a href="index.php?action=soumettre_cahier">Soumettre mon cahier des charges</a>
            </li>
            <li class="list-group-item"><a href="index.php?action=relance_etudiant">Faire une relance (si aucun
                    encadreur n'est affecté)</a></li>
            <li class="list-group-item"><a href="index.php?action=logout_etudiant">Se déconnecter</a></li>
        </ul>
    </div>

    <?php if ($etudiant->getEncadreur()): ?>
    <div class="mt-4">
        <h3>Votre encadreur :</h3>
        <p>Nom : <?= htmlspecialchars($etudiant->getEncadreur()->getNom()) ?></p>
        <p>Prénom : <?= htmlspecialchars($etudiant->getEncadreur()->getPrenom()) ?></p>
        <p>Email : <?= htmlspecialchars($etudiant->getEncadreur()->getEmail()) ?></p>
        <p>Domaine : <?= htmlspecialchars($etudiant->getEncadreur()->getDomaine()) ?></p>
    </div>
    <?php else: ?>
    <div class="mt-4 alert alert-warning">
        Aucun encadreur ne vous a encore été affecté. Vous pouvez faire une <a
            href="index.php?action=relance_etudiant">relance</a>.
    </div>
    <?php endif; ?>

    <?php else: ?>
    <div class="alert alert-danger">Vous n'êtes pas connecté en tant qu'étudiant.</div>
    <p><a href="index.php?action=connexion_etudiant">Se connecter</a></p>
    <?php endif; ?>
</div>