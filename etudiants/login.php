<!DOCTYPE html>
<html>

<head>
    <title>Connexion Etudiant</title>
</head>

<body>
    <h1>Connexion Etudiant</h1>
    <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid_credentials'): ?>
        <p style="color: red;">Email ou mot de passe incorrect.</p>
    <?php endif; ?>
    <form method="POST" action="login_process.php">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="nom" id="nom" name="nom" required>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prenom :</label>
            <input type="prenom" id="prenom" name="prenom" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email :</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="mot_de_passe" class="form-label">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        </div>
        <button type="submit">Se connecter</button>
        <p>Pas de compte ? <a href="register.php">S'inscrire</a></p>
    </form>
</body>

</html>