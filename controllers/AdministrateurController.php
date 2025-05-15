<?php
namespace App\Controllers;
use App\Models\Administrateur;
use App\Models\Etudiant;

class AdministrateurController
{
    private $adminModel;
    private $etudiantModel;
    private $db;

    public function __construct($database)
    {
        $this->db = $database->getConnection();
        $this->adminModel = new Administrateur($database);
        $this->etudiantModel = new Etudiant($database);
    }

    public function login($data)
    {
        $email = $data['email'];
        $motDePasse = $data['mot_de_passe'];
        $admin = $this->adminModel->findByEmail($email);

        if ($admin && password_verify($motDePasse, $admin['mot_de_passe'])) {
            $_SESSION['admin'] = [
                'id' => $admin['id'],
                'email' => $admin['email'],
                'nom' => $admin['nom']
            ];
            header('Location: ?action=dashboard_admin');
        } else {
            $_SESSION['error_message'] = "Identifiants incorrects.";
            header('Location: ?action=login_admin');
        }
        exit();
    }

    public function register($data)
    {
        $nom = $data['nom'];
        $prenom = $data['prenom'];
        $email = $data['email'];
        $motDePasse = password_hash($data['mot_de_passe'], PASSWORD_BCRYPT);

        if ($this->adminModel->register($nom, $prenom, $email, $motDePasse)) {
            $_SESSION['success_message'] = "Inscription réussie. Connectez-vous.";
            header('Location: ?action=login_admin');
        } else {
            $_SESSION['error_message'] = "Erreur lors de l'inscription.";
            header('Location: ?action=register_admin');
        }
        exit();
    }
    public function assignEncadreurToEtudiant($etudiantId, $encadreurId)
    {
        $this->etudiantModel->setEncadreur($etudiantId, $encadreurId);
        $_SESSION['success_message'] = "Encadreur attribué avec succès.";
        header('Location: ?action=dashboard_admin');
        exit();
    }

    public function logout()
    {
        session_destroy();
        header('Location: ?action=login_admin');
        exit();
    }
}