<?php

namespace App\Tests\Integration;

use App\Domain\Repository\UserRepositoryInterface;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    private mixed $userRepository;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->userRepository = self::getContainer()->get(UserRepositoryInterface::class);
    }

    public function testAdd()
    {
        $user = new User('john.doe@example.com', 'John', 'Doe');

        $this->userRepository->add($user);
    }
}
