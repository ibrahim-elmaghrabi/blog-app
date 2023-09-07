@extends('front.layout.master')

@section('content')
<div class="card-body">
    <form name="add-blog-post-form" id="add-blog-post-form"
      method="POST" action="{{ route('admin_reports.update', $report->id)}}" enctype="multipart/form-data">
     @method('PUT')
      @csrf
     <div class="form-group">
        <label for="exampleInputEmail1">ar Title</label>
        <input type="text" value="{{  $report->{'reason:ar'} }}" name="ar[reason]" class="form-control">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">en Title</label>
        <input type="text" value="{{ $report->{'reason:en'} }}" name="en[reason]" class="form-control">
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
@endsection
