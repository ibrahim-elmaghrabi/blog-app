<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function rules(): array
    {

     $image = ['required', 'image', 'mimes:jpeg,png,jpg,gif'];
     if(request()->isMethod('put')) {
        $image = ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'];
     }

        return [
            'ar.title' => ['required', 'string', 'max:255'],
            'en.title' => ['required', 'string', 'max:255'],
            'ar.description' => ['required', 'string', 'min:2', 'max:1000'],
            'en.description' => ['required', 'string', 'min:2', 'max:1000'],
            'image' => $image,
        ];

    }
}
