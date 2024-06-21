<?php

namespace App\Services;

use App\Http\Resources\TagResource;
use App\Repositories\Interfaces\ITagRepository;
use App\Services\Interfaces\ITagService;
use Illuminate\Http\Request;

class TagService implements ITagService
{
    private ITagRepository $repository;

    public function __construct(ITagRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list(Request $request)
    {
        $tagList = $this->repository->list($request->user());

        return TagResource::collection($tagList);
    }
}
