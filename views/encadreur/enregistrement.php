<div class="container">
    <h2>Inscription Encadreur</h2>
    <?php if (isset($erreur)): ?>
    <div class="alert alert-danger"><?= $erreur ?></div>
    <?php endif; ?>
    <form action="index.php?action=enregistrement_encadreur" method="post">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom:</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom:</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="mot_de_passe" class="form-label">Mot de passe:</label>
            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
        </div>
        <div class="mb-3">
            <label for="domaine" class="form-label">Domaine d'expertise:</label>
            <select class="form-control" id="domaine" name="domaine" required>
                <option value="">Sélectionnez votre domaine</option>
                <option value="AL">AL</option>
                <option value="SI">SI</option>
                <option value="AL & SRC">AL & SRC </option>
                <option value="AL & SI">AL & SI</option>
                <option value="SRC & SI">SRC & SI</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
</div>