<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'ar.reason' => ['required', 'string', 'max:255'],
            'en.reason' => ['required', 'string', 'max:255'],
        ];
    }
}
