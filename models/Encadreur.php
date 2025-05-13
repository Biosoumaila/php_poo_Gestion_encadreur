<?php

namespace Bahng\TpPoo\Models;
use PDO;
use Bahng\TpPoo\Core\Database;

class Encadreur
{
    private $db;

    public function __construct(Database $database)
    {
        $this->db = $database->getConnection();
    }

    public function getAllEncadreurs()
    {
        $query = $this->db->query("SELECT * FROM encadreurs");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}