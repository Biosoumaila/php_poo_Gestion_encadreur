<?php
namespace App\Controllers;
use App\Models\Etudiant;



class EtudiantController
{
    private $etudiantModel;
    private $db;


    public function __construct($database)
    {
        $this->etudiantModel = new Etudiant($database);
    }

    public function afficherListeEtudiants()
    {
        $etudiants = $this->etudiantModel->getAllEtudiants();
        require __DIR__ . '/../views/etudiants/listeEtudiants.php';
    }


    public function register($data)
    {
        $nom = $data['nom'];
        $prenom = $data['prenom'];
        $email = $data['email'];
        $filiere = $data['filiere'];
        $anneeFormation = $data['annee_formation'];
        $motDePasse = password_hash($data['mot_de_passe'], PASSWORD_BCRYPT);

        if ($this->etudiantModel->register($nom, $prenom, $email, $filiere, $anneeFormation, $motDePasse)) {
            $_SESSION['success_message'] = "Inscription réussie.";
            header('Location: ?action=login_etudiant');
        } else {
            $_SESSION['error_message'] = "Erreur lors de l'inscription.";
            header('Location: ?action=register_etudiant');
        }
        exit();
    }

    public function login($data)
    {
        $email = $data['email'];
        $motDePasse = $data['mot_de_passe'];

        $etudiant = $this->etudiantModel->findByEmail($email);

        if ($etudiant && password_verify($motDePasse, $etudiant['mot_de_passe'])) {
            $_SESSION['etudiant'] = [
                'id' => $etudiant['id'],
                'nom' => $etudiant['nom'],
                'prenom' => $etudiant['prenom'],
                'email' => $etudiant['email'],
                'filiere' => $etudiant['filiere'],
                'annee_formation' => $etudiant['annee_formation']
            ];
            header('Location: ?action=dashboard_etudiant');
        } else {
            $_SESSION['error_message'] = "Email ou mot de passe incorrect.";
            header('Location: ?action=login_etudiant');
        }
        exit();
    }
    public function getModel()
    {
        return $this->etudiantModel;
    }
    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: ?action=login_etudiant');
        exit();
    }



    public function soumettreCahierDeCharge($data, $files)
    {
        $etudiantId = $_SESSION['etudiant']['id'];
        $nomBinome = $data['nom_binome'] ?? null;

        // Vérifiez si un fichier a été téléversé
        if (isset($files['cahiers_charges']) && $files['cahiers_charges']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../uploads/';
            $fileName = uniqid() . '_' . basename($files['cahiers_charges']['name']);
            $filePath = $uploadDir . $fileName;

            // Créez le dossier d'upload s'il n'existe pas
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Déplacez le fichier téléversé dans le dossier d'upload
            if (move_uploaded_file($files['cahiers_charges']['tmp_name'], $filePath)) {
                // Enregistrez les informations dans la base de données
                if ($this->etudiantModel->soumettreCahierDeCharge($etudiantId, $nomBinome, $fileName)) {
                    $_SESSION['success_message'] = "Cahier de charge soumis avec succès.";
                } else {
                    $_SESSION['error_message'] = "Erreur lors de l'enregistrement du cahier de charge.";
                }
            } else {
                $_SESSION['error_message'] = "Erreur lors du téléversement du fichier.";
            }
        } else {
            $_SESSION['error_message'] = "Aucun fichier valide n'a été téléversé.";
        }

        header('Location: ?action=dashboard');
        exit();
    }

    public function verifierEncadreur()
    {
        $etudiantId = $_SESSION['etudiant']['id'];
        $encadreur = $this->etudiantModel->getEncadreur($etudiantId);

        return $encadreur;
    }

    public function faireRelance()
    {
        $etudiantId = $_SESSION['etudiant']['id'];

        if ($this->etudiantModel->faireRelance($etudiantId)) {
            $_SESSION['success_message'] = "Relance envoyée avec succès.";
        } else {
            $_SESSION['error_message'] = "Erreur lors de l'envoi de la relance.";
        }

        header('Location: ?action=dashboard');
        exit();
    }
}