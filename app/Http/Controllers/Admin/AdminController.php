<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserType;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Controllers\Controller;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::query()->where('user_type', UserType::ADMIN->value)->get();


        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(AdminRequest $request)
    {

        User::create($request->validated() + ['user_type' => UserType::ADMIN->value]);

        return redirect()->route('admins.index');
    }

    public function destroy(User $admin)
    {

        $admin->delete();

        return back();
    }
}
