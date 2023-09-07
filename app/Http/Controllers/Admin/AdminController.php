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
        $admins = User::query()
            ->where('user_type', UserType::ADMIN->value)
            ->simplePaginate(10);

        return view('admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admins.create');
    }

    public function store(AdminRequest $request)
    {
        User::create($request->validated() + ['user_type' => UserType::ADMIN->value]);

        return redirect()->route('admins.index');
    }

    public function destroy($admin)
    {
        User::whereId($admin)->delete();

        return back();
    }
}
