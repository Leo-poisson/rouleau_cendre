<?php

namespace App\Security;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    private ?int $id_user;
    private string $name_user;
    private string $pswd_user;
    private int $id_grade;
    private int $id_souffle;

    public function __construct(array $userData)
    {
        $this->id_user = $userData['id_user'] ?? null;
        $this->name_user = $userData['name_user'];
        $this->pswd_user = $userData['pswd_user'];
        $this->id_grade = $userData['id_grade'];
        $this->id_souffle = $userData['id_souffle'];
    }

    public function getUserIdentifier(): string
    {
        return $this->name_user;
    }

    public function getPassword(): ?string
    {
        return $this->pswd_user;
    }

    public function getRoles(): array
    {
        $roles = [];

        switch ($this->id_grade) {
            case 1:
                $roles[] = 'ROLE_MIZUNOTO';
                break;
            case 2:
                $roles[] = 'ROLE_MIZUNOE';
                break;
            case 3:
                $roles[] = 'ROLE_KANOTO';
                break;
            case 4:
                $roles[] = 'ROLE_KANOE';
                break;
            case 5:
                $roles[] = 'ROLE_TSUCHINOTO';
                break;
            case 6:
                $roles[] = 'ROLE_TSUCHINOE';
                break;
            case 7:
                $roles[] = 'ROLE_HINOTO';
                break;
            case 8:
                $roles[] = 'ROLE_HINOE';
                break;
            case 9:
                $roles[] = 'ROLE_KINOTO';
                break;
            case 10:
                $roles[] = 'ROLE_KINOE';
                break;
            case 11:
                $roles[] = 'ROLE_PILIER';
                break;
            default:
                $roles[] = 'ROLE_USER';
        }

        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function eraseCredentials()
    {
        // Si vous stockez des informations sensibles, vous pouvez les effacer ici
    }

    public function getId(): ?int
    {
        return $this->id_user;
    }
}