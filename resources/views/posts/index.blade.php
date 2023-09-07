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
                        <input type="text" name="keyword" id="searchPost" placeholder="Search..."
                            value="{{ request('keyword') }}">
                        <br>
                    </form>
                        <!-- Sort By -->
                        <form action="{{ route('ajax_sort') }}" method="post">
                            <label for="sort">Sort By:</label>
                            <select name="sort" id="sort" value="newest">
                                <option value="newest" selected>Newest</option>
                                <option value="popular">Most Popular</option>
                            </select>
                            <br>
                        </form>

                    <br>

                    <div class="card mb-6">
                        <h2># Posts</h2>
                        <a class="btn btn-primary" href="{{ route('posts.create') }}">Add Post →</a>
                    </div>
                    <br>
                    <!-- Blog post-->
                    <div>
                        @foreach ($posts as $post)
                            <div class="card mb-8">
                                <img class="card-img-top" src="{{ $post->getFirstMediaUrl('posts') }}" alt="..." />
                                <div class="card-body">
                                    <div class="small text-muted">{{ $post->created_at }}</div>
                                    <h2 class="card-title h4">{{ $post->title }}</h2>
                                    <p class="card-text">{{ $post->description }}</p>
                                    <a class="btn btn-primary" href="{{ route('posts.show', $post->id) }}">View →</a>
                                    @if ($post->user_id == auth()->id())
                                        <a class="btn btn-primary" href="{{ route('posts.edit', $post->id) }}">edit →</a>
                                        <form id="delete-post-form" method="post"
                                            action="{{ route('posts.destroy', $post->id) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Delete the post ?')">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                    <a class="btn btn-warning" href="{{ route('posts.reports.create', $post->id) }}"> Add
                                        Report →</a>
                                </div>
                            </div>
                            <br>
                        @endforeach

                        <div class="card mb-8" id="results">
                            {{-- Ajax results will be appended here --}}
                        </div>
                        <br>

                        <div class="d-flex justify-content-center">
                            {!! $posts->links() !!}
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    const value = 'newest';

    $("#sort").on('change', function() {
        var orderBy = document.getElementById("sort").value;
        $('#results').empty();

        if (orderBy == "newest") {
            orderBy = 1;
        } else if (orderBy == "popular") {
            orderBy = 2;
        }

        $.ajax({
            url: "{{ route('ajax_sort') }}",
            type: "POST",
            data: {
                order_by: orderBy,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(result) {
                $.each(result, function(key, value) {
                    var card = '<div class="card mb-8">' +
                        '<img class="card-img-top" src="' + value.image_url + '" alt="..." />' +
                        '<div class="card-body">' +
                        '<div class="small text-muted">' + value.created_at + '</div>' +
                        '<h2 class="card-title h4">' + value.title + '</h2>' +
                        '<p class="card-text">' + value.description + '</p>' +
                        '<a class="btn btn-primary" href="{{ route('posts.show', value.id) }}">View →</a>' +
                        '<a class="btn btn-primary" href="{{ route('posts.edit', value.id) }}" data-id="{{ value.id }}">edit →</a>' +
                        '<form id="delete-post-form" method="post" action="{{ route('posts.destroy', value.id) }}" style="display: inline;">' +
                        '@csrf' +
                        '@method('DELETE')' +
                        '<button type="submit" class="btn btn-danger" onclick="return confirm(\'Delete the post ?\')">Delete</button>' +
                        '</form>' +
                        '<a class="btn btn-warning" href="{{ route('posts.reports.create', value.id) }}"> Add Report →</a>' +
                        '</div>' +
                        '</div>';

                    $("#results").append(card);
                });
            }
        });
    });
</script>

@endsection
