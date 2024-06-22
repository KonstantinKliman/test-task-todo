<?php

namespace App\Services;

use App\Http\Requests\TodoList\CreateRequest;
use App\Http\Requests\TodoList\ShareRequest;
use App\Http\Resources\TodoListResource;
use App\Http\Resources\UserResource;
use App\Models\Permission;
use App\Repositories\Interfaces\IPermissionRepository;
use App\Repositories\Interfaces\ITodoListRepository;
use App\Repositories\Interfaces\IUserRepository;
use App\Services\Interfaces\ITodoListService;
use Illuminate\Http\Request;

class TodoListService implements ITodoListService
{
    private ITodoListRepository $repository;
    private IPermissionRepository $permissionRepository;
    private IUserRepository $userRepository;

    public function __construct(ITodoListRepository $repository, IPermissionRepository $permissionRepository, IUserRepository $userRepository)
    {
        $this->repository = $repository;
        $this->permissionRepository = $permissionRepository;
        $this->userRepository = $userRepository;
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

    public function share(ShareRequest $request)
    {
        $data = [
            'todo_list_id' => $request->validated('todoListId'),
            'user_id' => $request->validated('userId'),
            'can_edit' => $request->validated('canEdit')
        ];

        $user = $this->userRepository->getById($data['user_id']);

        $this->permissionRepository->updateOrCreate($data);

        return [
            'message' => 'Todo list shared successfully',
            'user' => new UserResource($user),
        ];
    }

    public function getSharedLists(Request $request)
    {
        $todoLists = $this->userRepository->getSharedListsByUser($request->user());

        return TodoListResource::collection($todoLists);
    }
}
