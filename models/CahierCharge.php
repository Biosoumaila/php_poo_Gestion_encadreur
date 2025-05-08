<?php
require_once __DIR__ . '/Database.php';

class CahierCharge {
    private $db;
    private $id;
    private $etudiantId;
    private $nomBinome;
    private $fichierPath; // Chemin vers le fichier téléversé

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Getters et setters

    public function setId($id): void {
        $this->id = $id;
    }

    public function setEtudiantId($etudiantId): void {
        $this->etudiantId = $etudiantId;
    }

    public function setNomBinome($nomBinome): void {
        $this->nomBinome = $nomBinome;
    }

    public function setFichierPath($fichierPath): void {
        $this->fichierPath = $fichierPath;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getEtudiantId(): ?int {
        return $this->etudiantId;
    }

    public function getNomBinome(): ?string {
        return $this->nomBinome;
    }

    public function getFichierPath(): ?string {
        return $this->fichierPath;
    }

    public function create() {
        $stmt = $this->db->prepare("INSERT INTO cahiers_charges (etudiant_id, nom_binome, fichier_path) VALUES (?, ?, ?)");
        return $stmt->execute([$this->etudiantId, $this->nomBinome, $this->fichierPath]);
    }

    public static function getByEtudiantId(int $etudiantId): ?CahierCharge {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM cahiers_charges WHERE etudiant_id = ?");
        $stmt->execute([$etudiantId]);
        $cahierData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($cahierData) {
            $cahier = new CahierCharge();
            $cahier->setId($cahierData['id']);
            $cahier->setEtudiantId($cahierData['etudiant_id']);
            $cahier->setNomBinome($cahierData['nom_binome']);
            $cahier->setFichierPath($cahierData['fichier_path']);
            return $cahier;
        }
        return null;
    }
}