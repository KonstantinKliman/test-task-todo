<?php

namespace App\Http\Requests\Todo;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'todoListId' => ['required', 'numeric', 'exists:todo_lists,id'],
            'title' => ['required', 'string', 'min:1', 'max:255'],
            'content' => ['required', 'string', 'min:1', 'max:65535'],
            'tags' => ['string'],
            'image' => ['image']
        ];
    }
}
