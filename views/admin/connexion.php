<div class="container">
    <h2>Connexion Administrateur</h2>
    <?php if (isset($erreur)): ?>
    <div class="alert alert-danger"><?= $erreur ?></div>
    <?php endif; ?>
    <form action="index.php?action=connexion_admin" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="mot_de_passe" class="form-label">Mot de passe:</label>
            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</div>