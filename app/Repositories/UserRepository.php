<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;

class UserRepository implements IUserRepository
{

    public function create(array $data): User
    {
        return User::query()->create($data);
    }

    public function getByEmail(string $email)
    {
        return User::query()->where('email', $email)->firstOrFail();
    }
}
