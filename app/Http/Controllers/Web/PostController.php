<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\PostRequest;
use App\Models\Post\Post;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['translation'])->get();

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->increment('views', 1);
        $post->with(['translation', 'comments']);

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
            $imagePath = $request->file('image')->store('posts', 'public');
        }
        $post->update(['image' => $imagePath]);

        return redirect()->route('home')->with('message', 'created successfully');
    }

    public function edit(Post $post)
    {
        $this->checkAction($post);
        $post->with('translation');

        return view('posts.edit', compact('post'));
    }

    public function update(Post $post, PostRequest $request)
    {
        $this->checkAction($post);;

        if ($request->hasFile('image')) {
          //  Storage::disk('public')->delete($post->image);
            $imagePath = $request->file('image')->store('posts', 'public');
        }
        $post->update($request->validated() + ['image' => $imagePath]);

        return back()->with('message', 'Updated Successfully');
    }

    public function destroy(Post $post)
    {
        $this->checkAction($post);
        if($post?->comments()?->count() > 0)
        foreach($post as $comment) {
            $comment->delete();
        }
        $post->delete();

        return redirect()->route('home')->with('message', 'Deleted Successfully');
    }

    private function checkAction($post)
    {
        if($post->user_id != auth()->id())
        {
            abort(403);
        }
    }
}
