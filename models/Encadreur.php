<?php
require_once __DIR__ . '/Database.php';

class Encadreur {
    private $db;
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $motDePasse;
    private $domaine;

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

    public function setDomaine($domaine): void {
        $this->domaine = $domaine;
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

    public function getDomaine(): ?string {
        return $this->domaine;
    }

    public function create() {
        $stmt = $this->db->prepare("INSERT INTO encadreurs (nom, prenom, email, mot_de_passe, domaine) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$this->nom, $this->prenom, $this->email, password_hash($this->motDePasse, PASSWORD_DEFAULT), $this->domaine]);
        $this->id = $this->db->lastInsertId();
        return $this->id;
    }

    public function findByEmail(string $email): ?Encadreur {
        $stmt = $this->db->prepare("SELECT * FROM encadreurs WHERE email = ?");
        $stmt->execute([$email]);
        $encadreurData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($encadreurData) {
            $encadreur = new Encadreur();
            $encadreur->setId($encadreurData['id']);
            $encadreur->setNom($encadreurData['nom']);
            $encadreur->setPrenom($encadreurData['prenom']);
            $encadreur->setEmail($encadreurData['email']);
            $encadreur->setMotDePasse($encadreurData['mot_de_passe']);
            $encadreur->setDomaine($encadreurData['domaine']);
            return $encadreur;
        }
        return null;
    }

    public function findById(int $id): ?Encadreur {
        $stmt = $this->db->prepare("SELECT * FROM encadreurs WHERE id = ?");
        $stmt->execute([$id]);
        $encadreurData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($encadreurData) {
            $this->setId($encadreurData['id']);
            $this->setNom($encadreurData['nom']);
            $this->setPrenom($encadreurData['prenom']);
            $this->setEmail($encadreurData['email']);
            $this->setMotDePasse($encadreurData['mot_de_passe']);
            $this->setDomaine($encadreurData['domaine']);
            return $this;
        }
        return null;
    }

    public function getEtudiantsEncadres(): array {
        $stmt = $this->db->prepare("SELECT e.* FROM etudiants e WHERE e.encadreur_id = ?");
        $stmt->execute([$this->id]);
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

    // Autres méthodes
}