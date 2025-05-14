<?php

$title = 'Inscription Étudiant';
$headerTitle = 'Inscription';

ob_start();
?>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f9;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        background-color: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        text-align: center;
        width: 100%;
        max-width: 400px;
    }

    h1 {
        color: #007bff;
        margin-bottom: 1rem;
    }

    form {
        margin-top: 0.5rem;
    }

    input,
    select {
        width: 100%;
        padding: 0.8rem;
        margin: 0.5rem 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1rem;
    }

    button {
        width: 100%;
        padding: 0.8rem;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
        cursor: pointer;
        margin-top: 1rem;
    }

    button:hover {
        background-color: #0056b3;
    }

    .switch {
        margin-top: 1rem;
    }

    .switch a {
        color: #007bff;
        text-decoration: none;
        font-size: 0.9rem;
    }

    .switch a:hover {
        text-decoration: underline;
    }
</style>
<div class="container">
    <h1>Inscription Étudiant</h1>
    <form method="POST" action="?action=register_etudiant">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <input type="email" name="email" placeholder="Email" required>
        <select name="filiere" required>
            <option value="" disabled selected>Choisissez une filière</option>
            <option value="AL">AL</option>
            <option value="SI">SI</option>
            <option value="SRC">SRC</option>
        </select>
        <input type="number" name="annee_formation" placeholder="Année de formation" required>
        <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
        <button type="submit">S'inscrire</button>
    </form>
    <div class="switch">
        <p>Déjà inscrit ? <a href="?action=login_etudiant">Se connecter</a></p>
    </div>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>