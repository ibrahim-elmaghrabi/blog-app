<?php

namespace App\Http\Controllers\Web;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\LoginRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where([
            'email' =>  $request['email'],
            'user_type' => UserType::USER->value
        ])->first();

        if(! $user) {
            abort(404);
        }
        
    }

    public function show(Post $post)
    {
        $post->increment('views', 1);
        $post->with(['translations', 'comments']);

        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request)
    {
         Post::create($request->validated() + ['user_id' => 1
        //  auth()->id()
        ]);

         if($request->hasFile('image')) {
            $request['image'] = $request->file('image')->store('posts', 'public');
         }

        return view('posts.create')->with('message', 'created successfully');
    }

    public function edit(Post $post)
    {
        $this->checkAction($post);
        $post->with(['translations', 'comments']);

        return view('posts.show', compact('post'));
    }

    public function update(Post $post, PostRequest $request)
    {
        $this->checkAction($post);
        $post->update($request->validated());

        return view('posts.edit')->with('message', 'Updated Successfully');
    }

    public function destroy(Post $post)
    {
        $this->checkAction($post);
        foreach($post->comments as $comment) {
            $comment->delete();
        }
        $post->delete();

        return view('posts.index')->with('message', 'Deleted Successfully');
    }

}
