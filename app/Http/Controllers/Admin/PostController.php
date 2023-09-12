<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\PostRequest;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::query()
            ->with('translation')
            ->simplePaginate(10);


        return view('admin.posts.index', compact('posts'));
    }

    public function edit(Post $admin_post)
    {
        $admin_post->with('translation');

        return view('admin.posts.edit' , ['post' => $admin_post]);
    }

    public function update($post, PostRequest $request)
    {
        $posted = Post::findOrFail($post);
        $posted->update($request->validated());

        if ($request->hasFile('image')) {
            $posted->clearMediaCollection('posts');
            $posted->addMediaFromRequest('image')->toMediaCollection('posts');
        }

        return redirect()->route('admin_posts.index')->with('message', 'Updated Successfully');
    }

    public function destroy($post)
    {
        $posted = Post::withCount('comments')->findOrFail($post);
        if ($posted->comments_count > 0)
            foreach ($posted->comments as $comment) {
                $comment->delete();
            }

        $posted->delete();

        return back();
    }

    public function showComments(Post $post)
    {
        $post->with('comments');

        return view('admin.posts.comment' , compact('post'));

    }

    public function showReports(Post $post)
    {
        $post->with('reports');

        return view('admin.posts.report' , compact('post'));

    }

    public function updateStatus(Post $post, $status)
    {
        $updated = $post->update([
            'is_active' => $status
        ]);
        if ($updated) {
            return back()->with('status', 'Status Updated Successfully');
        }
    }


}
