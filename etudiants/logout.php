<?php


require '../database.php';
require '../etudiants/etudiant.php';
// Créer une instance de ta classe
$database = new Database();
$etudiant = new Etudiant($database);

if (isset($_GET['logout'])) {
    $etudiant->logout();

}

?>


<a href="../index.php">Déconnexion</a>