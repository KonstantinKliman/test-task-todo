<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface ITagService
{
    public function list(Request $request);
}
