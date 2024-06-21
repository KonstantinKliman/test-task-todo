<?php

namespace App\Repositories\Interfaces;

use App\Models\Tag;
use App\Models\Todo;
use App\Models\User;

interface ITagRepository
{
    public function create(string $tagName);

    public function attach(Tag $tag, Todo $todo);

    public function list(User $user);
}
