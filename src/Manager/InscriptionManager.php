<?php

namespace App\Manager;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class InscriptionManager
{
    public function __construct(
        private Connection $db,
    ) { }

    public function inscription($nom_user, $pswd_user, $capacity, $grade, $faction)
    {
        $this->db->executeStatement('
            INSERT INTO "user" 
            (name_user, pswd_user, id_faction, grade_user, capacity_user)
            VALUES (:nom_user, :pswd_user, :id_faction, :grade_user, :capacity_user)
        ', [
            'nom_user' => $nom_user,
            'pswd_user' => $pswd_user,
            'id_faction' => $faction,
            'capacity_user' => $capacity,
            'grade_user' => $grade,
        ]);

        return $this->db->lastInsertId();
    }
}