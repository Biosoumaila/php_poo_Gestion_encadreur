<?php
require __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../controllers/EncadreurController.php';
require_once __DIR__ . '/../models/Encadreur.php';
require_once __DIR__ . '/../models/Etudiant.php';

use App\Models\Encadreur;
use App\Models\Etudiant;
use App\Models\Database;
use App\Controllers\EncadreurController;

$title = "Page d'accueil";
$headerTitle = "Bienvenue sur l'application de gestion";
ob_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f4f9;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 500px;
        margin: 5rem auto;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        padding: 2rem;
        text-align: center;
    }

    .main-btn,
    .role-btn,
    .action-btn {
        display: block;
        width: 100%;
        margin: 1rem 0;
        padding: 1rem;
        font-size: 1.1rem;
        border: none;
        border-radius: 5px;
        background: #007bff;
        color: #fff;
        cursor: pointer;
        transition: background 0.2s;
    }

    .main-btn:hover,
    .role-btn:hover,
    .action-btn:hover {
        background: #0056b3;
    }

    .hidden {
        display: none;
    }

    .role-actions {
        margin-top: 1rem;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1><?= $headerTitle ?></h1>
        <button class="main-btn" id="showRoleList">Connexion</button>

        <div id="roleList" class="hidden">
            <button class="role-btn" onclick="showActions('etudiant')">Étudiant</button>
            <button class="role-btn" onclick="showActions('encadreur')">Encadreur</button>
            <button class="role-btn" onclick="showActions('admin')">Administrateur</button>
            <button class="role-btn" onclick="hideAll()">Retour</button>
        </div>

        <div class="role-actions hidden" id="etudiantActions">
            <button class="action-btn" onclick="window.location='?action=login_etudiant'">Se connecter
                (Étudiant)</button>
            <button class="action-btn" onclick="window.location='?action=register_etudiant'">S'inscrire
                (Étudiant)</button>
            <button class="action-btn" onclick="backToRoleList()">Retour</button>
        </div>
        <div class="role-actions hidden" id="encadreurActions">
            <button class="action-btn" onclick="window.location='?action=login_encadreur'">Se connecter
                (Encadreur)</button>
            <button class="action-btn" onclick="window.location='?action=register_encadreur'">S'inscrire
                (Encadreur)</button>
            <button class="action-btn" onclick="backToRoleList()">Retour</button>
        </div>
        <div class="role-actions hidden" id="adminActions">
            <button class="action-btn" onclick="window.location='?action=login_admin'">Se connecter
                (Administrateur)</button>
            <button class="action-btn" onclick="window.location='?action=register_admin'">S'inscrire
                (Administrateur)</button>

            <button class="action-btn" onclick="backToRoleList()">Retour</button>
        </div>
    </div>
    <script>
    const showRoleListBtn = document.getElementById('showRoleList');
    const roleList = document.getElementById('roleList');
    const etudiantActions = document.getElementById('etudiantActions');
    const encadreurActions = document.getElementById('encadreurActions');
    const adminActions = document.getElementById('adminActions');

    showRoleListBtn.onclick = function() {
        showRoleListBtn.classList.add('hidden');
        roleList.classList.remove('hidden');
        etudiantActions.classList.add('hidden');
        encadreurActions.classList.add('hidden');
        adminActions.classList.add('hidden');
    };

    function showActions(role) {
        roleList.classList.add('hidden');
        etudiantActions.classList.add('hidden');
        encadreurActions.classList.add('hidden');
        adminActions.classList.add('hidden');
        if (role === 'etudiant') etudiantActions.classList.remove('hidden');
        if (role === 'encadreur') encadreurActions.classList.remove('hidden');
        if (role === 'admin') adminActions.classList.remove('hidden');
    }

    function backToRoleList() {
        roleList.classList.remove('hidden');
        etudiantActions.classList.add('hidden');
        encadreurActions.classList.add('hidden');
        adminActions.classList.add('hidden');
    }

    function hideAll() {
        roleList.classList.add('hidden');
        showRoleListBtn.classList.remove('hidden');
        etudiantActions.classList.add('hidden');
        encadreurActions.classList.add('hidden');
        adminActions.classList.add('hidden');
    }
    </script>
</body>

</html>
<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
?>