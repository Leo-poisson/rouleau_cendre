<?php

namespace App\Manager;

use Doctrine\DBAL\Connection;

class ConnexionManager
{
    public function __construct(
        private Connection $db,
    ) { }

    public function test() {
        return $this->db->fetchAllAssociative("SELECT * FROM souffle");
    }
}