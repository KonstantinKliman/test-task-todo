<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Models\Todo;
use App\Models\User;
use App\Repositories\Interfaces\ITagRepository;

class TagRepository implements ITagRepository
{
    public function create(string $tagName)
    {
        return Tag::query()->firstOrCreate(['name' => $tagName]);
    }

    public function attach(Tag $tag, Todo $todo)
    {
        $tag->todos()->attach($todo);
    }

    public function list(User $user)
    {
        return Tag::whereHas('todos', function($query) use ($user) {
            $query->whereHas('todoList', function($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        })->get();
    }
}
