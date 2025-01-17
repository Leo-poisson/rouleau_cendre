<?php

namespace App\Manager;

use Doctrine\DBAL\Connection;

class UserManager
{
    public function __construct(
        private Connection $db,
    ) { }

    public function GetMembers(int $faction, string $capacity) {
        return $this->db->fetchAllAssociative('
            SELECT name_user, grade_user, capacity_user 
            FROM "user" 
            WHERE id_faction = :faction AND capacity_user = :capacity'
        , [
            'faction' => $faction,
            'capacity' => $capacity
        ]);
    }

    public function UpdateMember(string $grade, int $faction, string $capacity, string $name) {
        return $this->db->executeStatement('
            UPDATE "user"
            SET grade_user = :grade
            WHERE id_faction = :faction AND capacity_user = :capacity AND name_user = :name AND grade_user = :grade'
            , [
                'grade' => $grade,
                'faction' => $faction,
                'capacity' => $capacity,
                'name' => $name
            ]);
    }

    public function DeleteMember(int $faction, string $capacity, string $name, string $grade) {
        return $this->db->executeStatement('
            DELETE
            FROM "user" 
            WHERE id_faction = :faction AND capacity_user = :capacity AND name_user = :name AND grade_user = :grade'
            , [
                'faction' => $faction,
                'capacity' => $capacity,
                'name' => $name,
                'grade' => $grade
            ]);
    }
}