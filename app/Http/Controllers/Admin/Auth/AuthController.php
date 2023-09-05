<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function adminLogin()
    {
        return view('admins.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $guard = 'admin';

        $admin = User::where('email', $credentials['email'])
        ->where('user_type', UserType::ADMIN)
        ->first();

        if (!$admin) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        $adminLogin = auth()->guard($guard)->attempt($credentials);

        if ($adminLogin) {
            return redirect()->route('admins.index');
        }

        return back()->withErrors(['password' => 'Invalid password']);
    }



    public function logout()
    {
        auth()->guard('admin')->logout();

        return redirect()->route('admin.login');
    }
}




