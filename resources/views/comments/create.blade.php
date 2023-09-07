@extends('front.layout.master')

@section('content')
<div class="card-body">
    <form name="add-blog-post-form" id="add-blog-post-form"
      method="POST" action="{{ route('posts.comments.store', $post) }}" enctype="multipart/form-data">
     @csrf
      <div class="form-group">
        <label for="exampleInputEmail1">Arabic Title</label>
        <input type="text" value="{{ old('comment') }}" name="comment" class="form-control">
      </div>
      @error('comment')
      <p>{{ $message }}</p>
      @enderror
      <br>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
@endsection
