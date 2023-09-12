<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserType;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->where('user_type', UserType::USER->value)->get();


        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {

        $user->delete();

        return back();
    }

    public function updateStatus(User $user, $status)
    {
        $updated = $user->update([
            'is_active' => $status
        ]);
        if ($updated) {
            return back()->with('status', 'Status Updated Successfully');
        }
    }
}
