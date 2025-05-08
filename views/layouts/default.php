<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion d'Encadrement</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Gestion Encadrement</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['user_role'])): ?>
                <?php if ($_SESSION['user_role'] === 'etudiant'): ?>
                <li class="nav-item"><a class="nav-link" href="index.php?action=dashboard_etudiant">Tableau de bord</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=profil_etudiant">Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=voir_encadreur">Mon Encadreur</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=soumettre_cahier">Soumettre Cahier</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=relance_etudiant">Relance</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=logout_etudiant">Déconnexion</a></li>
                <?php elseif ($_SESSION['user_role'] === 'encadreur'): ?>
                <li class="nav-item"><a class="nav-link" href="index.php?action=dashboard_encadreur">Tableau de bord</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=profil_encadreur">Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=liste_etudiants_encadreur">Mes
                        Étudiants</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=logout_encadreur">Déconnexion</a></li>
                <?php elseif ($_SESSION['user_role'] === 'admin'): ?>
                <li class="nav-item"><a class="nav-link" href="index.php?action=dashboard_admin">Tableau de bord</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=profil_admin">Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=liste_etudiants_admin">Liste
                        Étudiants</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=liste_encadreurs_admin">Liste
                        Encadreurs</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=affecter_encadreur_admin">Affecter
                        Encadreur</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=logout_admin">Déconnexion</a></li>
                <?php endif; ?>
                <?php else: ?>
                <li class="nav-item"><a class="nav-link" href="index.php?action=enregistrement_etudiant">Inscription
                        Étudiant</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=connexion_etudiant">Connexion
                        Étudiant</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=enregistrement_encadreur">Inscription
                        Encadreur</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=connexion_encadreur">Connexion
                        Encadreur</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=connexion_admin">Connexion Admin</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <?php echo $content; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="public/js/script.js"></script>
</body>

</html>