<?php

use Illuminate\Support\Arr;

class UserDto
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
    private function __construct(
        private readonly string $name,
        private readonly string $email,
        private readonly string $password,
    )
    {
    }

    public static function fromArray(array $data): UserDto
    {
        return self::factory(
            Arr::get($data, 'name', ''),
            Arr::get($data, 'email', ''),
            Arr::get($data, 'password', ''),
        );
    }

    public static function factory(string $name, string $email, string $password): UserDto
    {
        return new UserDto($name, $email, $password);
    }
}
