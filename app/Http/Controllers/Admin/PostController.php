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
            ->search($request['keyword'])
            ->when($request['sort'] == 'newest', function ($query) {
                return $query->sortByNewest();
            }, function ($query) {
            return $query->mostPopular();
        })->get();
        //->paginate();

        return view('admins.posts.index', compact('posts'));
    }

    public function show($post)
    {
        $posted = Post::findOrFail($post)->with(['translation', 'comments'])->first();

        return view('admins.posts.show', ['post' => $posted]);
    }


    public function edit($post)
    {
        $posted = Post::findOrFail($post)->with('translation')->first();

        return view('admins.posts.edit', ['post' => $posted]);
    }

    public function update($post, PostRequest $request)
    {
        $posted = Post::findOrFail($post);
        $posted->update($request->validated());

        if ($request->hasFile('image')) {
            $post->clearMediaCollection('posts');
            $post->addMediaFromRequest('image')->toMediaCollection('posts');
        }

        return redirect()->route('admin_posts.index')->with('message', 'Updated Successfully');
    }

    public function destroy($post)
    {
        $posted = Post::findOrFail($post);
        if ($posted?->comments()?->count() > 0)
            foreach ($posted->comments as $comment) {
                $comment->delete();
            }
        $posted->delete();

        return back();
    }

}
