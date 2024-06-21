<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Todo extends Model
{
    use HasFactory;

    protected $table = 'todos';

    protected $fillable = [
        'todo_list_id',
        'title',
        'content'
    ];

    public function todoList(): BelongsTo
    {
        return $this->belongsTo(TodoList::class);
    }

    public function image(): HasOne
    {
        return $this->hasOne(Image::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tags_todo', 'todo_id', 'tag_id');
    }
}
