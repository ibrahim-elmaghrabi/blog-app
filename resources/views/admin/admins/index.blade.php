@extends('admin.layouts.master')
@push('css')
 <!-- DataTables -->
  <link rel="stylesheet" href="{{  asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{  asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{  asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!---- Bootstap toggle ---->
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush
@section('main-pageName') users  @endsection
@section('pageName') Manage @endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
           <div class="col-12">
                 <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DataTable of users</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped text-center">
                          <caption>DataTable of user</caption>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        @foreach ($admin->roles as $role)
                                            <span class="btn btn-secondary btn-sm">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    {{-- <td>
                                        <a href="{{ route('admins.edit', $admin->id) }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </td> --}}
                                    <td>
                                        <form method="POST" action="{{ route('admins.destroy', $admin->id) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fa-solid fa-trash"></i>
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
</section>
@endsection
@push('scripts')
<!----- Bootstrap Toggle ---->
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="{{  asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{  asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{  asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{  asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{  asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{  asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{  asset('assets/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{  asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{  asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{  asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{  asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{  asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endpush
