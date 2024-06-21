<?php

namespace App\Services\Interfaces;

use App\Http\Requests\TodoList\CreateRequest;
use Illuminate\Http\Request;

interface ITodoListService
{
    public function create(CreateRequest $request);

    public function list(Request $request);
}
