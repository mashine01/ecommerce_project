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
                            <div class="row">
                                <div class="col"></div>
                                <div class="col-auto">
                                    <form id="deleteForm" method="POST" action="">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="event.preventDefault(); deleteSelected('{{ route('brands.delete', ['selectedIds' => '']) }}')" type="submit" class="btn btn-danger float-right">Delete Selected</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Select</th>
                                        <th>Brand Name</th>
                                        <th>Logo</th>
                                        <th>Show In Page</th>
                                        <th>Vendor Name</th>
                                        <th>Created By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="brands[]" value="{{ $brand->id }}">
                                            </td>
                                            <td>
                                                {{ $brand->name }}
                                            </td>
                                            <td>
                                                <img src="{{ asset($brand->logo) }}" alt="{{ $brand->name }}" width="100px"
                                                    height="100px">
                                            </td>
                                            <td>
                                                {{ $brand->show_in_page == 1 ? 'Yes' : 'No' }}
                                            </td>
                                            <td>
                                                {{ $brand->vendor->name }}
                                            <td>
                                                {{ $brand->created_by }}
                                            </td>
                                            {{-- <td class="text-center">
                                            @if ($list->status == 1)
                                                <span class="badge badge-success center" data-original-title="Active">Active</span>
                                            @else
                                                <span class="badge badge-danger center" data-original-title="Active">Inactive</span>
                                            @endif
                                        </td> --}}
                                            <td><a type="button"
                                                    href="{{ route('brands.edit', [$brand->id]) }}"
                                                    class="msg-pencil-icon tooltips" data-original-title="Edit">
                                                    <i class="fa fa-edit" aria-hidden="true"
                                                        style="font-size: 17px">
                                                    </i>
                                                </a>&nbsp;&nbsp;
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
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
    <script src="/assets/dashboard/js/crud_functions.js"></script>
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
    <script src="/assets/dashboard/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
@endsection
