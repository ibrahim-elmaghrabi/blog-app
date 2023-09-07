@extends('front.layout.master')

@section('content')
    <div class="card-body">
        <form name="add-blog-post-form" id="add-blog-post-form" method="POST" action="{{ route('admins.store') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            @error('name')
                <p>{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            @error('email')
                <p>{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label for="exampleInputEmail1">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            @error('password')
                <p>{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label for="exampleInputEmail1">password Confirmation</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
            @error('passord')
                <p>{{ $message }}</p>
            @enderror
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
