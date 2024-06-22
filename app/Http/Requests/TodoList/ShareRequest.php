<?php

namespace App\Http\Requests\TodoList;

use Illuminate\Foundation\Http\FormRequest;

class ShareRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'todoListId' => ['required', 'integer', 'exists:todo_lists,id'],
            'userId' => ['required', 'integer', 'exists:users,id'],
            'canEdit' => ['boolean']
        ];
    }
}
