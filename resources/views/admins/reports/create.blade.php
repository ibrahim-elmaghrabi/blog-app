@extends('front.layout.master')

@section('content')
<div class="card-body">
    <form name="add-blog-post-form" id="add-blog-post-form"
      method="POST" action="{{ route('admin_reports.store') }}" enctype="multipart/form-data">
     @csrf
      <div class="form-group">
        <label for="exampleInputEmail1">Arabic reason</label>
        <input type="text"  name="ar[reason]" class="form-control">
      </div>
      @error('ar.reason')
      <p>{{ $message }}</p>
      @enderror
      <div class="form-group">
        <label for="exampleInputEmail1">English reason</label>
        <input type="text" name="en[reason]" class="form-control">
      </div>
      @error('en.reason')
        <p>{{ $message }}</p>
      @enderror
      <br>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
@endsection
