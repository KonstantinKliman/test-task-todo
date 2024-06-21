<?php

namespace App\Http\Requests\Todo;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'query' => ['required', 'string']
        ];
    }
}
