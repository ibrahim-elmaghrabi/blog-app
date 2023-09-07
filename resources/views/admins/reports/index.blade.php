@extends('front.layout.master')

@section('content')
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <!-- Nested row for non-featured blog posts-->
            <div class="row">
                <div class="col-lg-6">
                    <br>
                    <div class="card mb-4">
                        <h2># Reports</h2>
                        <a class="btn btn-primary" href="{{ route('admin_reports.create') }}">Add Report→</a>
                    </div>
                    @foreach ($reports as $report)
                        <div class="card mb-4">
                            <div class="card-body">
                                <h2 class="card-title h4">{{ $report->reason }}</h2>
                                <a class="btn btn-primary" href="{{ route('admin_reports.edit', $report->id) }}">edit →</a>
                                <form id="delete-post-form" method="post"
                                    action="{{ route('admin_reports.destroy', $report->id) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Delete the report ?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
