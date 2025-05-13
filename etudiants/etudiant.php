<?php

// require_once '../database.php';
require_once __DIR__ . '/../database.php';
require_once __DIR__ . '/modelRelance.php';


class Etudiant
{

    private $db;
    public function __construct(Database $database)
    { // Accepte un objet Database

        $this->db = $database;
    }


    public function register($nom, $prenom, $email, $mot_de_passe, $filiere, $annee_formation)
    {
        // Vérifier si l'email existe déjà
        if ($this->isEmailExists($email)) {
            return false; // L'email existe déjà
        }

        // Hasher le mot de passe de manière sécurisée
        $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        try {
            $query = $this->db->getConnection()->prepare("INSERT INTO etudiants (nom,prenom, email, mot_de_passe,filiere,annee_formation) VALUES (:nom, :prenom, :email, :mot_de_passe,:filiere, :annee_formation)");
            $query->bindParam(":nom", $nom);
            $query->bindParam(":prenom", $prenom);
            $query->bindParam(":email", $email);
            $query->bindParam(":mot_de_passe", $mot_de_passe_hash);
            $query->bindParam(":filiere", $filiere);
            $query->bindParam(":annee_formation", $annee_formation);
            $query->execute();
            return true; // Enregistrement réussi
        } catch (PDOException $e) {
            // Gérer les erreurs d'insertion (par exemple, si l'email viole la contrainte UNIQUE)
            return false;
        }
    }

    public function login($email, $mot_de_passe)
    {
        $query = $this->db->getConnection()->prepare("SELECT id,nom,prenom, mot_de_passe FROM etudiants WHERE email = :email");
        $query->bindParam(":email", $email);
        $query->execute();
        $etudiant = $query->fetch(PDO::FETCH_ASSOC);

        if ($etudiant && password_verify($mot_de_passe, $etudiant['mot_de_passe'])) {
            // Le mot de passe correspond, retourner les informations de l'etudiant (sans le mot de passe hashé)
            return ['id' => $etudiant['id'], 'nom' => $etudiant['nom'], 'prenom' => $etudiant['prenom'], 'email' => $email, 'filiere' => $etudiant['filiere'], 'annee_formation' => $etudiant['annee_formation']];
        } else {
            return false; // Identifiants incorrects
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: etudiants/login.php');
        exit();
    }

    public function relance()
    {
        if (isset($_SESSION['etudiant_id'])) {
            ob_start();
            require __DIR__ . '/relance.php';
            $content = ob_get_clean();
            require __DIR__ . '/../index.php';
        } else {
            header('Location: /etudiants/login.ph');
            exit();
        }
    }


    public function enregistrerRelance()
    {
        // session_start();
        $db = new Database();
        $relanceModel = new Relance($db);
        $etudiant_id = $_SESSION['etudiant_id'];

        try {
            $relanceModel->setEtudiant_id($etudiant_id);
            $relanceModel->setDate_relance(date('Y-m-d H:i:s')); // Enregistrer la date de la relance

            if ($relanceModel->create()) {
                $message = "Votre demande de relance a été enregistrée. L'administrateur en sera informé.";
                $_SESSION['relance_message'] = $message;
                header('Location: /etudiants/profil.php'); // Rediriger vers la page de profil avec un message
                exit();
            } else {
                $erreur = "Une erreur est survenue lors de l'enregistrement de votre relance. Veuillez réessayer.";
                $_SESSION['relance_erreur'] = $erreur;
                header('Location: /etudiants/relance.php'); // Rediriger avec une erreur
                exit();
            }
        } catch (Exception $e) {
            $erreur = "Une erreur est survenue : " . $e->getMessage();
            $_SESSION['relance_erreur'] = $erreur;
            header('Location: /etudiants/relance.php'); // Rediriger avec une erreur
            exit();
        }
    }

    private function isEmailExists($email)
    {
        $query = $this->db->getConnection()->prepare("SELECT COUNT(*) FROM etudiants WHERE email = :email");
        $query->bindParam(":email", $email);
        $query->execute();
        return $query->fetchColumn() > 0;
    }
}