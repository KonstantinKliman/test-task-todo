<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Repositories\Interfaces\IUserRepository;
use App\Services\Interfaces\IUserService;

class UserService implements IUserService
{
    private IUserRepository $repository;

    public function __construct(IUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list()
    {
        $user = $this->repository->list();
        $resource = new UserResource($user);

        return $resource::collection($user);
    }
}
