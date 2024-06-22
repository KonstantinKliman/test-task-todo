<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TodoList extends Model
{
    use HasFactory;

    protected $table = 'todo_lists';

    protected $fillable = [
        'user_id',
        'name'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function todos(): HasMany
    {
        return $this->hasMany(Todo::class);
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    public function sharedWith()
    {
        return $this->belongsToMany(User::class, 'permissions')
            ->withPivot( 'can_edit')
            ->withTimestamps();
    }
}
