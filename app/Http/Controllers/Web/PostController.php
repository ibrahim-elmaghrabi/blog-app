<?php

namespace App\Http\Controllers\Web;

use App\Models\Post\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\PostRequest;
use Illuminate\Support\Facades\Cookie;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::query()
            ->with('translation')
            ->search($request['keyword'])
            ->when($request['sort'] === 'newest', function ($query) {
                return $query->sortByNewest();
            }, function ($query) {
            return $query->mostPopular();
        })->get();
        //->paginate();

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        if (!Cookie::get("post_{$post->id}")) {
            Cookie::queue("post_{$post->id}", '1', 60);
            $post->increment('views', 1);
        }

        $post->load(['translation', 'comments']);
        $post->loadCount('reports');

        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request)
    {
        $post = Post::create($request->validated() + ['user_id' => auth()->id()]);

        if ($request->hasFile('image')) {
            $post->addMediaFromRequest('image')->toMediaCollection('posts');
        }

        return redirect()->route('home')->with('message', 'created successfully');
    }

    public function edit(Post $post)
    {
        $post->with('translation');

        return view('posts.edit', compact('post'));
    }

    public function update(Post $post, PostRequest $request)
    {
        $post->update($request->validated());

        if ($request->hasFile('image')) {
            $post->clearMediaCollection('posts');
            $post->addMediaFromRequest('image')->toMediaCollection('posts');
        }

        return back()->with('message', 'Updated Successfully');
    }

    public function destroy(Post $post)
    {
        if ($post?->comments()?->count() > 0)
            foreach ($post as $comment) {
                $comment->delete();
            }
        $post->delete();

        return redirect()->route('home')->with('message', 'Deleted Successfully');
    }

}
