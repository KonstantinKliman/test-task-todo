<?php

namespace App\Repositories\Interfaces;

use App\Models\Todo;

interface IImageRepository
{
    public function create(int $todoId, string $path);

    public function update(int $todoId, string $path);

    public function delete(Todo $todo);
}
