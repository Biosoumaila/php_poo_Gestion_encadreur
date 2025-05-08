<div class="container">
    <h2>Inscription Étudiant</h2>
    <?php if (isset($erreur)): ?>
    <div class="alert alert-danger"><?= $erreur ?></div>
    <?php endif; ?>
    <form action="index.php?action=enregistrement_etudiant" method="post" accept-charset="UTF-8">
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
            <label for="filiere" class="form-label">Filière:</label>
            <select class="form-control" id="filiere" name="filiere" required>
                <option value="">Sélectionnez une filière</option>
                <option value="Informatique">Informatique</option>
                <option value="Gestion">Gestion</option>
                <option value="Marketing">Marketing</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="annee_formation" class="form-label">Année de formation:</label>
            <select class="form-control" id="annee_formation" name="annee_formation" required>
                <option value="">Sélectionnez une annee de formation</option>
                <option value="licence1">licence 1</option>
                <option value="licence2">licence 2</option>
                <option value="licence3">licence 3</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
</div>