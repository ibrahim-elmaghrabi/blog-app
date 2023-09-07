<?php

namespace App\Http\Controllers\Web;

use App\Models\Post\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\PostRequest;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::query()
            ->with('translation')
            ->search($request['keyword'])
            ->latest()
            ->simplePaginate(10);

        return view('posts.index', compact('posts'));
    }


    public function show(Post $post)
    {
        $post->load(['translation', 'comments']);

        $userIdentifier = md5(request()->ip() . request()->header('User-Agent'));

        if (!Cache::has('postView:'.$post->id.':'.$userIdentifier)) {
            $post->increment('views');
            Cache::put('postView:'.$post->id.':'.$userIdentifier, true, 60);
        }

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
        $post->withCount('comments');

        if ($post->comments_count  > 0 )
            foreach ($post->comments as $comment) {
                $comment->delete();
            }

        $post->delete();

        return redirect()->route('home')->with('message', 'Deleted Successfully');
    }

    public function search(Request $request)
    {
            $keyword = $request->searchPost;
            $posts = Post::with('translation')->Search($keyword)->get();

            // return view('posts.index', compact('posts'));
            echo $posts;
    }

    public function sort(Request $request)
    {
        if($request->order_by == 1)
        {
         $posts = Post::orderBy('created_at', 'ASC')->get();

        } elseif($request->order_by == 2)
        {
         $posts= Post::orderBy('views', 'DESC')->get();
        }

        return response()->json($posts);
    }

}
