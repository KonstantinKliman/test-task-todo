<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    protected $fillable = [
        'todo_list_id',
        'user_id',
        'can_edit'
    ];

    public function todoLists()
    {
        return $this->belongsTo(TodoList::class, 'todo_list_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
