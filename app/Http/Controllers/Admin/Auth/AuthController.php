<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\User;
use App\Enums\UserType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\LoginRequest;

class AuthController extends Controller
{


    public function adminLogin()
    {
        return view('admins.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials , true)) {
            $request->session()->regenerate();

            return redirect()->intended(route('admins.index'));
        }

        return back()->withErrors(['password' => 'Invalid password']);
    }



    public function logout()
    {
        auth()->guard('admin')->logout();

        return redirect()->route('admin.login');
    }
}
