<?php

namespace App\Message\CommandHandler;

use App\Message\Command\CreateUserCommand;
use App\Domain\Repository\UserRepositoryInterface;
use App\Entity\User;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateUserHandler implements MessageHandlerInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(CreateUserCommand $command): void
    {
        $user = new User($command->getEmail(), $command->getFirstName(), $command->getLastName());
        $this->userRepository->add($user);
    }
}