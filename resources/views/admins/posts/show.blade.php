@extends('front.layout.master')

@section('content')
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <!-- Featured blog post-->
            <div class="card mb-4">
                <a href="#!"><img class="card-img-top" src="{{ $post->getFirstMediaUrl('posts') }}" alt="..." /></a>
                <div class="card-body">
                    <div class="small text-muted">{{ $post->created_at }}</div>
                    <h2 class="card-title">{{ $post->title }}</h2>
                    <p class="card-text">{{ $post->description }}</p>
                </div>
            </div>
            <div class="card mb-4">
                <h2>#comments</h2>
            </div>
            <div>
            </div>
            @foreach ($post->comments as $comment)
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title h4">{{ $comment->comment }}</h2>
                        {{-- <a class="btn btn-primary" href="{{ route('comments.edit', [
                    'comment' => $comment->id, 'post' => $post->id]) }}">edit →</a>
                <form id="delete-post-form" method="post" action="{{ route('comments.destroy',
                ['comment' => $comment->id, 'post' => $post->id]) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Delete
                    </button>
                </form> --}}
                    </div>
                </div>
            @endforeach

            <div class="card mb-4">
                <h2>#reports</h2>
                @foreach ($post->reports as $report)
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="card-title h4">{{ $report->reason }}</h2>
                            {{-- <a class="btn btn-primary" href="{{ route('comments.edit', [
                    'comment' => $comment->id, 'post' => $post->id]) }}">edit →</a>
                <form id="delete-post-form" method="post" action="{{ route('comments.destroy',
                ['comment' => $comment->id, 'post' => $post->id]) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Delete
                    </button>
                </form> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
