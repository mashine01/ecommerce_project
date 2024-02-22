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
                        <form
                            action="{{ isset($brand) ? route('brands.update', ['brand' => $brand]) : route('brands.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @if (isset($brand))
                                @method('PUT')
                            @else
                                @method('POST')
                            @endif
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Enter Brand Name" value="{{ isset($brand) ? $brand->name : '' }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <div class="custom-file">
                                            height="100px">
                                        <input type="file" name="logo" class="custom-file-input" id="logo"
                                            {{ isset($brand) ? '' : 'required' }}>
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                    @if (isset($brand))
                                        <img src="{{ asset($brand->logo) }}" style="border-radius: 5px" alt="Brand Image"
                                            width="100px">
                                    @endif
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="show_in_page" class="form-check-input" id="show_in_page"
                                        {{ isset($brand) && $brand->show_in_page == 1 ? 'checked' : '' }}>
                                    <label class="form-check" for="show_in_page">Show In Page</label>
                                </div>
                                <div class="form-group">
                                    <label for="vendor_id">Vendor</label>
                                    <select name="vendor_id" class="form-control" id="vendor_id" required>
                                        <option value="">Select Vendor</option>
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->id }}"
                                                {{ isset($brand) && $brand->vendor_id == $vendor->id ? 'selected' : '' }}>
                                                {{ $vendor->name }}</option>
                                        @endforeach
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
