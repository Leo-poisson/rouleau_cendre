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
        $user = $this->db->fetchAssociative('SELECT * FROM "user" WHERE name_user = :nom_user', [
            'nom_user' => $nom_user,
        ]);

        if ($user) {
            throw new \InvalidArgumentException('Un utilisateur avec ce nom existe déjà');
        }

        $sql = '
            INSERT INTO "user" 
            (id_user, name_user, pswd_user, id_faction, grade_user, capacity_user)
            VALUES (uuid_generate_v4(), :nom_user, :pswd_user, :id_faction, :grade_user, :capacity_user)
            RETURNING id_user
        ';

        $id_user = $this->db->fetchOne($sql, [
            'nom_user' => $nom_user,
            'pswd_user' => $pswd_user,
            'id_faction' => $faction,
            'capacity_user' => $capacity,
            'grade_user' => $grade,
        ]);

        return $id_user;
    }
}