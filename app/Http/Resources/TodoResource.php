<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'todoListId' => $this->todoList->id,
            'title' => $this->title,
            'content' => $this->content,
        ];

        if ($this->image) {
            $data['image'] = [
                'id' => $this->image->id,
                'path' => $this->image->path
            ];
        }

        if ($this->tags) {
            $data['tags'] = $this->tags->pluck('name');
        }

        return $data;
    }
}
