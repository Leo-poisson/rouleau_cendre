<?php

namespace App\Security;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    private ?int $id_user;
    private string $name_user;
    private string $pswd_user;
    private string $id_faction;
    private int $grade_user;
    private int $capacitie_user;

    public function __construct(array $userData)
    {
        $this->id_user = $userData['id_user'];
        $this->name_user = $userData['name_user'];
        $this->pswd_user = $userData['pswd_user'];
        $this->id_faction = $userData['id_faction'];
        $this->grade_user = $userData['grade_user'];
        $this->capacitie_user = $userData['capacitie_user'];
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

    public function getCapacitie(): ?string
    {
        return $this->capacitie_user;
    }

    public function getGrade(): ?string
    {
        return $this->grade_user;
    }

    public function getRoles(): array
    {
        $roles = [];
        $roles[] = 'ROLE_USER';
        $roles[] = 'ROLE_MIZU';
        $roles[] = 'ROLE_FACTION_1';
        $roles[] = 'ROLE_VENT';
        $roles[] = 'ROLE_POURF';
        // $roles = ['ROLE_USER', 'ROLE_MIZU', 'ROLE_FACTION_1', 'ROLE_VENT', 'ROLE_POURF'];

        switch ($this->grade_user) {
            default:
                $roles[] = 'ROLE_USER';
        }

        return array_unique($roles);
    }

    public function eraseCredentials()
    {
        // Si vous stockez des informations sensibles, vous pouvez les effacer ici
    }
}