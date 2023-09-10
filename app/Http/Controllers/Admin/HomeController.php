<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserType;
use App\Models\Post\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\PostRequest;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with('user')
            ->selectRaw('COUNT(*) as total')
            ->selectRaw('SUM(CASE WHEN active = 1 THEN 1 ELSE 0 END) as activePosts')
            ->selectRaw('SUM(CASE WHEN active = 0 THEN 1 ELSE 0 END) as inactivePosts')
            ->selectRaw('SUM(CASE WHEN active = 1 AND user_type = ? THEN 1 ELSE 0 END) as activeUserPosts', [UserType::USER->value])
            ->first();
            

        return view('admins.posts.index', compact('posts'));
    }



}
