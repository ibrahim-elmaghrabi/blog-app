<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use App\Models\Post\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\PostRequest;

class CommentController extends Controller
{

    public function destroy(Comment $comment)
    {

        $comment->delete();

        return back();
    }


}
