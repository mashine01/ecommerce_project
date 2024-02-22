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
                            action="{{ isset($banner) ? route('banners.update', ['banner' => $banner]) : route('banners.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @if (isset($banner))
                                @method('PUT')
                            @else
                                @method('POST')
                            @endif
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Banner Type</label>
                                    <select class="form-control text-primary border-primary" name="banner_type"
                                        id="banner_type" onchange="populatePriority()">
                                        <option value="" disabled selected>Select Banner Type</option>
                                        <option value="intro"
                                            {{ isset($banner) && $banner->banner_type == 'intro' ? 'selected' : '' }}>
                                            Intro</option>
                                        <option value="product"
                                            {{ isset($banner) && $banner->banner_type == 'product' ? 'selected' : '' }}>
                                            Product</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Banner Title</label>
                                    <input type="text" name="banner_title" class="form-control" id="banner_title"
                                        placeholder="Enter Banner Title"
                                        value="{{ isset($banner) ? $banner->banner_title : '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Banner Subtitle</label>
                                    <input type="text" name="banner_subtitle" class="form-control" id="banner_subtitle"
                                        placeholder="Enter Banner Subtitle"
                                        value="{{ isset($banner) ? $banner->banner_subtitle : '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Banner Path</label>
                                    <input type="file" name="image" class="form-control" id="image"
                                        placeholder="Enter Banner Path"
                                        value="{{ isset($banner) ? $banner->banner_path : '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Priority</label>
                                    <select class="form-control text-primary border-primary" name="priority" id="priority">
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
        //To populate priority based on banner type
        function populatePriority() {
            var select = document.getElementById("priority");
            var banner_type = document.getElementById("banner_type").value;
            select.innerHTML = "";
            var previousPriority = {{ isset($banner) ? $banner->priority : '' }};
            if (banner_type == "intro") {
                for (var i = 1; i <= 10; i++) {
                    var option = "<option value='" + i + "'";
                    if (previousPriority == i) {
                        option += " selected";
                    }
                    option += ">" + i + "</option>";
                    select.innerHTML += option;
                }
            } else if (banner_type == "product") {
                for (var i = 1; i <= 3; i++) {
                    var option = "<option value='" + i + "'";
                    if (previousPriority == i) {
                        option += " selected";
                    }
                    option += ">" + i + "</option>";
                    select.innerHTML += option;
                }
            }
        }


        populatePriority(); // To populate priority on page load

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
