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
                        <input type="text" name="keyword" id="searchPost" placeholder="Search..."
                            value="{{ request('keyword') }}">
                        <div>
                            <!-- Sort By -->
                            <label for="sort">Sort By:</label>
                            <select name="sort" id="sort" value="newest">
                                <option value="newest" selected>Newest</option>
                                <option value="popular">Most Popular</option>
                            </select>
                            <br>


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
                                                <form id="delete-post-form" method="post"
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

        {{-- @section('script')
            <script>
                $(document).on('keyup', '#searchPost'function() {
                    var searchContent = $(this).val()

                    if (searchContent != '') {

                        $.ajax({
                            url: "{{ route('search') }}",
                            type: "GET",
                            data: {
                                searchPost: keyword,
                                _token: '{{ csrf_token() }}'
                            },
                            dataType: 'json',
                            success: function(data) {
                                console.log(data);
                            }
                        });
                    }

                });
            </script>
        @endsection --}}
