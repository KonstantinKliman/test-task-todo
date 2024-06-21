<?php

namespace App\Services;

use App\Exceptions\InvalidUserEmailException;
use App\Exceptions\InvalidUserPasswordException;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Repositories\Interfaces\IUserRepository;
use App\Services\Interfaces\IAuthService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthService implements IAuthService
{
    private IUserRepository $repository;

    public function __construct(IUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function register(RegisterRequest $request)
    {
        $data = [
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'password' => Hash::make($request->validated('password'))
        ];

        $user = $this->repository->create($data);

        return new UserResource($user);
    }

    public function login(LoginRequest $request)
    {
        $data = [
            'email' => $request->validated('email'),
            'password' => $request->validated('password')
        ];

        try {
            $user = $this->repository->getByEmail($data['email']);
        } catch (ModelNotFoundException $exception) {
            throw new InvalidUserEmailException();
        }

        if (!Hash::check($data['password'], $user->password)) {
            throw new InvalidUserPasswordException();
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return ['token' => $token];
    }

    public function getUser(Request $request)
    {
        $user = $request->user();
        return new UserResource($user);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return null;
    }
}
