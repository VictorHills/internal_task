<?php

namespace App\Controller;

use App\Message\Event\UserCreatedEvent;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    protected LoggerInterface $logger;
    protected MessageBusInterface $bus;

    public function __construct(LoggerInterface $usersLogger, MessageBusInterface $bus)
    {
        $this->logger = $usersLogger;
        $this->bus = $bus;
    }

    /**
     * @param Request $request
     * @return Response
     */
    #[Route('/users', methods: ['POST'])]
    public function createUser(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $command = new UserCreatedEvent($data['email'], $data['firstName'], $data['lastName']);
        $this->bus->dispatch($command);

        $data = [
            'message' => 'User Created successfully',
            'user_details' => $data
        ];
        $this->logger->info('User data stored: ' . json_encode($data));

        return new JsonResponse($data, Response::HTTP_CREATED);
    }
}