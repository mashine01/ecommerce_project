@extends('dashboard.layouts.admin_panel_view')

@section('content')

    <head>
        <link rel="stylesheet" href="/assets/dashboard/css/froala_editor.css">
        <link rel="stylesheet" href="/assets/dashboard/css/froala_style.css">
        <!-- summernote -->
        <link rel="stylesheet" href="/assets/dashboard/plugins/summernote/summernote-bs4.css">
        <!-- Google Font: Source Sans Pro -->
        {{-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> --}}
    </head>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ 'Add' }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('productVariants.update', ['variant' => $variant]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" name="quantity" class="form-control" id="quantity"
                                        placeholder="Enter Quantity" value="{{ $variant->quantity }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="upc">UPC</label>
                                    <input type="text" name="upc" class="form-control" id="upc"
                                        placeholder="Enter UPC" value="{{ $variant->upc }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="style_code">Style Code</label>
                                    <input type="text" name="style_code" class="form-control" id="style_code"
                                        placeholder="Enter Style Code" value="{{ $variant->style_code }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="size">Size</label>
                                    <input oninput="generateSku();" type="text" name="size" class="form-control" id="size"
                                        placeholder="Enter Size" value="{{ $variant->size }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="colour">Colour</label>
                                    <input oninput="generateSku();" type="text" name="colour" class="form-control" id="colour"
                                        placeholder="Enter Colour" value="{{ $variant->colour }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="sku">SKU</label>
                                    <input type="text" name="sku" class="form-control" id="sku"
                                        placeholder="Enter SKU" value="{{ $variant->sku }}" readonly required>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary" style="min-width: 150px;">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('js')
    <!-- bs-custom-file-input -->
    <script src="/assets/dashboard/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets/dashboard/dist/js/adminlte.min.js"></script>

    <script src="/assets/dashboard/js/froala_editor.min.js"></script>
    <!-- Summernote -->
    <script src="/assets/dashboard/plugins/summernote/summernote-bs4.min.js"></script>

    <script>


        // Generate style code based on brand and vendor_style_code
        function generateSku() {
            var vendor = {{ $variant->vendor_name }};
            var brand = {{ $variant->brand_name }};
            var vendor_style_code = {{ $variant->vendor_style_code}};
            var colour = document.getElementById('colour').value;
            var size = document.getElementById('size').value;

            var sku = vendor.substring(0, 2) + brand.substring(0, 2) + vendor_style_code.toUpperCase() + colour.toUpperCase() + size.toUpperCase();
            document.getElementById('sku').value = sku;
        }

        $('#message-group').fadeOut(10000);
        $(function() {
            bsCustomFileInput.init();
        });
        $(function() {
            // Summernote
            $('#summernote').summernote()

            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        });
    </script>
@endsection
