@extends('front.layout.master')

@section('content')
    <div class="card-body">
        <form name="add-blog-post-form" id="add-blog-post-form" method="POST" action="{{ route('admin_posts.store') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Arabic Title</label>
                <input type="text" name="ar[title]" class="form-control">
            </div>
            @error('ar.title')
                <p>{{ $message }}</p>
            @enderror
            <div class="form-group">
                <label for="exampleInputEmail1">English Title</label>
                <input type="text" name="en[title]" class="form-control">
            </div>
            @error('en.title')
                <p>{{ $message }}</p>
            @enderror
            <div class="form-group">
                <label for="exampleInputEmail1">Arabic Description</label>
                <textarea name="ar[description]" class="form-control"></textarea>
            </div>
            @error('ar[description]')
                <p>{{ $message }}</p>
            @enderror
            <div class="form-group">
                <label for="exampleInputEmail1">English Description</label>
                <textarea name="en[description]" class="form-control"></textarea>
            </div>
            @error('en[description]')
                <p>{{ $message }}</p>
            @enderror
            <div class="form-group">
                <label for="exampleInputEmail1">image</label>
                <input type="file" name="image" class="form-control">
            </div>
            @error('image')
                <p>{{ $message }}</p>
            @enderror
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
