<?php

namespace App\Http\Requests\Todo;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'tags' => ['required', 'string']
        ];
    }
}
