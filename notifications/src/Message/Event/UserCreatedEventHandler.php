<?php

namespace App\Message\Event;

use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
class UserCreatedEventHandler implements MessageHandlerInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(UserCreatedEvent $event): void
    {
        $this->logger->info('User created: ', [
            'email' => $event->getEmail(),
            'firstName' => $event->getFirstName(),
            'lastName' => $event->getLastName(),
        ]);
    }
}