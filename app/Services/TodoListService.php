<?php

namespace App\Services;

use App\Http\Requests\TodoList\CreateRequest;
use App\Http\Resources\TodoListResource;
use App\Repositories\Interfaces\ITodoListRepository;
use App\Services\Interfaces\ITodoListService;
use Illuminate\Http\Request;

class TodoListService implements ITodoListService
{
    private ITodoListRepository $repository;

    public function __construct(ITodoListRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(CreateRequest $request)
    {
        $data = [
            'user_id' => $request->user()->id,
            'name' => $request->validated('name')
        ];

        $todoList = $this->repository->create($data);

        return new TodoListResource($todoList);
    }

    public function list(Request $request)
    {
        $userId = $request->user()->id;

        $todoLists = $this->repository->list($userId);

        return TodoListResource::collection($todoLists);
    }
}
