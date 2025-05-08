<?php

require_once __DIR__ . '/../models/Admin.php'; // Utilisez le modèle Admin

class AdminController {
    public function connexion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $motDePasse = $_POST['mot_de_passe'];

            $adminModel = new Admin(); // Instanciez le modèle Admin
            $administrateur = $adminModel->findByEmail($email);

            // Debugging: Afficher l'objet administrateur récupéré
            var_dump($administrateur);

            if ($administrateur) {
                // Debugging: Afficher le mot de passe haché de la base de données
                var_dump($administrateur->getMotDePasse());

                if (password_verify($motDePasse, $administrateur->getMotDePasse())) {
                    $_SESSION['user_id'] = $administrateur->getId();
                    $_SESSION['user_role'] = 'admin'; // Définir le rôle comme 'admin'
                    header('Location: index.php?action=dashboard_admin'); // Rediriger vers le tableau de bord admin
                    exit();
                } else {
                    $erreur = "Mot de passe incorrect.";
                    ob_start();
                    require __DIR__ . '/../views/admin/connexion.php'; // Créez cette vue
                    $content = ob_get_clean();
                    require __DIR__ . '/../views/layouts/default.php';
                }
            } else {
                $erreur = "Email incorrect.";
                ob_start();
                require __DIR__ . '/../views/admin/connexion.php'; // Créez cette vue
                $content = ob_get_clean();
                require __DIR__ . '/../views/layouts/default.php';
            }
        } else {
            ob_start();
            require __DIR__ . '/../views/admin/connexion.php'; // Créez cette vue
            $content = ob_get_clean();
            require __DIR__ . '/../views/layouts/default.php';
        }
    }

    public function dashboard() {
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin') {
            $adminModel = new Admin();
            $administrateur = $adminModel->findById($_SESSION['user_id']); // Vous devrez peut-être ajouter cette méthode au modèle Admin
            ob_start();
            require __DIR__ . '/../views/admin/dashboard.php'; // Créez cette vue
            $content = ob_get_clean();
            require __DIR__ . '/../views/layouts/default.php';
        } else {
            header('Location: index.php?action=connexion_admin'); // Rediriger vers la page de connexion admin
            exit();
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?action=connexion_admin'); // Rediriger vers la page de connexion admin
        exit();
    }

    public function listeEtudiants() {
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin') {
            $adminModel = new Admin();
            $etudiants = $adminModel->getAllEtudiants();
            ob_start();
            require __DIR__ . '/../views/admin/liste_etudiants.php'; // Créez cette vue
            $content = ob_get_clean();
            require __DIR__ . '/../views/layouts/default.php';
        } else {
            header('Location: index.php?action=connexion_admin');
            exit();
        }
    }

    public function listeEncadreurs() {
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin') {
            $adminModel = new Admin();
            $encadreurs = $adminModel->getAllEncadreurs();
            ob_start();
            require __DIR__ . '/../views/admin/liste_encadreurs.php'; // Créez cette vue
            $content = ob_get_clean();
            require __DIR__ . '/../views/layouts/default.php';
        } else {
            header('Location: index.php?action=connexion_admin');
            exit();
        }
    }

    public function affecterEncadreurAction() {
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $etudiantId = $_POST['etudiant_id'] ?? null;
            $encadreurId = $_POST['encadreur_id'] ?? null;

            if ($etudiantId && $encadreurId) {
                $adminModel = new Admin();
                if ($adminModel->affecterEncadreur($etudiantId, $encadreurId)) {
                    header('Location: index.php?action=liste_etudiants_admin&success=affectation');
                    exit();
                } else {
                    $erreur = "Erreur lors de l'affectation.";
                    // Gérer l'erreur (afficher un message à l'admin)
                }
            } else {
                $erreur = "ID étudiant ou ID encadreur manquant.";
                // Gérer l'erreur
            }
            // Rediriger ou afficher un message d'erreur
        } else {
            header('Location: index.php?action=connexion_admin');
            exit();
        }
    }

    // ... autres méthodes spécifiques à l'administration ...
}