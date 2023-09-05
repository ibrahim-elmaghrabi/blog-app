<?php

namespace App\Http\Requests\Admin;

use App\Enums\UserType;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        // $admin = User::findOrFail('email', $this->email);
        // if($admin->user_type !== UserType::ADMIN->value) {

        // }
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required'],
        ];
    }
}
