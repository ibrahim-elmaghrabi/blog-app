@extends('admin.layouts.master')
@inject('user' , 'App\Models\User' )
@section('main-pageName') Users   @endsection
@section('pageName')  ADD  @endsection
@section('content')
<section class="content">
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add new User</h3>
              </div>
              <form name="add-blog-post-form" id="add-blog-post-form" method="POST"
              action="{{ route('admins.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="card-body">
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
</section>
@endsection
