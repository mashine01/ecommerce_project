@extends('dashboard.layouts.admin_panel_view')

@section('content')

    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
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
                        <form action="{{ route('trendings.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="name">Style Code</label>
                                <select multiple class="form-control text-primary border-primary" name="style_code[]"
                                    id="style_code">
                                    @foreach ($products as $product)
                                        <option value="{{ $product->style_code }}">{{ $product->style_code }}</option>
                                    @endforeach
                                </select>
                                <div class="mb-3"></div>
                                <select multiple class="form-control text-primary border-primary" name="trending_category[]"
                                    id="trending_category">
                                    @foreach ($trendingCategories as $trendingCategories)
                                        <option value="{{ $trendingCategories->id }}">{{ $trendingCategories->name }}
                                        </option>
                                    @endforeach
                                </select>
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
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#style_code').select2({
                placeholder: "Select Style Code",
                allowClear: true,
                tags: true,
            });
        });

        $(document).ready(function() {
            $('#trending_category').select2({
                placeholder: "Select Trending Category",
                allowClear: true,
                tags: true,
            });
        });
    </script>
@endsection
