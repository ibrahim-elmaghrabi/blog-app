<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Http\Requests\Web\CommentRequest;
use App\Models\Post\Post;

class CommentController extends Controller
{
    public function index(Post $post)
    {
        $comments = comment::where('post_id', $post->id)->paginate()->latest(10);

        return view('posts.show', compact('comments'));
    }

    public function create($post)
    {
        return view('comments.create', compact('post'));
    }

    public function store(Post $post, CommentRequest $request)
    {
        $post->comments()->create($request->validated() + ['user_id' => auth()->id()]);

        return back()->with('message', 'created successfully');
    }

    public function edit($post, Comment $comment)
    {
        $this->checkAccess($comment);

        return view('comments.edit', compact(['comment', 'post']));
    }

    public function update($post, Comment $comment, CommentRequest $request)
    {
        $this->checkAccess($comment);

        $comment->update($request->validated());

        return redirect()->route('posts.show', $post)->with('message', 'Updated Successfully');
    }

    public function destroy($post, Comment $comment)
    {
        $this->checkAccess($comment);
        $comment->delete();

        return redirect()->route('posts.show', $post)->with('message', 'Deleted Successfully');
    }

    private function checkAccess($comment)
    {
        if($comment->user_id != auth()->id()) {
            abort(403);
        }
    }

}
