<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\IUserService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private IUserService $service;

    public function __construct(IUserService $service)
    {
        $this->service = $service;
    }

    public function list()
    {
        return new JsonResponse($this->service->list(), 200);
    }
}
