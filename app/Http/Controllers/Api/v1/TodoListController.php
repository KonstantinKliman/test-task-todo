<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoList\CreateRequest;
use App\Services\Interfaces\ITodoListService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    private ITodoListService $service;

    public function __construct(ITodoListService $service)
    {
        $this->service = $service;
    }

    public function create(CreateRequest $request)
    {
        return new JsonResponse($this->service->create($request), 201);
    }

    public function list(Request $request)
    {
        return new JsonResponse($this->service->list($request), 200);
    }
}
