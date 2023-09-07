@extends('front.layout.master')

@section('content')
<div class="row">
    <!-- Blog entries-->
    <div class="col-lg-8">
        <!-- Nested row for non-featured blog posts-->
        <div class="row">
            <div class="col-lg-6">
                    <!-- Search Form -->
                <form action="{{ route('home') }}" method="GET">
                    <input type="text" name="keyword" placeholder="Search..." value="{{ request('keyword') }}">
                    <button type="submit">Search</button>
                 </form>
                 <br>
                <!-- Sort By -->
                <form action="{{ route('home') }}" method="GET">
                    <label for="sort">Sort By:</label>
                    <select name="sort" id="sort">
                        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest</option>
                        <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>Most Popular</option>
                    </select>
                    <button type="submit">Sort</button>
                </form>
                <br>

                <div class="card mb-4">
                    <h2># Posts</h2>
                    <a class="btn btn-primary" href="{{ route('posts.create') }}">Add Post →</a>
                    </div>
                <!-- Blog post-->
                <div id="resultsContainer">
                @foreach ($posts as $post)
                <div class="card mb-4">
                    <img class="card-img-top" src="{{ $post->getFirstMediaUrl('posts') }}" alt="..." />
                    <div class="card-body">
                        <div class="small text-muted">{{ $post?->created_at }}</div>
                        <h2 class="card-title h4">{{ $post->title }}</h2>
                        <p class="card-text">{{ $post->description }}</p>
                        <a class="btn btn-primary" href="{{ route('posts.show', $post->id) }}">View →</a>
                        @if($post->user_id == auth()->id())
                        <a class="btn btn-primary" href="{{ route('posts.edit', $post->id) }}">edit →</a>
                        <form id="delete-post-form" method="post" action="{{ route('posts.destroy', $post->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                        <a class="btn btn-warning" href="{{ route('reports.create', $post->id) }}"> Add Report →</a>
                        @endif
                    </div>
                </div>
                @endforeach
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection


