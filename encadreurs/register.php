<!DOCTYPE html>
<html>

<head>
    <title>Inscription Encadreur</title>
</head>

<body>
    <h1>Inscription d'Encadreur</h1>
    <?php if (isset($_GET['error']) && $_GET['error'] === 'email_exists'): ?>
        <p style="color: red;">Cet email est déjà enregistré.</p>
    <?php endif; ?>
    <?php if (isset($_GET['success']) && $_GET['success'] === 'registered'): ?>
        <p style="color: green;">Inscription réussie ! Vous pouvez maintenant vous connecter.</p>
    <?php endif; ?>
    <form method="POST" action="register_process.php">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Premom :</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email :</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        </div>
        <div class="mb-3">
            <label for="domaine" class="form-label">domaine:</label>
            <select class="form-control" id="domaine" name="domaine" required>
                <option value="">Sélectionnez une domaine</option>
                <option value="AL">AL</option>
                <option value="SI">SI</option>
                <option value="src">src</option>
                <option value="src && Al">src et Al</option>
                <option value="src && Al">si et Al</option>
                <option value="src && Al && si">si et Al et src</option>
            </select>
        </div>
        <button type="submit">S'inscrire</button>
        <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
    </form>
</body>

</html>