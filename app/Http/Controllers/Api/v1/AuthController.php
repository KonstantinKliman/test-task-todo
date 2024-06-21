<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Interfaces\IAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private IAuthService $service;

    public function __construct(IAuthService $service)
    {
        $this->service = $service;
    }

    public function register(RegisterRequest $request)
    {
        return new JsonResponse($this->service->register($request), 201);
    }

    public function login(LoginRequest $request)
    {
        return new JsonResponse($this->service->login($request), 200);
    }

    public function getUser(Request $request)
    {
        return new JsonResponse($this->service->getUser($request), 200);
    }

    public function logout(Request $request)
    {
        return new JsonResponse($this->service->logout($request), 200);
    }
}
