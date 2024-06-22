<?php

namespace App\Repositories;

use App\Models\TodoList;
use App\Repositories\Interfaces\ITodoListRepository;

class TodoListRepository implements ITodoListRepository
{

    public function create(array $data)
    {
        return TodoList::query()->create($data);
    }

    public function list(int $userId)
    {
        return TodoList::query()->where('user_id', $userId)->get();
    }

}
