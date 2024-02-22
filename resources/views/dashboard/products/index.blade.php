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
                                            onclick="event.preventDefault(); deleteSelected('{{ route('products.delete', ['selectedIds' => '']) }}')"
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
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Product Description</th>
                                        <th>Status</th>
                                        <th>Price</th>
                                        <th>Discount Price</th>
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
                                            <td>
                                                <input type="checkbox" name="products[]" value="{{ $product->id }}">
                                            </td>
                                            <td>
                                                <img src="{{ asset($product->front_image) }}" alt="Front Image"
                                                    style="width: 50px">
                                                <img src="{{ asset($product->back_image) }}" alt="Back Image"
                                                    style="width: 50px">
                                                <img src="{{ asset($product->left_image) }}" alt="Left Image"
                                                    style="width: 50px">
                                                <img src="{{ asset($product->right_image) }}" alt="Right Image"
                                                    style="width: 50px">
                                                <button type="button" onclick="openAddImageModal({{ $product->id }})"
                                                    class="msg-pencil-icon tooltips" data-original-title="Edit">
                                                    <i class="fa fa-edit">
                                                    </i>
                                                </button>
                                            </td>
                                            <td>
                                                {{ $product->name }}
                                            </td>
                                            <td>
                                                {{ $product->description }}
                                            </td>
                                            <td>
                                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                                            <td>
                                                {{ $product->price }}
                                            </td>
                                            <td>
                                                {{ $product->discount_price }}
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
                                            <td><a type="button" href="{{ route('products.edit', [$product->id]) }}"
                                                    class="msg-pencil-icon tooltips" data-original-title="Edit">
                                                    <i class="fa fa-edit" aria-hidden="true" style="font-size: 17px">
                                                    </i>
                                                </a>&nbsp;&nbsp;
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
                            <h5>Download Options</h5>
                            <form action="{{ route('products.download') }}" method="GET">
                                @csrf
                                @method('GET')
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="download" id="withData"
                                        value="WithData" checked>
                                    <label class="form-check-label" for="withData">
                                        Download with Data
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="download"
                                        id="withoutData" value="WithoutData">
                                    <label class="form-check-label" for="withoutData">
                                        Download without Data
                                    </label>
                                </div>
                                <button class="btn btn-primary mt-3" type="submit">Download</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <h5>Upload</h5>
                            <form action="{{ route('products.upload') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
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

    <div class="modal fade" id="addImageModal" tabindex="-1" role="dialog" aria-labelledby="addImageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addImageModalLabel">Add/Edit Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('products.addImage') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" id="product_id">
                        <div class="form-group">
                            <label for="front_image">Front Image</label>
                            <input type="file" class="form-control-file" id="front_image" name="front_image"
                                accept="image/*" required>

                            <label for="back_image">Back Image</label>
                            <input type="file" class="form-control-file" id="back_image" name="back_image"
                                accept="image/*" required>

                            <label for="side1_image">Left Image</label>
                            <input type="file" class="form-control-file" id="side1_image" name="left_image"
                                accept="image/*" required>

                            <label for="side2_image">Right Image</label>
                            <input type="file" class="form-control-file" id="side2_image" name="right_image"
                                accept="image/*" required>

                        </div>
                        <button type="submit" class="btn btn-primary">Upload Images</button>
                    </form>
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

        function openAddImageModal(productId) {
            document.getElementById('product_id').value = productId;
            $('#addImageModal').modal('show');
        }
    </script>
@endsection
