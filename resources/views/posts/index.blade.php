@extends('front.layout.master')

@section('content')
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <!-- Nested row for non-featured blog posts-->
            <div class="row">
                <div class="col-lg-6">
                    <!-- Search Form -->
                    <div>
                        <input type="text" name="keyword" id="search" placeholder="Search..."
                            value="{{ request('keyword') }}">
                        <div>
                            <!-- Sort By -->
                            <label for="sort">Sort By:</label>
                            <select class="select_input" id="sort" name="sort">
                                <option disabled selected hidden> @lang('Choose') </option>
                                <option value="newest"> newst </option>
                                <option value="popular"> popular</option>
                            </select>
                        </div>
                        <br>
                        <br>
                        <div class="card mb-6">
                            <h2># Posts</h2>
                            <a class="btn btn-primary" href="{{ route('posts.create') }}">Add Post →</a>
                        </div>
                        <br>
                        <!-- Blog post-->
                        <div id="post-container">
                            @foreach ($posts as $post)
                                <div class="card mb-8">
                                    <img class="card-img-top" src="{{ $post->getFirstMediaUrl('posts') }}"
                                        alt="..." />
                                    <div class="card-body">
                                        <div class="small text-muted">{{ $post->created_at }}</div>
                                        <h2 class="card-title h4">{{ $post->title }}</h2>
                                        <p class="card-text">{{ $post->description }}</p>
                                        <a class="btn btn-primary" href="{{ route('posts.show', $post->id) }}">View
                                            →</a>
                                        @if ($post->user_id == auth()->id())
                                            <a class="btn btn-primary" href="{{ route('posts.edit', $post->id) }}">edit
                                                →</a>
                                            <form id="delete-post-form-{{ $post->id }}" method="post"
                                                action="{{ route('posts.destroy', $post->id) }}"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Delete the post ?')">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                        <a class="btn btn-warning"
                                            href="{{ route('posts.reports.create', $post->id) }}"> Add
                                            Report →</a>
                                    </div>
                                </div>
                                <br>
                            @endforeach
                        </div>

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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                search();
            });
        });

        function search() {
            var keyword = $('#search').val();
            $.get('{{ route("search") }}', {
                _token: $('meta[name="csrf-token"]').attr('content'),
                keyword: keyword
            }, function(data) {
                table_post_row(data);
                console.log(data);
            });
        }

        // table row with ajax
        function table_post_row(res) {
            let htmlView = '';
            if (res.posts.length <= 0) {
                htmlView += `
                    <div class="card mb-8">
                        <div class="card-body">
                            <p>No data.</p>
                        </div>
                    </div>`;
            }
            for (let i = 0; i < res.posts.length; i++) {
                htmlView += `
                    <div class="card mb-8">
                        <img class="card-img-top" src="${res.posts[i].getFirstMediaUrl('posts')}" alt="..." />
                        <div class="card-body">
                            <div class="small text-muted">${res.posts[i].created_at}</div>
                            <h2 class="card-title h4">${res.posts[i].title}</h2>
                            <p class="card-text">${res.posts[i].description}</p>
                            <a class="btn btn-primary" href="{{ route('posts.show', '') }}" onclick="event.preventDefault(); window.location.href='{{ route('posts.show', '') }}' + res.posts[i].id">View →</a>

                            <a class="btn btn-warning" href="{{ route('posts.reports.create', '') }}" onclick="event.preventDefault(); window.location.href='{{ route('posts.reports.create', '') }}' + res.posts[i].id"> Add Report →</a>
                        </div>
                    </div>`;
            }
            $('#post-container').html(htmlView);
        }
    </script>
@endsection


