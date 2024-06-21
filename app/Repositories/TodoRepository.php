<?php

namespace App\Repositories;

use App\Models\Todo;
use App\Repositories\Interfaces\ITodoRepository;

class TodoRepository implements ITodoRepository
{

    public function create(array $data)
    {
        return Todo::query()->create($data);
    }

    public function filterByTags(array $tagsArray)
    {
        return Todo::whereHas('tags', function ($query) use ($tagsArray) {
            $query->whereIn('id', $tagsArray);
        })->get();
    }

    public function getById(int $todoId)
    {
        return Todo::query()->where('id', $todoId)->first();
    }

    public function getByQuery(string $query)
    {
        return Todo::query()
            ->where('title', 'LIKE', '%' . $query . '%')
            ->orWhere('content', 'LIKE', '%' . $query . '%')
            ->get();
    }
}
