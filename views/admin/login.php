<?php
$title = 'Connexion Administrateur';
$headerTitle = 'Connexion Administrateur';

ob_start();
?>
<div
    style="max-width:400px;margin:2rem auto;padding:2rem;background:#fff;border-radius:10px;box-shadow:0 4px 8px rgba(0,0,0,0.2);">
    <h1>Connexion Administrateur</h1>
    <?php if (isset($_SESSION['error_message'])): ?>
    <p style="color:red;"><?= $_SESSION['error_message']; unset($_SESSION['error_message']); ?></p>
    <?php endif; ?>
    <form method="POST" action="?action=login_admin">
        <input type="email" name="email" placeholder="Email" required
            style="width:100%;padding:0.8rem;margin:0.5rem 0;">
        <input type="password" name="mot_de_passe" placeholder="Mot de passe" required
            style="width:100%;padding:0.8rem;margin:0.5rem 0;">
        <button type="submit"
            style="width:100%;padding:0.8rem;background:#007bff;color:#fff;border:none;border-radius:5px;">Se
            connecter</button>
    </form>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>