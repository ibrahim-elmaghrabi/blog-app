@extends('front.layout.master')

@section('content')
<div class="row">
    <!-- Blog entries-->
    <div class="col-lg-8">
        <!-- Nested row for non-featured blog posts-->
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <h2># Posts</h2>
                    <a class="btn btn-primary" href="{{ route('posts.create') }}">Add Post →</a>
                    </div>
                <!-- Blog post-->
                @foreach ($posts as $post)
                <div class="card mb-4">
                    <a href="#!"><img class="card-img-top" src="{{ asset('storage/'.$post->image) }}" alt="..." /></a>
                    <div class="card-body">
                        <div class="small text-muted">{{ $post?->created_at }}</div>
                        <h2 class="card-title h4">{{ $post->title }}</h2>
                        <p class="card-text">{{ $post->description }}</p>
                        <a class="btn btn-primary" href="{{ route('posts.show', $post->id) }}">View →</a>
                        @if($post->user_id == auth()->id() || $post->user->user_type == 'admin')
                        <a class="btn btn-primary" href="{{ route('posts.edit', $post->id) }}">edit →</a>
                        <form id="delete-post-form" method="post" action="{{ route('posts.destroy', $post->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
