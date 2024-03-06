<?php

namespace App\Domain\Repository;

use App\Entity\User;

class UserRepositoryInterface
{
    public function add(User $user): void
    {
    }
}