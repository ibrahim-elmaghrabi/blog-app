<?php

namespace App\Http\Controllers\Web;

use App\Models\Post\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\PostRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request as Req;


class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with('user')
        ->selectRaw('COUNT(*) as total')
         ->selectRaw('SUM(CASE WHEN active = 1 THEN 1 ELSE 0 END) as activePosts')
         ->selectRaw('SUM(CASE WHEN active = 0 THEN 1 ELSE 0 END) as inactivePosts')
         ->selectRaw('SUM(CASE WHEN active = 1 AND user_type = user THEN 1 ELSE 0 END) as activeUserPosts', [UserType::USER->value])
         ->first();
        dd($posts->total);

        $posts = Post:: query()
            ->with('translation')
            ->when($request->get('sort') == 'popular', function($q) {
                $q->orderBy('views', 'desc');
            })
            ->when($request->get('sort') == 'newest', function ($q) {
                $q->orderBy('created_at', 'desc');
            })
           // ->get();
            ->simplePaginate(10);

        return view('posts.index', compact('posts'));
    }


    public function show(Post $post, Req $request)
    {
        $post->load(['translation', 'comments']);

        $userIdentifier = md5($request->ip() . $request->header('User-Agent'));

        if (!Cache::has('postView:'.$post->id.':'.$userIdentifier)) {
            $post->increment('views');
            Cache::put('postView:'.$post->id.':'.$userIdentifier, true, now()->addMinutes(60));
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
        $keyword = $request->keyword;
        $posts = Post::with('translation')->get();

        if($keyword != ''){
            $posts = Post::whereHas('translation', function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')
                ->orWhere('description', 'like', '%' . $keyword . '%');
            })->get();
        }

            return response()->json([
                'posts' => $posts
             ]);

    }

    // public function sort(Request $request)
    // {
    //     if($request->order_by == 1)
    //     {
    //      $posts = Post::orderBy('created_at', 'DESC')->get();

    //     } elseif($request->order_by == 2)
    //     {
    //      $posts= Post::orderBy('views', 'DESC')->get();
    //     }

    //     return response()->json($posts);
    // }

    public function sort(Request $request)
    {
        // $cats =Categories::with('translation')->where('type','courses')->where('status',1)->get();
        $query = Post::query();

        if (isset($request->sort) && $request->sort == 'newest') {
            $query->orderBy('created_at', 'desc');
        }
        if (isset($request->sort) && $request->sort == 'popular') {
            $query->orderBy('views', 'desc');
        }

        $posts = $query->paginate();

        if ($request->ajax()) {
            return  response()->json([
                'status' => 200,
                'data' => view('posts.index', ['posts' => $posts])->render()
            ]);
        }
        return view('posts.index', get_defined_vars());
    }

}
