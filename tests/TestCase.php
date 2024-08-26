<?php

namespace Tests;

use App\Models\UserRequest;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function getHeaders(): array
    {
        return ['Accept' => 'application/json'];
    }

    protected function getAuthorizedHeaders(array $token): array
    {
        return array_merge($this->getHeaders(), ['Authorization' => "Bearer {$token['access_token']}"]);
    }

    protected function getTokenByLoginUserRequest(string $email)
    {
        $response = $this->postJson('api/auth/login', ['email' => $email, 'password' => '123']);
        return json_decode($response->getContent(), 1);
    }

    protected function dropAllUserRequests(): void
    {
        UserRequest::query()->withoutGlobalScopes()->delete();
    }
}
