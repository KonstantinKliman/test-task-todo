<?php

namespace App\Repositories\Interfaces;

interface IPermissionRepository
{
    public function updateOrCreate(array $data);
}
