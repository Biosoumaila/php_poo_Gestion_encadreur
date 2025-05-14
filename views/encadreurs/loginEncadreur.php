<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../core/Database.php';
require_once __DIR__ . '/../../controllers/EncadreurController.php';

use App\Models\Encadreur;
use App\Models\Etudiant;
use App\Models\Database;
use App\Controllers\EncadreurController;

$title = 'Connexion Encadreur';
$headerTitle = 'Connexion Encadreur';

ob_start();
?>
<div class="container">
    <h1>Connexion Encadreur</h1>
    <form method="POST" action="?action=dashboard_encadreur">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>