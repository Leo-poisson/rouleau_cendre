<?php

namespace App\Manager;

use Doctrine\DBAL\Connection;

class UserManager
{
    public function __construct(
        private Connection $db,
    ) { }

    public function getMembers(int $faction, string $capacity) {
        return $this->db->fetchAllAssociative('
            SELECT name_user, grade_user, capacity_user 
            FROM "user" 
            WHERE id_faction = :faction AND capacity_user = :capacity'
        , [
            'faction' => $faction,
            'capacity' => $capacity
        ]);
    }
}