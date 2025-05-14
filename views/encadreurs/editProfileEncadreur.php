<?php
require __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../controllers/EncadreurController.php';
require_once __DIR__ . '/../models/Encadreur.php';
use App\Models\Encadreur;
use App\Models\Database;

$title = 'Modifier le profil Encadreur';
$headerTitle = 'Modifier mes informations';

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
    margin-top: 1rem;
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
</style>
<div class="container">
    <h1>Modifier mes informations</h1>
    <form method="POST" action="?action=update_profile_encadreur">
        <input type="text" name="nom" value="<?= htmlspecialchars($_SESSION['encadreur']['nom']); ?>" required>
        <input type="text" name="prenom" value="<?= htmlspecialchars($_SESSION['encadreur']['prenom']); ?>" required>
        <input type="email" name="email" value="<?= htmlspecialchars($_SESSION['encadreur']['email']); ?>" required>
        <select name="domaine" required>
            <option value="AI" <?= $_SESSION['encadreur']['domaine'] === 'AI' ? 'selected' : ''; ?>>AI</option>
            <option value="SI" <?= $_SESSION['encadreur']['domaine'] === 'SI' ? 'selected' : ''; ?>>SI</option>
            <option value="SRC" <?= $_SESSION['encadreur']['domaine'] === 'SRC' ? 'selected' : ''; ?>>SRC</option>
        </select>
        <button type="submit">Mettre à jour</button>
    </form>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>