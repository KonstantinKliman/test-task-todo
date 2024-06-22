<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface IUserRepository
{
    public function create(array $data): User;

    public function getByEmail(string $email);

    public function list();

    public function getById(int $userId);

    public function getSharedListsByUser(User $user);
}
