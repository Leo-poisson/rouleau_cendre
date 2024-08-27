<?php

namespace App\Manager;

use Doctrine\DBAL\Connection;

class GradeManager
{
    public function __construct(
        private Connection $db,
    ) { }

    public function getGrades() {
        return $this->db->fetchAllAssociative("SELECT * FROM grade");
    }
}