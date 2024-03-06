<?php

namespace App\Tests\Unit;

use App\Domain\Repository\UserRepositoryInterface;
use App\Entity\User;
use App\Message\Command\CreateUserCommand;
use App\Message\CommandHandler\CreateUserHandler;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class CreateUserHandlerTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testInvoke()
    {
        $userRepository = $this->createMock(UserRepositoryInterface::class);
        $userRepository->expects($this->once())
            ->method('add')
            ->with($this->callback(function (User $user) {
                return $user->getEmail() === 'john.doe@example.com' &&
                    $user->getFirstName() === 'John' &&
                    $user->getLastName() === 'Doe';
            }));

        $createUserHandler = new CreateUserHandler($userRepository);
        $createUserCommand = new CreateUserCommand('john.doe@example.com', 'John', 'Doe');
        $createUserHandler($createUserCommand);
    }
}
