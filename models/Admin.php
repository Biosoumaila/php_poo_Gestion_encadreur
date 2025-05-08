<?php
require_once __DIR__ . '/Database.php';

class Admin {
    private $db;
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $motDePasse;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Getters et setters

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

    public function findByEmail(string $email): ?Admin {
        $stmt = $this->db->prepare("SELECT * FROM admins WHERE email = ?");
        $stmt->execute([$email]);
        $adminData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($adminData) {
            $admin = new Admin();
            $admin->setId($adminData['id']);
            $admin->setNom($adminData['nom']);
            $admin->setPrenom($adminData['prenom']);
            $admin->setEmail($adminData['email']);
            $admin->setMotDePasse($adminData['mot_de_passe']);
            return $admin;
        }
        return null;
    }

    public function getAllEtudiants(): array {
        $stmt = $this->db->query("SELECT * FROM etudiants");
        $etudiants = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $etudiant = new Etudiant();
            $etudiant->setId($row['id']);
            $etudiant->setNom($row['nom']);
            $etudiant->setPrenom($row['prenom']);
            $etudiant->setEmail($row['email']);
            $etudiant->setFiliere($row['filiere']);
            $etudiant->setAnneeFormation($row['annee_formation']);
            $etudiant->setEncadreurId($row['encadreur_id']);
            $etudiants[] = $etudiant;
        }
        return $etudiants;
    }

    public function getAllEncadreurs(): array {
        $stmt = $this->db->query("SELECT * FROM encadreurs");
        $encadreurs = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $encadreur = new Encadreur();
            $encadreur->setId($row['id']);
            $encadreur->setNom($row['nom']);
            $encadreur->setPrenom($row['prenom']);
            $encadreur->setEmail($row['email']);
            $encadreur->setDomaine($row['domaine']);
            $encadreurs[] = $encadreur;
        }
        return $encadreurs;
    }

    public function affecterEncadreur(int $etudiantId, int $encadreurId): bool {
        $stmt = $this->db->prepare("UPDATE etudiants SET encadreur_id = ? WHERE id = ?");
        return $stmt->execute([$encadreurId, $etudiantId]);
    }

    // Autres méthodes
}