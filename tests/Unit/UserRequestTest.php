<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserRequestTest extends TestCase
{
    public function testCreateRequestWithAuth(): void
    {
        $response = $this->postJson('api/auth/login', ['email' => 'test@example.com', 'password' => '123']);
        $response->assertStatus(200);
        $token = json_decode($response->getContent(), 1);

        $response = $this->postJson('api/user-request', ['request' => 'request'], ['Authorization' => "Bearer {$token['access_token']}"]);
        $response->assertStatus(200);
    }

    public function testCreateRequestWithoutAuth(): void
    {
        $response = $this->postJson('api/user-request', ['request' => 'request']);
        $response->assertStatus(401);
    }

    public function testGetRequestsWithoutAuth(): void
    {
        $response = $this->get('api/user-request');
        $response->assertStatus(500);
    }

    public function testGetRequestsWithAuth(): void
    {
        $response = $this->postJson('api/auth/login', ['email' => 'test@example.com', 'password' => '123']);
        $response->assertStatus(200);
        $token = json_decode($response->getContent(), 1);

        $response = $this->get('api/user-request', ['Authorization' => "Bearer {$token['access_token']}"]);
        $response->assertStatus(200);
    }
}
