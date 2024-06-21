<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\ITagService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    private ITagService $service;

    public function __construct(ITagService $service)
    {
        $this->service = $service;
    }

    public function list(Request $request)
    {
        return new JsonResponse($this->service->list($request), 200);
    }
}
