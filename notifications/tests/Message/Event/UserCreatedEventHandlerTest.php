<?php

namespace App\Tests\Message\Event;

use App\Message\Event\UserCreatedEvent;
use App\Message\Event\UserCreatedEventHandler;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class UserCreatedEventHandlerTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testInvoke()
    {
        $loggerMock = $this->createMock(LoggerInterface::class);
        $loggerMock->expects($this->once())->method('info');

        $eventHandler = new UserCreatedEventHandler($loggerMock);
        $event = new UserCreatedEvent('john.doe@example.com', 'John', 'Doe');
        $eventHandler($event);
    }
}
