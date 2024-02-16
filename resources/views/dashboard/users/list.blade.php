@extends('admin_panel.layouts.admin_panel_view')

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
{{--    <title>AdminLTE 3 | DataTables</title>--}}

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/admin_panel/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/assets/admin_panel/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/admin_panel/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/admin_panel/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/admin_panel/dist/css/adminlte.min.css">
</head>

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{$page_heading}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Active</th>
                                    <th>Create Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($listUser as $list)
                                    <tr>
                                        <td>{{$list->id}}</td>
                                        <td>{{$list->name}}</td>
                                        <td>{{$list->email}}</td>
                                        <td> {{$list->phone}}</td>
                                        <td class="text-center">
                                            @if($list->active == 1)
                                                <span class="badge badge-success center" data-original-title="Active">Active</span>
                                            @else
                                                <span class="badge badge-danger center" data-original-title="Inactive">Inactive</span>
                                            @endif
                                        </td>
                                        <td><?php echo date('j F Y', strtotime($list->created_at)); ?></td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Active</th>
                                    <th>Create Date</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection


@section('js')
    <!-- DataTables  & Plugins -->
    <script src="/assets/admin_panel/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/admin_panel/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/admin_panel/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/admin_panel/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/assets/admin_panel/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/assets/admin_panel/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/assets/admin_panel/plugins/jszip/jszip.min.js"></script>
    <script src="/assets/admin_panel/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="/assets/admin_panel/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="/assets/admin_panel/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/assets/admin_panel/plugins/datatables-buttons/js/buttons.print.min.js"></script>
{{--    <script src="/assets/admin_panel/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>--}}

    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
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

@endsection
