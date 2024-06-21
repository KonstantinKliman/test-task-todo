<?php

namespace App\Http\Requests\Todo;

use Illuminate\Foundation\Http\FormRequest;

class EditImageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'image' => ['required', 'image']
        ];
    }
}
