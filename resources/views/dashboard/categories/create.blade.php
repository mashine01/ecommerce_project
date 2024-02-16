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
                            <h3 class="card-title">{{ "Add" }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ isset($category) ? route('categories.update',['category'=>$category]) : route('categories.store') }}" method="POST" enctype="multipart/form-data">
                            @if (isset($category))
                                @method('PUT')
                            @else
                                @method('POST')
                            @endif
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Enter Category Name" value="{{isset($category) ? $category->name : ''}}" required>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="show_on_menu" class="form-check-input" id="show_on_menu" value="1" {{ isset($category) && $category->show_on_menu == 1 ? 'checked' : '' }}>
                                    <label for="show_on_menu" class="form-check-label">Show on Menu</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="show_on_side_menu" class="form-check-input" id="show_on_side_menu" value="1" {{ isset($category) && $category->show_on_side_menu == 1 ? 'checked' : '' }}>
                                    <label for="show_on_side_menu" class="form-check-label">Show on Side Menu</label>
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
