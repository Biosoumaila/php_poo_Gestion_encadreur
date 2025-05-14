<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$title = 'Connexion Étudiant';
$headerTitle = 'Connexion';

ob_start();
?>
<style>
    .login-container {
        max-width: 400px;
        margin: 0 auto;
        padding: 2rem;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .login-container input {
        width: 100%;
        padding: 0.8rem;
        margin: 0.5rem 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .login-container button {
        width: 100%;
        padding: 0.8rem;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
        cursor: pointer;
    }

    .login-container button:hover {
        background-color: #0056b3;
    }

    .switch {
        margin-top: 1rem;
    }

    .switch a {
        color: #007bff;
        text-decoration: none;
    }

    .switch a:hover {
        text-decoration: underline;
    }
</style>

<div class="login-container">
    <h1>Connexion Étudiant</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;">
            <?= $error ?>
        </p>
    <?php endif; ?>
    <form method="POST" action="?action=login_etudiant">
        <input type="email" name="email" placeholder="Adresse e-mail" required>
        <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>
    <div class="switch">
        <p>Pas encore inscrit ? <a href="?action=register_etudiant">S'inscrire</a></p>
    </div>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>