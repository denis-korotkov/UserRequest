<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserRequestTest extends TestCase
{
    public function testCreateRequestWithAuth(): void
    {
        $token = $this->getTokenByLoginUserRequest('test@example.com');

        $response = $this->postJson('api/user-request', ['request' => 'request'], $this->getAuthorizedHeaders($token));

        $response->assertStatus(200);
    }

    public function testCreateRequestWithoutAuth(): void
    {
        $response = $this->postJson('api/user-request', ['request' => 'request'], $this->getHeaders());
        $response->assertStatus(401);
    }

    public function testGetRequestsWithoutAuth(): void
    {
        $response = $this->get('api/user-request', $this->getHeaders());
        $response->assertStatus(401);
    }

    /** @dataProvider getRequestsWithAuthDataProvider */
    public function testGetRequestsWithAuth(string $email): void
    {
        $token = $this->getTokenByLoginUserRequest($email);

        $response = $this->get('api/user-request', $this->getAuthorizedHeaders($token));
        $response->assertStatus(200);
    }

    public static function getRequestsWithAuthDataProvider(): array
    {
        return [
            [
                'email' => 'test@example.com',
            ],
            [
                'email' => 'admin@example.com',
            ],
        ];
    }

    /** @dataProvider getRequestsByUserDataProvider */
    public function testGetRequestsByUser(string $email, int $count): void
    {
        $this->dropAllUserRequests();

        $anotherUserToken = $this->getTokenByLoginUserRequest('test2@example.com');
        $this->postJson('api/user-request', ['request' => 'request'], $this->getAuthorizedHeaders($anotherUserToken));

        $token = $this->getTokenByLoginUserRequest($email);
        $this->postJson('api/user-request', ['request' => 'request'], $this->getAuthorizedHeaders($token));

        $response = $this->get('api/user-request', $this->getAuthorizedHeaders($token));
        $response->assertStatus(200);
        $userRequests = json_decode($response->getContent(), 1);

        $this->assertArrayHasKey('data', $userRequests);
        $this->assertCount($count, $userRequests['data']);
    }

    public static function getRequestsByUserDataProvider(): array
    {
        return [
            [
                'email' => 'test@example.com',
                'count' => 1,
            ],
            [
                'email' => 'admin@example.com',
                'count' => 2,
            ],
        ];
    }

}
