<?php

namespace App\Models;

use Core\Database;

class Administrateur
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function getAll()
    {
        $query = $this->db->query("SELECT * FROM administrateurs");
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
}