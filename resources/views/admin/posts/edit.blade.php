@extends('admin.layouts.master')
@section('main-pageName')  Post  @endsection
@section('pageName')  Edit  @endsection
@section('content')
<section class="content">
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit<strong> {{ $post->title }} </strong></h3>
              </div>
              <div>
              <form name="add-blog-post-form" id="add-blog-post-form" method="POST"
              action="{{ route('admin_posts.update', $post->id) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">ar Title</label>
                    <input type="text" value="{{ $post->{'title:ar'} }}" name="ar[title]" class="form-control">
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
                    <img src="{{ $post->getFirstMediaUrl('posts') }}">
                </div>
                </div>
                <br>
                <div class="card-footer" >
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
              </div>

            </div>
            </div>
          </div>
        </div>
      </div>
</section>
@endsection
