<?php

namespace App\Services\Interfaces;

use App\Http\Requests\Todo\CreateRequest;
use App\Http\Requests\Todo\EditImageRequest;
use Illuminate\Http\Request;

interface ITodoService
{
    public function create(CreateRequest $request);

    public function filterByTags(Request $request);

    public function editImage(EditImageRequest $request, int $todoId);

    public function deleteImage(int $todoId);

    public function search(Request $request);
}
