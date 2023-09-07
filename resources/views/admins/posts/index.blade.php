@extends('front.layout.master')

@section('content')
<div class="row">
    <!-- Blog entries-->
    <div class="col-lg-8">
        <!-- Nested row for non-featured blog posts-->
        <div class="row">
            <div class="col-lg-6">
                    <!-- Search Form -->
                <br>
                <div class="card mb-4">
                    <h2># Posts</h2>
                    <a class="btn btn-primary" href="{{ route('admin_posts.create') }}">Add Post →</a>
                    </div>
                <!-- Blog post-->
                @foreach ($posts as $post)
                <div class="card mb-4">
                    <img class="card-img-top" src="{{ $post->getFirstMediaUrl('posts') }}" alt="..." />
                    <div class="card-body">
                        <div class="small text-muted">{{ $post?->created_at }}</div>
                        <h2 class="card-title h4">{{ $post->title }}</h2>
                        <p class="card-text">{{ $post->description }}</p>
                        <a class="btn btn-primary" href="{{ route('admin_posts.show', $post->id) }}">View →</a>
                        <a class="btn btn-primary" href="{{ route('admin_posts.edit', $post->id) }}">edit →</a>
                        <form id="delete-post-form" method="post" action="{{ route('admin_posts.destroy', $post->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure?')">
                                    Delete
                            </button>
                        </form>
                        <a class="btn btn-warning" href="{{ route('admin_reports.index', $post->id) }}">show reports →</a>
                    </div>
                </div>
                @endforeach
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    $(document).ready(function() {
    // Create the form
    var form = document.getElementById('search-form');

    // Attach an event listener to the submit button
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        // Get the search keyword
        var keyword = document.getElementById('keyword').value;

        // Make an AJAX request to the server
        $.ajax({
            url: '/search',
            method: 'GET',
            data: {
                keyword: keyword
            }
        }).done(function(data) {
            // Update the page with the search results
            $('#results').html(data);
        });
    });
});
</script>
