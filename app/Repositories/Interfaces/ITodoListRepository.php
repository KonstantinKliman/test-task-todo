<?php

namespace App\Repositories\Interfaces;

interface ITodoListRepository
{
    public function create(array $data);

    public function list(int $userId);
}
