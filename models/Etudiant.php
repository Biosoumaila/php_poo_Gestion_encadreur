<?php
require_once __DIR__ . '/Database.php';

class Etudiant {
    private $db;
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $motDePasse;
    private $filiere;
    private $anneeFormation;
    private $encadreurId;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Getters et setters pour les propriétés

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNom($nom): void {
        $this->nom = $nom;
    }

    public function setPrenom($prenom): void {
        $this->prenom = $prenom;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function setMotDePasse($motDePasse): void {
        $this->motDePasse = $motDePasse;
    }

    public function setFiliere($filiere): void {
        $this->filiere = $filiere;
    }

    public function setAnneeFormation($anneeFormation): void {
        $this->anneeFormation = $anneeFormation;
    }

    public function setEncadreurId($encadreurId): void {
        $this->encadreurId = $encadreurId;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function getPrenom(): ?string {
        return $this->prenom;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function getMotDePasse(): ?string {
        return $this->motDePasse;
    }

    public function getFiliere(): ?string {
        return $this->filiere;
    }

    public function getAnneeFormation(): ?string {
        return $this->anneeFormation;
    }

    public function getEncadreurId(): ?int {
        return $this->encadreurId;
    }

    public function create() {
        $stmt = $this->db->prepare("INSERT INTO etudiants (nom, prenom, email, mot_de_passe, filiere, annee_formation) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$this->nom, $this->prenom, $this->email, password_hash($this->motDePasse, PASSWORD_DEFAULT), $this->filiere, $this->anneeFormation]);
        $this->id = $this->db->lastInsertId();
        return $this->id;
    }

    public function findByEmail(string $email): ?Etudiant {
        $stmt = $this->db->prepare("SELECT * FROM etudiants WHERE email = ?");
        $stmt->execute([$email]);
        $etudiantData = $stmt->fetch(PDO::FETCH_ASSOC);

        echo "<pre>"; // Début de la préformatation pour l'affichage
        print_r($etudiantData); // Afficher le contenu de $etudiantData pour le débogage
        echo "</pre>"; // Fin de la préformatation

        if ($etudiantData) {
            $etudiant = new Etudiant();
            $etudiant->setId($etudiantData['id']);
            $etudiant->setNom($etudiantData['nom']);
            $etudiant->setPrenom($etudiantData['prenom']);
            $etudiant->setEmail($etudiantData['email']);
            $etudiant->setMotDePasse($etudiantData['mot_de_passe']);
            $etudiant->setFiliere($etudiantData['filiere']);
            $etudiant->setAnneeFormation($etudiantData['annee_formation']);
            // Vérifiez si la clé 'encadreur_id' existe avant d'y accéder
            if (isset($etudiantData['encadreur_id'])) {
                $etudiant->setEncadreurId($etudiantData['encadreur_id']);
            } else {
                $etudiant->setEncadreurId(null); // Ou toute autre valeur par défaut appropriée
            }
            return $etudiant;
        }
        return null;
    }

    public function findById(int $id): ?Etudiant {
        $stmt = $this->db->prepare("SELECT * FROM etudiants WHERE id = ?");
        $stmt->execute([$id]);
        $etudiantData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($etudiantData) {
            $etudiant = new Etudiant();
            $etudiant->setId($etudiantData['id']);
            $etudiant->setNom($etudiantData['nom']);
            $etudiant->setPrenom($etudiantData['prenom']);
            $etudiant->setEmail($etudiantData['email']);
            $etudiant->setMotDePasse($etudiantData['mot_de_passe']);
            $etudiant->setFiliere($etudiantData['filiere']);
            $etudiant->setAnneeFormation($etudiantData['annee_formation']);
            if (isset($etudiantData['encadreur_id'])) {
                $etudiant->setEncadreurId($etudiantData['encadreur_id']);
            } else {
                $etudiant->setEncadreurId(null);
            }
            return $etudiant;
        }
        return null;
    }

    public function updateEncadreurId(int $encadreurId) {
        $stmt = $this->db->prepare("UPDATE etudiants SET encadreur_id = ? WHERE id = ?");
        return $stmt->execute([$encadreurId, $this->id]);
    }

    public function getEncadreur(): ?Encadreur {
        if ($this->encadreurId) {
            $encadreur = new Encadreur();
            $encadreur->findById($this->encadreurId);
            return $encadreur;
        }
        return null;
    }
}