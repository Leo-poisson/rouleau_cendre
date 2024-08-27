<?php

namespace App\Manager;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class InscriptionManager
{
    public function __construct(
        private Connection $db,
    ) { }

    /**
     * @throws Exception
     */
    public function inscription($nom_user, $pswd_user, $id_souffle, $id_grade)
    {
        $this->db->executeStatement('
            INSERT INTO "user" 
            (id_grade, id_souffle, name_user, pswd_user) 
            VALUES (:id_grade, :id_souffle, :nom_user, :pswd_user)
        ', [
            'nom_user' => $nom_user,
            'pswd_user' => $pswd_user,
            'id_souffle' => $id_souffle,
            'id_grade' => $id_grade,
        ]);

        return true;
    }
}