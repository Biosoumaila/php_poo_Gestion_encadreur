<?php
$title = 'Inscription Administrateur';
$headerTitle = 'Inscription Administrateur';

ob_start();
?>
<div
    style="max-width:400px;margin:2rem auto;padding:2rem;background:#fff;border-radius:10px;box-shadow:0 4px 8px rgba(0,0,0,0.2);">
    <h1>Inscription Administrateur</h1>
    <?php if (isset($_SESSION['error_message'])): ?>
        <p style="color:red;"><?= $_SESSION['error_message'];
        unset($_SESSION['error_message']); ?></p>
    <?php endif; ?>
    <form method="POST" action="?action=register_admin">
        <input type="text" name="nom" placeholder="Nom" required style="width:100%;padding:0.8rem;margin:0.5rem 0;">
        <input type="text" name="prenom" placeholder="Prénom" required
            style="width:100%;padding:0.8rem;margin:0.5rem 0;">
        <input type="email" name="email" placeholder="Email" required
            style="width:100%;padding:0.8rem;margin:0.5rem 0;">
        <input type="password" name="mot_de_passe" placeholder="Mot de passe" required
            style="width:100%;padding:0.8rem;margin:0.5rem 0;">
        <button type="submit"
            style="width:100%;padding:0.8rem;background:#007bff;color:#fff;border:none;border-radius:5px;">S'inscrire</button>
    </form>
    <div style="margin-top:1rem;">
        <a href="?action=login_admin">Déjà inscrit ? Se connecter</a>
    </div>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>