<?php

namespace App\Services\Interfaces;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;

interface IAuthService
{
    public function register(RegisterRequest $request);

    public function login(LoginRequest $request);

    public function getUser(Request $request);

    public function logout(Request $request);
}
