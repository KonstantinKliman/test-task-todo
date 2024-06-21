<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Todo\CreateRequest;
use App\Http\Requests\Todo\EditImageRequest;
use App\Http\Requests\Todo\FilterRequest;
use App\Http\Requests\Todo\SearchRequest;
use App\Services\Interfaces\ITodoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    private ITodoService $service;

    public function __construct(ITodoService $service)
    {
        $this->service = $service;
    }

    public function create(CreateRequest $request)
    {
        return new JsonResponse($this->service->create($request), 201);
    }

    public function filterByTags(FilterRequest $request)
    {
        return new JsonResponse($this->service->filterByTags($request), 200);
    }

    public function editImage(EditImageRequest $request, int $todoId)
    {
        return new JsonResponse($this->service->editImage($request, $todoId), 200);
    }

    public function deleteImage(int $todoId)
    {
        return new JsonResponse($this->service->deleteImage($todoId), 200);
    }

    public function searchByTitle(SearchRequest $request)
    {
        return new JsonResponse($this->service->search($request), 200);
    }
}
