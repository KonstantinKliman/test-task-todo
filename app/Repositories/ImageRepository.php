<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\Todo;
use App\Repositories\Interfaces\IImageRepository;

class ImageRepository implements IImageRepository
{

    public function create(int $todoId, string $path)
    {
        Image::query()->create(['todo_id' => $todoId, 'path' => $path]);
    }

    public function update(int $todoId, string $path)
    {
        Image::query()->where('todo_id', $todoId)->update(['path' => $path]);
    }

    public function delete(Todo $todo)
    {
        $todo->image()->delete();
    }
}
