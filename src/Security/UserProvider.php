<?php

namespace App\Security;

use Doctrine\DBAL\Connection;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

class UserProvider implements UserProviderInterface, PasswordUpgraderInterface
{
    public function __construct(private Connection $db) {}

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $sql = 'SELECT * FROM "user" WHERE name_user = :identifier';
        $userData = $this->db->fetchAssociative($sql, ['identifier' => $identifier]);

        if (!$userData) {
            throw new UserNotFoundException();
        }

        return new User($userData);
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof User) {
            throw new \InvalidArgumentException('Instances of "User" are expected.');
        }

        return $this->loadUserByIdentifier($user->getUserIdentifier());
    }

    public function supportsClass(string $class): bool
    {
        return $class === User::class;
    }

    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        // Mise à jour du mot de passe haché dans la base de données
        $sql = 'UPDATE "user" SET pswd_user = :password WHERE id_user = :id_user';
        $this->db->executeStatement($sql, [
            'password' => $newHashedPassword,
            'id_user' => $user->getId(),
        ]);
    }
}
