@extends('front.layout.master')

@section('content')
<div class="card-body">
    <form name="add-blog-post-form" id="add-blog-post-form"
      method="POST" action="{{ route('comments.store', $post) }}" enctype="multipart/form-data">
     @csrf
      <div class="form-group">
        <label for="exampleInputEmail1">Arabic Reason</label>
        <input type="text" value="{{ old('reason') }}" name="ar[reason]" class="form-control">
      </div>
      @error('comment')
      <p>{{ $message }}</p>
      @enderror
      <div class="form-group">
        <label for="exampleInputEmail1">english Reason</label>
        <input type="text" value="{{ old('reason') }}" name="en[reason]" class="form-control">
      </div>
      @error('comment')
      <p>{{ $message }}</p>
      @enderror
      <br>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
@endsection
