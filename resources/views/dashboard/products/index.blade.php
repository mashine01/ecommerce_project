@extends('dashboard.layouts.admin_panel_view')

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--    <title>AdminLTE 3 | DataTables</title> --}}

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/dashboard/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/assets/dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/dashboard/dist/css/adminlte.min.css">
</head>

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ 'Hello' }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Product Description</th>
                                        <th>Price</th>
                                        <th>Brand</th>
                                        <th>Vendor</th>
                                        <th>Category</th>
                                        <th>Vendor Style Code</th>
                                        <th>Style Code</th>
                                        <th>Created By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            {{-- <td><a href="{{$link}}/{{$list->slug}}" target="_blank">{{$list->product_name}}</a></td> --}}
                                            {{--                                        <td><?php // echo $list->product_description
                                            ?></td> --}}
                                            {{-- <td><a href="{{$link}}/{{$list->image}}" target="_blank" style="color: grey"> {{$link}}/{{$list->image}} </a></td> --}}
                                            {{--                                        <td class="text-center"><img src="/{{$list->image}}" onclick="window.open('/{{$list->image}}', '_blank');" width="90px" height="90px"></td> --}}
                                            <td>
                                                {{ $product->name }}
                                            </td>
                                            <td>
                                                {{ $product->description }}
                                            <td>
                                                {{ $product->price }}
                                            </td>
                                            <td>
                                                {{ $product->brand->name }}
                                            </td>
                                            <td>
                                                {{ $product->vendor->name }}
                                            </td>
                                            <td>
                                                {{ $product->category->name }}
                                            </td>
                                            <td>
                                                {{ $product->vendor_style_code }}
                                            </td>
                                            <td>
                                                {{ $product->style_code }}
                                            </td>
                                            <td>
                                                {{ $product->created_by }}
                                            </td>
                                            {{-- <td class="text-center">
                                            @if ($list->status == 1)
                                                <span class="badge badge-success center" data-original-title="Active">Active</span>
                                            @else
                                                <span class="badge badge-danger center" data-original-title="Active">Inactive</span>
                                            @endif
                                        </td> --}}
                                            <td><a type="button"
                                                    href="{{ URL::route('products.edit', [$product->id]) }}"
                                                    class="msg-pencil-icon tooltips" data-original-title="Edit"><i
                                                        class="fa fa-edit" aria-hidden="true"
                                                        style="font-size: 17px"></i></a>&nbsp;&nbsp;</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        {{--                                    <th>Product Description</th> --}}
                                        <th>Image</th>
                                        <th>Preview</th>
                                        <th>Status</th>
                                        <th>Action</th>
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
    <script src="/assets/dashboard/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/assets/dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/assets/dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/assets/dashboard/plugins/jszip/jszip.min.js"></script>
    <script src="/assets/dashboard/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="/assets/dashboard/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="/assets/dashboard/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/assets/dashboard/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    {{--    <script src="/assets/admin_panel/plugins/datatables-buttons/js/buttons.colVis.min.js"></script> --}}

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
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
