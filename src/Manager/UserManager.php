<?php

namespace App\Manager;

use Doctrine\DBAL\Connection;

class UserManager
{
    public function __construct(
        private Connection $db,
    ) { }

    public function findUser($name_user) {
        return $this->db->fetchAssociative('
            SELECT * FROM "user" WHERE name_user = :nom
        ', [
            'nom' => $name_user,
        ]);
    }
}