<?php

require_once __DIR__ . '/../models/Etudiant.php';
require_once __DIR__ . '/../models/CahierCharge.php';
require_once __DIR__ . '/../models/Encadreur.php'; // Ajout de la dépendance Encadreur

class EtudiantController {
    public function connexion() {
        // Vérifie si la méthode de la requête est POST (soumission du formulaire)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupère et filtre les données saisies par l'utilisateur
            $emailSaisi = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $motDePasseSaisi = filter_input(INPUT_POST, 'mot_de_passe', FILTER_SANITIZE_STRING);

            // Affiche les informations saisies (pour le débogage, à retirer en production)
            echo "<br>Email saisi : " . htmlspecialchars($emailSaisi) . "<br>";
            echo "Mot de passe saisi : " . htmlspecialchars($motDePasseSaisi) . "<br>";

            try {
                // Instancie le modèle Etudiant
                $etudiantModel = new Etudiant();
                // Recherche l'étudiant par son email
                $etudiant = $etudiantModel->findByEmail($emailSaisi);

                // Vérifie si un étudiant a été trouvé avec cet email
                if ($etudiant) {
                    echo "<br>Étudiant trouvé dans la base de données :<br>"; // Ajout (pour le débogage)
                    echo "<pre>";
                    var_dump($etudiant);
                    echo "</pre>";

                    // Récupère le mot de passe hashé de la base de données
                    $motDePasseHashBD = $etudiant->getMotDePasse();

                    echo "<br>Mot de passe haché de la base de données : " . htmlspecialchars($motDePasseHashBD) . "<br>"; // Ajout (pour le débogage)

                    // Vérifie si le mot de passe saisi correspond au hash de la base de données
                    if (password_verify($motDePasseSaisi, $motDePasseHashBD)) {
                        echo "<br>Mot de passe vérifié avec succès !<br>"; // Ajout (pour le débogage)
                        // Régénère l'ID de session pour plus de sécurité
                        session_regenerate_id(true);
                        // Stocke l'ID de l'utilisateur et son rôle dans la session
                        $_SESSION['user_id'] = $etudiant->getId();
                        $_SESSION['user_role'] = 'etudiant';
                        echo "<br>Redirection vers le tableau de bord...<br>"; // Ajout (pour le débogage)
                        // Redirige l'utilisateur vers le tableau de bord étudiant
                        header('Location: index.php?action=dashboard_etudiant');
                        exit();
                    } else {
                        echo "<br>La vérification du mot de passe a échoué.<br>"; // Ajout (pour le débogage)
                        $erreur = "Email ou mot de passe incorrect.";
                        $_SESSION['connexion_erreur'] = $erreur;
                        echo "<br>Redirection vers la page de connexion avec erreur...<br>"; // Ajout (pour le débogage)
                        // Redirige l'utilisateur vers la page de connexion avec un message d'erreur
                        header('Location: index.php?action=connexion_etudiant');
                        exit();
                    }
                } else {
                    echo "<br>Aucun étudiant trouvé avec cet email.<br>"; // Ajout (pour le débogage)
                    $erreur = "Email ou mot de passe incorrect.";
                    $_SESSION['connexion_erreur'] = $erreur;
                    echo "<br>Redirection vers la page de connexion avec erreur...<br>"; // Ajout (pour le débogage)
                    // Redirige l'utilisateur vers la page de connexion avec un message d'erreur
                    header('Location: index.php?action=connexion_etudiant');
                    exit();
                }
            } catch (Exception $e) {
                echo "<br>Une exception s'est produite : " . htmlspecialchars($e->getMessage()) . "<br>"; // Ajout (pour le débogage)
                $erreur = "Une erreur est survenue : " . $e->getMessage();
                $_SESSION['connexion_erreur'] = $erreur;
                echo "<br>Redirection vers la page de connexion avec erreur...<br>"; // Ajout (pour le débogage)
                // Redirige l'utilisateur vers la page de connexion en cas d'erreur
                header('Location: index.php?action=connexion_etudiant');
                exit();
            }
        } else {
            echo "<br>Méthode de requête : PAS POST<br>"; // Ajout (pour le débogage)
            // Si la méthode n'est pas POST, affiche le formulaire de connexion
            ob_start();
            require __DIR__ . '/../views/etudiant/connexion.php';
            $content = ob_get_clean();
            require __DIR__ . '/../views/layouts/default.php';
        }
        // Fin de la méthode connexion
    }

    public function dashboard() {
        // Vérifie si l'utilisateur est connecté et a le rôle étudiant
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'etudiant') {
            try {
                $etudiantModel = new Etudiant();
                $etudiant = $etudiantModel->findById($_SESSION['user_id']);
                if ($etudiant) {
                    ob_start();
                    require __DIR__ . '/../views/etudiant/dashboard.php';
                    $content = ob_get_clean();
                    require __DIR__ . '/../views/layouts/default.php';
                } else {
                    // L'étudiant n'a pas été trouvé malgré l'ID en session, redirection par sécurité
                    header('Location: index.php?action=connexion_etudiant');
                    exit();
                }
            } catch (Exception $e) {
                $erreur = "Une erreur est survenue : " . $e->getMessage();
                $_SESSION['dashboard_erreur'] = $erreur;
                header('Location: index.php?action=connexion_etudiant');
                exit();
            }
        } else {
            header('Location: index.php?action=connexion_etudiant');
            exit();
        }
    }

    public function profil() {
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'etudiant') {
            try {
                $etudiantModel = new Etudiant();
                $etudiant = $etudiantModel->findById($_SESSION['user_id']);
                if ($etudiant) {
                    ob_start();
                    require __DIR__ . '/../views/etudiant/profil.php';
                    $content = ob_get_clean();
                    require __DIR__ . '/../views/layouts/default.php';
                } else {
                    // L'étudiant n'a pas été trouvé malgré l'ID en session, redirection par sécurité
                    header('Location: index.php?action=connexion_etudiant');
                    exit();
                }
            } catch (Exception $e) {
                $erreur = "Une erreur est survenue : " . $e->getMessage();
                $_SESSION['profil_erreur'] = $erreur;
                header('Location: index.php?action=connexion_etudiant');
                exit();
            }
        } else {
            header('Location: index.php?action=connexion_etudiant');
            exit();
        }
    }

    public function soumettreCahier() {
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'etudiant') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nomBinome = filter_input(INPUT_POST, 'nom_binome', FILTER_SANITIZE_STRING) ?? null;

                // Gestion du fichier (à implémenter la logique d'upload sécurisée)
                $fichierNom = $_FILES['cahier']['name'];
                $fichierTmp = $_FILES['cahier']['tmp_name'];
                $fichierErreur = $_FILES['cahier']['error'];
                $fichierTaille = $_FILES['cahier']['size'];

                try{
                    if ($fichierErreur === UPLOAD_ERR_OK) {
                        $dossierDestination = 'uploads/'; // Créer ce dossier avec les bonnes permissions
                        if (!is_dir($dossierDestination)) {
                            mkdir($dossierDestination, 0777, true);
                        }
                        $nomFichierUnique = uniqid() . '_' . $fichierNom;
                        $cheminFichier = $dossierDestination . $nomFichierUnique;

                        if (move_uploaded_file($fichierTmp, $cheminFichier)) {
                            $cahierChargeModel = new CahierCharge();
                            $cahierChargeModel->setEtudiantId($_SESSION['user_id']);
                            $cahierChargeModel->setNomBinome($nomBinome);
                            $cahierChargeModel->setFichierPath($cheminFichier);

                            if ($cahierChargeModel->create()) {
                                $success = "Votre cahier des charges a été soumis avec succès.";
                                $_SESSION['cahier_soumis_succes'] = $success;
                                ob_start();
                                require __DIR__ . '/../views/etudiant/soumettre_cahier.php';
                                $content = ob_get_clean();
                                require __DIR__ . '/../views/layouts/default.php';
                            } else {
                                $erreur = "Une erreur est survenue lors de la soumission du cahier des charges.";
                                $_SESSION['cahier_soumis_erreur'] = $erreur;
                                ob_start();
                                require __DIR__ . '/../views/etudiant/soumettre_cahier.php';
                                $content = ob_get_clean();
                                require __DIR__ . '/../views/layouts/default.php';
                            }
                        } else {
                            $erreur = "Erreur lors du déplacement du fichier.";
                            $_SESSION['cahier_soumis_erreur'] = $erreur;
                            ob_start();
                            require __DIR__ . '/../views/etudiant/soumettre_cahier.php';
                            $content = ob_get_clean();
                            require __DIR__ . '/../views/layouts/default.php';
                        }
                    } else {
                        $erreur = "Erreur lors du téléversement du fichier.";
                        $_SESSION['cahier_soumis_erreur'] = $erreur;
                        ob_start();
                        require __DIR__ . '/../views/etudiant/soumettre_cahier.php';
                        $content = ob_get_clean();
                        require __DIR__ . '/../views/layouts/default.php';
                    }
                } catch(Exception $e){
                    $erreur = "Une erreur est survenue : " . $e->getMessage();
                    $_SESSION['cahier_soumis_erreur'] = $erreur;
                    ob_start();
                    require __DIR__ . '/../views/etudiant/soumettre_cahier.php';
                    $content = ob_get_clean();
                    require __DIR__ . '/../views/layouts/default.php';
                }
            } else {
                ob_start();
                require __DIR__ . '/../views/etudiant/soumettre_cahier.php';
                $content = ob_get_clean();
                require __DIR__ . '/../views/layouts/default.php';
            }
        } else {
            header('Location: index.php?action=connexion_etudiant');
            exit();
        }
    }

    public function voirEncadreur() {
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'etudiant') {
            try{
                $etudiantModel = new Etudiant();
                $etudiant = $etudiantModel->findById($_SESSION['user_id']);
                if ($etudiant) {
                    $encadreur = $etudiant->getEncadreur();
                    ob_start();
                    require __DIR__ . '/../views/etudiant/voir_encadreur.php';
                    $content = ob_get_clean();
                    require __DIR__ . '/../views/layouts/default.php';
                } else {
                    // L'étudiant n'a pas été trouvé malgré l'ID en session, redirection par sécurité
                    header('Location: index.php?action=connexion_etudiant');
                    exit();
                }
            } catch(Exception $e){
                $erreur = "Une erreur est survenue : " . $e->getMessage();
                $_SESSION['voir_encadreur_erreur'] = $erreur;
                header('Location: index.php?action=connexion_etudiant');
                exit();
            }
        } else {
            header('Location: index.php?action=connexion_etudiant');
            exit();
        }
    }

    public function relance() {
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'etudiant') {
            // Ici, vous pouvez implémenter la logique pour enregistrer la demande de relance
            // (par exemple, enregistrer une entrée dans une table 'relances' avec l'ID de l'étudiant et la date).
            $message = "Votre demande de relance a été enregistrée. L'administrateur en sera informé.";
            $_SESSION['relance_message'] = $message;
            ob_start();
            require __DIR__ . '/../views/etudiant/relance.php';
            $content = ob_get_clean();
            require __DIR__ . '/../views/layouts/default.php';
        } else {
            header('Location: index.php?action=connexion_etudiant');
            exit();
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?action=connexion_etudiant');
        exit();
    }


    public function enregistrement() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupère et filtre les données du formulaire d'enregistrement
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING) ?? '';
            $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING) ?? '';
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '';
            $motDePasse = filter_input(INPUT_POST, 'mot_de_passe', FILTER_SANITIZE_STRING) ?? '';
            $filiere = filter_input(INPUT_POST, 'filiere', FILTER_SANITIZE_STRING) ?? '';
            $anneeFormation = filter_input(INPUT_POST, 'annee_formation', FILTER_SANITIZE_STRING) ?? '';

            try{
                // Effectuer la validation des données (très important !)
                if (empty($nom) || empty($prenom) || empty($email) || empty($motDePasse) || empty($filiere) || empty($anneeFormation)) {
                    $erreur = "Tous les champs sont obligatoires.";
                    $_SESSION['enregistrement_erreur'] = $erreur;
                    ob_start();
                    require __DIR__ . '/../views/etudiant/enregistrement.php';
                    $content = ob_get_clean();
                    require __DIR__ . '/../views/layouts/default.php';
                    return; // Arrêter l'exécution après l'erreur de validation
                }

                $etudiantModel = new Etudiant();
                if ($etudiantModel->findByEmail($email)) {
                    $erreur = "Cet email est déjà utilisé.";
                    $_SESSION['enregistrement_erreur'] = $erreur;
                    ob_start();
                    require __DIR__ . '/../views/etudiant/enregistrement.php';
                    $content = ob_get_clean();
                    require __DIR__ . '/../views/layouts/default.php';
                    return; // Arrêter l'exécution après l'erreur d'email existant
                }

                // Hasher le mot de passe avant de l'enregistrer (sécurité !)
                $motDePasseHash = password_hash($motDePasse, PASSWORD_DEFAULT);

                // Créer un nouvel objet Etudiant
                $nouvelEtudiant = new Etudiant();
                $nouvelEtudiant->setNom($nom);
                $nouvelEtudiant->setPrenom($prenom);
                $nouvelEtudiant->setEmail($email);
                $nouvelEtudiant->setMotDePasse($motDePasseHash);
                $nouvelEtudiant->setFiliere($filiere);
                $nouvelEtudiant->setAnneeFormation($anneeFormation);

                // Enregistrer l'étudiant dans la base de données
                if ($nouvelEtudiant->create()) {
                    // Rediriger vers une page de succès ou de connexion
                    header('Location: index.php?action=connexion_etudiant&success=enregistrement');
                    exit();
                } else {
                    // IMPORTANT : Gérer l'erreur de création de l'// étudiant
                    $erreur = "Une erreur est survenue lors de l'enregistrement. Veuillez réessayer.";
                    $_SESSION['enregistrement_erreur'] = $erreur;
                    ob_start();
                    require __DIR__ . '/../views/etudiant/enregistrement.php';
                    $content = ob_get_clean();
                    require __DIR__ . '/../views/layouts/default.php';
                    // NE PAS CONTINUER APRÈS UNE ERREUR D'ENREGISTREMENT
                    return; // Ajout crucial : Arrêter l'exécution ici
                }
            } catch (Exception $e) {
                $erreur = "Une erreur est survenue : " . $e->getMessage();
                $_SESSION['enregistrement_erreur'] = $erreur;
                ob_start();
                require __DIR__ . '/../views/etudiant/enregistrement.php';
                $content = ob_get_clean();
                require __DIR__ . '/../views/layouts/default.php';
                return;
            }
        } else {
            // Afficher le formulaire d'enregistrement si la requête n'est pas POST
            ob_start();
            require __DIR__ . '/../views/etudiant/enregistrement.php';
            $content = ob_get_clean();
            require __DIR__ . '/../views/layouts/default.php';
        }
    }
}
?>