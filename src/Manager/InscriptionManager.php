<?php

namespace App\Manager;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class InscriptionManager
{
    public function __construct(
        private Connection $db,
    ) { }

    public function inscription($nom_user, $pswd_user, $capacitie, $grade, $faction)
    {
        try {
            $this->db->executeStatement('
                INSERT INTO "user" 
                (name_user, pswd_user, id_faction, grade_user, capacitie_user 
                VALUES (:nom_user, :pswd_user, :id_faction, :grade_user, :capacitie_user)
            ', [
                'nom_user' => $nom_user,
                'pswd_user' => $pswd_user,
                'id_faction' => $faction,
                'capacitie_user' => $capacitie,
                'grade_user' => $grade,
            ]);

            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getNewUser($nom_user, $capacitie, $grade, $faction)
    {
        try {
            $this->db->fetchAssociative('
                SELECT id_user 
                FROM "user"
                WHERE name_user = :name_user AND capacitie_user = :capacitie_user AND grade_user = :grade_user AND id_faction = :id_faction
            ', [
                'name_user' => $nom_user,
                'capacitie_user' => $capacitie,
                'grade_user' => $grade,
                'id_faction' => $faction,
            ]);

            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}