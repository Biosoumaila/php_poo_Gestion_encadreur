<?php

require_once __DIR__ . '/../database.php';

class Encadreur
{

    private $db;
    public function __construct(Database $database)
    { // Accepte un objet Database

        $this->db = $database;
    }


    public function register($nom, $prenom, $email, $mot_de_passe, $domaine)
    {
        // Vérifier si l'email existe déjà
        if ($this->isEmailExists($email)) {
            return false; // L'email existe déjà
        }

        // Hasher le mot de passe de manière sécurisée
        $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        try {
            $query = $this->db->getConnection()->prepare("INSERT INTO encadreurs (nom,prenom, email, mot_de_passe,domaine,annee_formation) VALUES (:nom, :prenom, :email, :mot_de_passe,:domaine, :annee_formation)");
            $query->bindParam(":nom", $nom);
            $query->bindParam(":prenom", $prenom);
            $query->bindParam(":email", $email);
            $query->bindParam(":mot_de_passe", $mot_de_passe_hash);
            $query->bindParam(":domaine", $domaine);
            $query->execute();
            return true; // Enregistrement réussi
        } catch (PDOException $e) {
            // Gérer les erreurs d'insertion (par exemple, si l'email viole la contrainte UNIQUE)
            return false;
        }
    }

    public function login($email, $mot_de_passe)
    {
        $query = $this->db->getConnection()->prepare("SELECT id,nom,prenom, mot_de_passe FROM encadreurs WHERE email = :email");
        $query->bindParam(":email", $email);
        $query->execute();
        $encadreur = $query->fetch(PDO::FETCH_ASSOC);

        if ($encadreur && password_verify($mot_de_passe, $encadreur['mot_de_passe'])) {
            // Le mot de passe correspond, retourner les informations de l'encadreur (sans le mot de passe hashé)
            return ['id' => $encadreur['id'], 'nom' => $encadreur['nom'], 'prenom' => $encadreur['prenom'], 'email' => $email, 'domaine' => $encadreur['domaine']];
        } else {
            return false; // Identifiants incorrects
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: encadreurs/login.php');
        exit();
    }

    public function relance()
    {
        if (isset($_SESSION['encadreur_id'])) {
            ob_start();
            require __DIR__ . '/relance.php';
            $content = ob_get_clean();
            require __DIR__ . '/../index.php';
        } else {
            header('Location: /encadreurs/login.ph');
            exit();
        }
    }



    private function isEmailExists($email)
    {
        $query = $this->db->getConnection()->prepare("SELECT COUNT(*) FROM encadreurs WHERE email = :email");
        $query->bindParam(":email", $email);
        $query->execute();
        return $query->fetchColumn() > 0;
    }
}