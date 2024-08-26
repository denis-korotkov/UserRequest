<?php

namespace Tests\Unit;

use Tests\TestCase;

class AuthTest extends TestCase
{

    public function testCreateToken(): void
    {
        $response = $this->postJson('api/auth/login', ['email' => 'd_k_s_19995@mail.ru', 'password' => '123']);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in',
        ]);
        $responseArray = json_decode($response->getContent(), 1);
        $this->assertSame('bearer', $responseArray['token_type']);
    }

    public function testCreateTokenFail(): void
    {
        $response = $this->postJson('api/auth/login', ['email' => 'd_k_s_19995@mail.ru']);

        $response->assertStatus(500);
    }
}
