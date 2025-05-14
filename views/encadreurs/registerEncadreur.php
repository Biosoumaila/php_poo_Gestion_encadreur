<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} // Démarre la session
require_once __DIR__ . '/../../models/Encadreur.php';
require_once __DIR__ . '/../../core/Database.php'; // Inclut le modèle Database
require_once __DIR__ . '/../../controllers/EncadreurController.php'; // Inclut le contrôleur Encadreur
use App\Models\Encadreur;
use App\Models\Database;
use App\Controllers\EncadreurController;
$title = 'Inscription Encadreur';
$headerTitle = 'Inscription Encadreur';

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
    <h1>Inscription Encadreur</h1>
    <form method="POST" action="?action=register_encadreur">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
        <select name="domaine" required>
            <option value="AI">AL</option>
            <option value="SI">SI</option>
            <option value="SRC">SRC</option>
            <option value="SRC&&AL">SRC et AL</option>
            <option value="SRC&&SI">SRC et SI</option>
            <option value="AL&&SI">AL et SI</option>
            <option value="SI&&AL&&SI"> SI et AL et SI</option>
        </select>
        <button type="submit">S'inscrire</button>
    </form>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>