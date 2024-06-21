<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [
        'todo_id',
        'path'
    ];

    public function todo(): BelongsTo
    {
        return $this->belongsTo(Todo::class);
    }
}
