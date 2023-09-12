@extends('admin.layouts.master');

@section('content')
  <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $posts->total }}</h3>
                <p>Total Posts Number</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-city"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $posts->activePosts }}</h3>
                <p>Active Posts</p>
              </div>
              <div class="icon">
                <i class="fas fa-flag"></i>
              </div>
            </div>
          </div>



          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $posts->inactivePosts }}</h3>
                <p>InActive Posts</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>

          </div>
          {{-- <div class="col-lg-3 col-6">
            <div class="small-box bg-light">
              <div class="inner">
                <h3>{{ $contacts->count() }}</h3>
                <p>Messages</p>
              </div>
              <div class="icon">
                <i class="nav-icon far fa-envelope"></i>
              </div>
              <a href="{{ route('contacts.index') }}" class="small-box-footer">More info
                <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div> --}}
      </div>
  </section>
@endsection
