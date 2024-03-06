<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserControllerTest extends WebTestCase
{
    public function testCreateUser()
    {
        $client = static::createClient();
        $client->request('POST', '/users', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'email' => 'john.doe@example.com',
            'firstName' => 'John',
            'lastName' => 'Doe',
        ]));

        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());

        // Assert the response content
        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals('User Created successfully', $responseData['message']);
    }
}
