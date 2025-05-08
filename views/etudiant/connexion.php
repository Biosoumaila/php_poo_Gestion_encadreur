<div class="container">
    <h2>Connexion Étudiant</h2>
    <!-- <form action="index.php?action=connexion_etudiant" method="post"> -->
    <form action="index.php?action=dashboard_etudiant" method="post">

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="mot_de_passe" class="form-label">Mot de passe:</label>
            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
        <p class="mt-3"> Nouveau ?
            <a href="index.php?action=enregistrement_etudiant">Inscrivez-vous</a>
        </p>
    </form>
    <script>
    const form = document.querySelector('form');
    form.addEventListener('submit', (event) => {
        console.log('Formulaire soumis !');
    });
    </script>
</div>