<?php

namespace App\Manager;

use Doctrine\DBAL\Connection;

class SouffleManager
{
    public function __construct(
        private Connection $db,
    ) { }

    public function getBreathings() {
        return $this->db->fetchAllAssociative("SELECT * FROM souffle");
    }
}