@extends('dashboard.layouts.dashboard_view')

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
                            <h3 class="card-title">{{ $page_heading }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="/add-new-product" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Name</label>
                                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter Product Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Product Description</label>
                                    {{-- <input type="password" class="form-control" id="exampleInputPassword1"
                                        placeholder="Password">
                                    <textarea id="froala-editor" class="form-control" rows="7" placeholder="Description" name="product_description"></textarea> --}}
                                    <textarea id="summernote" name="product_description" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">File input</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="main_image"
                                                id="exampleInputFile" required>
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        {{-- <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Price</label>
                                    <input type="text" name="price" class="form-control" id="numbersWithCommas"
                                        placeholder="Enter Price of Product" onkeyup="numberWithCommas(this)" required>
                                </div>
                                {{-- <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="check_me_out">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div> --}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Status</label>
                                    {{-- <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" --}}
                                    placeholder="Enter Product Name">
                                    <select class="form-control" name="status" required="">
                                        <option value="0">Please select</option>
                                        <option value="1">Active</option>
                                        <option value="0">In Active</option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary"
                                    style="
                                        min-width: 150px;">Submit
                                </button>
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
        // function numberWithCommas(x){
        //     var value = x.value;
        //     var values =  value.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
        //     console.log(values);
        // }
        // $('#numberWithCommas').toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
    </script>
@endsection
