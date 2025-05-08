<?php

require_once __DIR__ . '/../models/Encadreur.php';

class EncadreurController {
    public function enregistrement() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $email = $_POST['email'] ?? '';
            $motDePasse = $_POST['mot_de_passe'] ?? '';
            $domaine = $_POST['domaine'] ?? '';

            // Effectuer la validation des données (très important !)
            if (empty($nom) || empty($prenom) || empty($email) || empty($motDePasse) || empty($domaine)) {
                $erreur = "Tous les champs sont obligatoires.";
                ob_start();
                require __DIR__ . '/../views/encadreur/enregistrement.php';
                $content = ob_get_clean();
                require __DIR__ . '/../views/layouts/default.php';
                return;
            }

            $encadreur = new Encadreur();
            $encadreur->setNom($nom);
            $encadreur->setPrenom($prenom);
            $encadreur->setEmail($email);
            $encadreur->setMotDePasse(password_hash($motDePasse, PASSWORD_DEFAULT)); // Hashage du mot de passe
            $encadreur->setDomaine($domaine);

            if ($encadreur->findByEmail($email)) {
                $erreur = "Cet email est déjà utilisé.";
                ob_start();
                require __DIR__ . '/../views/encadreur/enregistrement.php';
                $content = ob_get_clean();
                require __DIR__ . '/../views/layouts/default.php';
                return;
            }

            $encadreurId = $encadreur->create();
            if ($encadreurId) {
                header('Location: index.php?action=connexion_encadreur&success=enregistrement');
                exit();
            } else {
                $erreur = "Une erreur est survenue lors de l'enregistrement. Veuillez réessayer.";
                ob_start();
                require __DIR__ . '/../views/encadreur/enregistrement.php';
                $content = ob_get_clean();
                require __DIR__ . '/../views/layouts/default.php';
            }
        } else {
            ob_start();
            require __DIR__ . '/../views/encadreur/enregistrement.php';
            $content = ob_get_clean();
            require __DIR__ . '/../views/layouts/default.php';
        }
    }

    public function connexion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $emailSaisi = $_POST['email'];
            $motDePasseSaisi = $_POST['mot_de_passe'];

            $encadreurModel = new Encadreur();
            $encadreur = $encadreurModel->findByEmail($emailSaisi);

            // Debugging: Afficher l'objet encadreur récupéré
            var_dump($encadreur);

            if ($encadreur) {
                // Debugging: Afficher le mot de passe haché de la base de données
                var_dump($encadreur->getMotDePasse());

                if (password_verify($motDePasseSaisi, $encadreur->getMotDePasse())) {
                    $_SESSION['user_id'] = $encadreur->getId();
                    $_SESSION['user_role'] = 'encadreur';
                    header('Location: index.php?action=dashboard_encadreur');
                    exit();
                } else {
                    $erreur = "Mot de passe incorrect.";
                    ob_start();
                    require __DIR__ . '/../views/encadreur/connexion.php';
                    $content = ob_get_clean();
                    require __DIR__ . '/../views/layouts/default.php';
                }
            } else {
                $erreur = "Email incorrect.";
                ob_start();
                require __DIR__ . '/../views/encadreur/connexion.php';
                $content = ob_get_clean();
                require __DIR__ . '/../views/layouts/default.php';
            }
        } else {
            ob_start();
            require __DIR__ . '/../views/encadreur/connexion.php';
            $content = ob_get_clean();
            require __DIR__ . '/../views/layouts/default.php';
        }
    }

    public function dashboard() {
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'encadreur') {
            $encadreur = new Encadreur();
            $encadreur->setId($_SESSION['user_id']);
            $encadreur = $encadreur->findById($_SESSION['user_id']);
            ob_start();
            require __DIR__ . '/../views/encadreur/dashboard.php';
            $content = ob_get_clean();
            require __DIR__ . '/../views/layouts/default.php';
        } else {
            header('Location: index.php?action=connexion_encadreur');
            exit();
        }
    }

    public function profil() {
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'encadreur') {
            $encadreur = new Encadreur();
            $encadreur->setId($_SESSION['user_id']);
            $encadreur = $encadreur->findById($_SESSION['user_id']);
            ob_start();
            require __DIR__ . '/../views/encadreur/profil.php';
            $content = ob_get_clean();
            require __DIR__ . '/../views/layouts/default.php';
        } else {
            header('Location: index.php?action=connexion_encadreur');
            exit();
        }
    }

    public function listeEtudiants() {
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'encadreur') {
            $encadreur = new Encadreur();
            $encadreur->setId($_SESSION['user_id']);
            $encadreur = $encadreur->findById($_SESSION['user_id']);
            $etudiants = $encadreur->getEtudiantsEncadres();
            ob_start();
            require __DIR__ . '/../views/encadreur/liste_etudiants.php';
            $content = ob_get_clean();
            require __DIR__ . '/../views/layouts/default.php';
        } else {
            header('Location: index.php?action=connexion_encadreur');
            exit();
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?action=connexion_encadreur');
        exit();
    }
}