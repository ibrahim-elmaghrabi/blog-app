@extends('front.layout.master')

@section('content')
<div class="card-body">
    <form name="add-blog-post-form" id="add-blog-post-form"
      method="POST" action="{{ route('posts.comments.update', ['comment' => $comment, 'post' => $post]) }}" enctype="multipart/form-data">
     @method('PUT')
      @csrf
     <div class="form-group">
        <label for="exampleInputEmail1">Comment</label>
        <input type="text" value="{{ $comment->comment }}" name="comment" class="form-control">
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
@endsection
