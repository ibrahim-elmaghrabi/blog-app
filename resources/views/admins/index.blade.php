@extends('front.layout.master')

@section('content')
<div class="row">
    <!-- Blog entries-->
    <div class="col-lg-8">
        <!-- Nested row for non-featured blog posts-->
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-6">
                    <h2># Admins</h2>
                    <a class="btn btn-primary" href="{{ route('admins.create') }}">Add Admin →</a>
                    </div>
                <!-- Blog post-->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">email</th>
                            <th scope="col">date</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($admins as $admin)
                      <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->created_at->format('d/m/Y') }}</td>
                        <td>
                            <form id="delete-post-form" method="post" action="{{ route('admins.destroy', ['admin' => $admin->id]) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                  </table>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
