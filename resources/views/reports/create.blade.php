@extends('front.layout.master')

@section('content')
    <div class="card-body">
        <form name="add-blog-post-form" id="add-blog-post-form" method="POST"
            action="{{ route('posts.reports.store', $post) }}">
            @csrf
            <div class="form-group">
                <div class="">
                    <h2># Report the post </h2>
                </div>
                <select class="form-control" name="report_id">
                    @foreach ($reports as $report)
                        <option value="{{ $report->id }}">{{ $report->reason }}</option>
                    @endforeach
                </select>
                <br>
                <button type="submit" class="btn btn-primary">ADD</button>
                <br>
        </form>
    </div>
@endsection
