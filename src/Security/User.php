<?php

namespace App\Security;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    private ?string $id_user;
    private string $name_user;
    private string $pswd_user;
    private string $id_faction;
    private string $grade_user;
    private string $capacity_user;

    public function __construct(array $userData)
    {
        $this->id_user = $userData['id_user'];
        $this->name_user = $userData['name_user'];
        $this->pswd_user = $userData['pswd_user'];
        $this->id_faction = $userData['id_faction'];
        $this->grade_user = $userData['grade_user'];
        $this->capacity_user = $userData['capacity_user'];
    }

    public function getUserIdentifier(): string
    {
        return $this->name_user;
    }

    public function getPassword(): ?string
    {
        return $this->pswd_user;
    }

    public function getIdFaction(): ?int
    {
        return $this->id_faction;
    }

    public function getCapacity(): ?string
    {
        return $this->capacity_user;
    }

    public function getGrade(): ?string
    {
        return $this->grade_user;
    }

    public function getRoles(): array
    {
        $roles = [];

        if ($this->grade_user && $this->capacity_user && $this->id_faction) {
            $roles[] = 'ROLE_' . strtoupper($this->grade_user);
            $roles[] = 'ROLE_' . strtoupper($this->capacity_user);
            $roles[] = 'ROLE_FACTION_' . $this->id_faction;
        }

        return array_unique($roles);
    }

    public function eraseCredentials()
    {
        // Si vous stockez des informations sensibles, vous pouvez les effacer ici
    }
}