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
                        <form action="{{ route('products.update', ['product' => $product]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Enter Category Name" value="{{ $product->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" name="description" value="{{ $product->description }}"
                                        class="form-control" id="description" placeholder="Enter Description" required>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active"
                                        {{ $product->is_active ? 'checked' : '' }}>
                                    <label class="form-check" for="is_active">Is Active</label>

                                </div>
                                <div class="form-group">
                                    <label for="vendor">Vendor</label>
                                    <select onchange="populateBrandOptions()"
                                        class="form-control text-primary border-primary" name="vendor_id" id="vendor_id">
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->id }}"
                                                {{ $product->vendor_id == $vendor->id ? 'selected' : '' }}>
                                                {{ $vendor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Brand Name</label><br>
                                    <select onchange="generateStyleCode();" class="form-control text-primary border-primary"
                                        name="brand_id" id="brand_id">
                                        @foreach ($brands as $brand)
                                            @if ($brand->vendor_id == $product->vendor_id)
                                                <!-- Check if the brand belongs to the selected vendor -->
                                                <option value="{{ $brand->id }}"
                                                    {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->name }}</option>
                                            @endif
                                        @endforeach
                                        <!-- Brands will be populated dynamically based on the selected vendor -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select onchange="populateSubCategoryOptions()" class="form-control text-primary border-primary" name="category_id"
                                        id="category_id">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                <!-- Check if the category is the selected category -->
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sub_category">Sub Category</label>
                                    <select class="form-control text-primary border-primary" name="sub_category_id"
                                        id="sub_category_id">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" class="form-control" id="price"
                                        placeholder="Enter Price" value="{{ $product->price }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="discount">Discount</label>
                                    <input type="number" step="0.01" oninput="calculateDiscountPrice();" name="discount"
                                        class="form-control" id="discount" placeholder="Enter Discount"
                                        value="{{ $product->discount }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="discount_price">Discount Price</label>
                                    <input type="number" oninput="calculateDiscountPercentage()" name="discount_price"
                                        class="form-control" id="discount_price" placeholder="Enter Discount Price"
                                        value="{{ $product->discount_price }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="vendor_style_code">Vendor Style Code</label>
                                    <input type="text" name="vendor_style_code" class="form-control"
                                        id="vendor_style_code" placeholder="Enter Vendor Style Code"
                                        value="{{ $product->vendor_style_code }}" oninput="generateStyleCode();" required>
                                </div>
                                <div class="form-group">
                                    <label for="style_code">Style Code</label>
                                    <input type="text" name="style_code" class="form-control" id="style_code"
                                        placeholder="Enter Style Code" value="{{ $product->style_code }}" readonly
                                        required>
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
    <script>
        // Populate brand options based on selected vendor
        function populateBrandOptions() {
            var brandsByVendor = @json($brandsByVendor); // Get the brands by vendor from the controller
            var vendorId = document.getElementById('vendor_id').value;
            var brandDropdown = document.getElementById('brand_id');
            brandDropdown.innerHTML = '';
            var brands = brandsByVendor[vendorId];
            if (brands && Object.keys(brands).length > 0) {
                Object.keys(brands).forEach(function(brand) {
                    var option = document.createElement('option')
                    option.textContent = brands[brand]
                    option.value = brand
                    brandDropdown.appendChild(option)
                    generateStyleCode(); // Generate style code once brands are populated
                });
            } else {
                var defaultOption = document.createElement('option');
                defaultOption.textContent = 'No Brands available';
                defaultOption.value = '';
                brandDropdown.appendChild(defaultOption);
            }
        }
        populateBrandOptions()

        function populateSubCategoryOptions() {
            var subCategoriesByCategory = @json($subCategoriesByCategory);
            var categoryId = document.getElementById('category_id').value;
            var subCategoryDropdown = document.getElementById('sub_category_id');
            subCategoryDropdown.innerHTML = '';
            var subCategories = subCategoriesByCategory[categoryId];
            if (subCategories && Object.keys(subCategories).length > 0) {
                Object.keys(subCategories).forEach(function(subCategory) {
                    var option = document.createElement('option')
                    option.textContent = subCategories[subCategory]
                    option.value = subCategory
                    subCategoryDropdown.appendChild(option)
                });
            } else {
                var defaultOption = document.createElement('option');
                defaultOption.textContent = 'No Sub Categories available';
                defaultOption.value = '';
                subCategoryDropdown.appendChild(defaultOption);
            }
        }
        populateSubCategoryOptions()

        // Generate style code based on brand and vendor_style_code
        function generateStyleCode() {
            var brandName = (document.querySelector('[name="brand_id"] option:checked').text).toUpperCase();
            var vendorStyleCode = (document.getElementById('vendor_style_code').value).toUpperCase();
            var styleCode = brandName.slice(0, 2) + '-' + vendorStyleCode;
            document.getElementById('style_code').value = styleCode; // Set the style code
        }
        generateStyleCode()

        // Calculate discount price based on price and discount
        function calculateDiscountPrice() {
            var price = document.getElementById('price').value;
            var discount = document.getElementById('discount').value;
            var discount = (((price - discountPrice) / price) * 100).toFixed(2);
            document.getElementById('discount_price').value = discountPrice;
        }

        // Calculate discount percentage based on price and discount price
        function calculateDiscountPercentage() {
            var price = document.getElementById('price').value;
            var discountPrice = document.getElementById('discount_price').value;
            var discount = (((price - discountPrice) / price) * 100).toFixed(2);
            document.getElementById('discount').value = discount;
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
    <!-- bs-custom-file-input -->
    <script src="/assets/dashboard/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets/dashboard/dist/js/adminlte.min.js"></script>

    <script src="/assets/dashboard/js/froala_editor.min.js"></script>
    <!-- Summernote -->
    <script src="/assets/dashboard/plugins/summernote/summernote-bs4.min.js"></script>
@endsection
