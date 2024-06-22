<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Repositories\Interfaces\IPermissionRepository;

class PermissionRepository implements IPermissionRepository
{

    public function updateOrCreate(array $data)
    {
        Permission::query()->updateOrCreate(
            [
                'todo_list_id' => $data['todo_list_id'],
                'user_id' => $data['user_id']
            ],
            [
                'can_edit' => $data['can_edit'],
            ]
        );
    }
}
