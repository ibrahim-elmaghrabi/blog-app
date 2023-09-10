<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\User;
use App\Enums\UserType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\LoginRequest;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function adminLogin()
    {
        return view('admins.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::guard('admin')->attempt($credentials , true)) {
            $request->session()->regenerate();

            return redirect()->intended(route('admins.index'));
        }

        return back()->withErrors(['password' => 'Invalid password']);
    }



    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
