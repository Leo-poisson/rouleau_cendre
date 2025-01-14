<?php

namespace App\Manager;

use Doctrine\DBAL\Connection;

class FactionManager
{
    public function __construct(
        private Connection $db,
    ) { }

    public function getFactions() {
        return $this->db->fetchAllAssociative("SELECT * FROM faction");
    }
}