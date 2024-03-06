<?php

namespace App\Tests\Message\Event;

use Monolog\Handler\TestHandler;
use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Message\Event\UserCreatedEvent;

class UserCreatedEventHandlerIntegrationTest extends KernelTestCase
{
    public function testEventHandlerIntegration()
    {
        self::bootKernel();

        // Set up a TestHandler and add it to a new Logger
        $testHandler = new TestHandler();
        $logger = new Logger('test', [$testHandler]);

        // Replace the Logger service in the container with your test logger
        self::getContainer()->set('monolog.logger', $logger);

        $bus = self::getContainer()->get(MessageBusInterface::class);
        $bus->dispatch(new UserCreatedEvent('john@example.com', 'John', 'Doe'));

        // Check that the TestHandler has the expected log record
        $this->assertTrue($testHandler->hasInfoRecords());

        // Further refine this test by checking the content of the log record
        $this->assertTrue($testHandler->hasInfoThatContains('User created:'));
    }
}

