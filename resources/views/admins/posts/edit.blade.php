@extends('front.layout.master')

@section('content')
<div class="card-body">
    <form name="add-blog-post-form" id="add-blog-post-form"
      method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
     @method('PUT')
      @csrf
     <div class="form-group">
        <label for="exampleInputEmail1">ar Title</label>
        <input type="text" value="{{  $post->{'title:ar'} }}" name="ar[title]" class="form-control">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">en Title</label>
        <input type="text" value="{{ $post->{'title:en'} }}" name="en[title]" class="form-control">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">ar Description</label>
        <textarea name="ar[description]" class="form-control">{{ $post->{'description:ar'} }}</textarea>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">en Description</label>
        <textarea name="en[description]" class="form-control">{{ $post->{'description:en'} }}</textarea>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">image</label>
        <input type="file" name="image" class="form-control">
      </div>

      <div class="form-group">
        <img src="{{ asset('storage/posts'.$post->image) }}">
      </div>

      <br>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
@endsection
