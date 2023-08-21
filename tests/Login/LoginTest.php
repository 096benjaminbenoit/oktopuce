<?php

namespace App\Tests\Login;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginTest extends WebTestCase
{
    public function testInvalidCredentials():void
    {
        $client = static::createClient();
        $response = $client->request(
          'POST',
          '/api/login_check',
          [],
          [],
          ['CONTENT_TYPE' => 'application/json'],
          json_encode([
            'username' => "+33610159678",
            'password' => "wrongpassword",
          ])
        );

        $response = $client->getResponse();

        $content = json_decode($response->getContent(), true);

        $this->assertEquals("401", $content['code']);
        $this->assertEquals("Invalid credentials.", $content['message']);
        $this->assertResponseStatusCodeSame(401);
        
    }

    public function testValidLogin(): void
    {
        $client = static::createClient();
        $client->request(
          'POST',
          '/api/login_check',
          [],
          [],
          ['CONTENT_TYPE' => 'application/json'],
          json_encode([
            'username' => "+33610159678",
            'password' => "test",
          ])
        );

        $response = $client->getResponse();

        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('token', $content);
        $this->assertResponseIsSuccessful();
    }
}
