@extends('admin.layouts.master')
@section('main-pageName')  Report  @endsection
@section('pageName')  Edit  @endsection
@section('content')
<section class="content">
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit<strong> {{ $report->reason }} </strong></h3>
              </div>
              <div>
              <form name="add-blog-post-form" id="add-blog-post-form" method="POST"
              action="{{ route('admin_reports.update', $report->id) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">ar reason</label>
                        <input type="text" value="{{ $report->{'reason:ar'} }}" name="ar[reason]" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">en reason</label>
                        <input type="text" value="{{ $report->{'reason:en'} }}" name="en[reason]" class="form-control">
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
