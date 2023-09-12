<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserType;
use App\Models\Post\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\PostRequest;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with('user')
            ->selectRaw('COUNT(*) as total')
            ->selectRaw('SUM(CASE WHEN is_active = 1 THEN 1 ELSE 0 END) as activePosts')
            ->selectRaw('SUM(CASE WHEN is_active = 0 THEN 1 ELSE 0 END) as inactivePosts')
            ->first();



        return view('admin.index', compact('posts'));
    }



}
