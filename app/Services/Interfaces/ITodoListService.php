<?php

namespace App\Services\Interfaces;

use App\Http\Requests\TodoList\CreateRequest;
use App\Http\Requests\TodoList\ShareRequest;
use Illuminate\Http\Request;

interface ITodoListService
{
    public function create(CreateRequest $request);

    public function list(Request $request);

    public function share(ShareRequest $request);

    public function getSharedLists(Request $request);
}
