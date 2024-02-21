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
                                <div class="col">
                                    <div class="btn-group">
                                        <button class="btn btn-default buttons-excel buttons-html5" tabindex="0"
                                            aria-controls="example1" type="button">
                                            <span>Excel</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <form id="deleteForm" method="POST" action="">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            onclick="event.preventDefault(); deleteSelected('{{ route('productVariants.delete', ['selectedIds' => '']) }}')"
                                            type="submit" class="btn btn-danger float-right">Delete Selected</button>
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
                                        <th>Style Code</th>
                                        <th>Quantity</th>
                                        <th>Colour</th>
                                        <th>UPC</th>
                                        <th>SKU</th>
                                        <th>Created By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($variants as $product)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="productVariants[]" value="{{ $product->id }}">
                                            </td>
                                            <td>
                                                {{ $product->style_code }}
                                            </td>
                                            <td>
                                                {{ $product->quantity }}
                                            </td>
                                            <td>
                                                {{ $product->colour }}
                                            </td>
                                            <td>
                                                {{ $product->upc }}
                                            </td>
                                            <td>
                                                {{ $product->sku }}
                                            </td>
                                            <td>
                                                {{ $product->created_by }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="col-md-6">
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                                <!-- Pagination buttons will be here -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload/Download Excel File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Download</h5>
                            <form action="{{ route('productVariants.download') }}" method="GET" id="downloadForm">
                                @csrf
                                @method('GET')
                                <div class="btn-group-vertical">
                                    <button class="btn btn-primary" type="submit" name="download" value="WithData">Download
                                        with
                                        Data</button>
                                    <button class="btn btn-primary" type="submit" name="download"
                                        value="WithoutData">Download
                                        without Data</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <h5>Upload</h5>
                            <form action="{{ route('productVariants.upload') }}" method="POST" id="uploadForm" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <label for="excelFile">Select Excel File</label>
                                    <input type="file" class="form-control-file" id="excelFile" name="excelFile"
                                        accept=".xlsx, .xls">
                                </div>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/assets/dashboard/js/crud_functions.js"></script>
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
    <script src="/assets/admin_panel/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script>
        // Show modal when Excel button is clicked
        $('.buttons-excel').click(function() {
            $('#uploadModal').modal('show');
        });
    </script>
@endsection
