<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'comment' => ['required', 'string', 'max:255']
        ];
    }
}
