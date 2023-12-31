@extends('admin.layouts.master')
@push('css')
 <!-- DataTables -->
  <link rel="stylesheet" href="{{  asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{  asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{  asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
@section('main-pageName') Report  @endsection
@section('pageName') Manage @endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
           <div class="col-12">
                 <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DataTable of Reports</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped text-center">
                            <caption>DataTable of Reports</caption>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>reason</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as  $report)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $report->reason }}</td>
                                    <td>
                                        <a href="{{ route('admin_reports.edit', $report->id) }}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                         </a>
                                    </td>

                                    <td>
                                        <form method="POST" action="{{ route('admin_reports.destroy', $report->id) }}" >
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure?')" >
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
