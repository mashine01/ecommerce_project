<!DOCTYPE html>
<html lang="en">

@include ('front.layout.head')

<body>
    <div class="page-wrapper">
        @include ('front.layout.header')

        <main class="main">
            <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
                <div class="container">
                    <h1 class="page-title">{{ $category->name }}<span>Shop</span></h1>
                </div><!-- End .container -->
            </div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->
            <div class="page-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="toolbox">
                                <div class="toolbox-left">
                                    <div class="toolbox-info">
                                        Showing <span>{{ $products->count() }}</span>
                                        Products
                                    </div><!-- End .toolbox-info -->
                                </div><!-- End .toolbox-left -->

                                <div class="toolbox-right">
                                    <div class="toolbox-sort">
                                        <label for="sortby">Sort by:</label>
                                        <div class="select-custom">
                                            <select onchange="updateProducts();" name="sortby" id="sortby"
                                                class="form-control">
                                                <option value="popularity" selected="selected">Most Popular</option>
                                                <option value="rating">Most Rated</option>
                                            </select>
                                        </div>
                                    </div><!-- End .toolbox-sort -->
                                </div><!-- End .toolbox-right -->
                            </div><!-- End .toolbox -->

                            <div class="products mb-3">
                                <div class="row justify-content-center products_data_append">
                                    {{-- @foreach ($products as $product)
                                        <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                            <div class="product product-7 text-center">
                                                <figure class="product-media">
                                                    @if ($product->created_at->diffInDays() < 7)
                                                        <span class="product-label label-new">New</span>
                                                    @endif
                                                    <a
                                                        href="{{ route('product', ['product' => $product->slug, 'category' => $category->slug, 'subcategory' => $product->subcategory->slug]) }}">
                                                        <img src='{{ asset($product->front_image) }}'
                                                            class="product-image">
                                                    </a>
                                                    <div class="product-action-vertical">
                                                        <a href=""
                                                            class="btn-product-icon btn-wishlist btn-expandable"><span>add
                                                                to wishlist</span></a>
                                                        <a href="popup/quickView.html"
                                                            class="btn-product-icon btn-quickview"
                                                            title="Quick view"><span>Quick view</span></a>
                                                        <a href="" class="btn-product-icon btn-compare"
                                                            title="Compare"><span>Compare</span></a>
                                                    </div><!-- End .product-action-vertical -->

                                                    <div class="product-action">
                                                        <a href="" class="btn-product btn-cart"><span>add to
                                                                cart</span></a>
                                                    </div><!-- End .product-action -->
                                                </figure><!-- End .product-media -->

                                                <div class="product-body">
                                                    <div class="product-cat">
                                                        <a
                                                            href="">{{ $product->subcategory->category->name }}</a>
                                                    </div><!-- End .product-cat -->
                                                    <h3 class="product-title"><a
                                                            href="product.html">{{ $product->name }}</a></h3>
                                                    <!-- End .product-title -->
                                                    <div class="product-price">
                                                        PKR{{ $product->price }}
                                                    </div><!-- End .product-price -->
                                                    <div class="ratings-container">
                                                        <div class="ratings">
                                                            <div class="ratings-val" style="width: 0%;"></div>
                                                            <!-- End .ratings-val -->
                                                        </div><!-- End .ratings -->
                                                        <span class="ratings-text">( 0 Reviews )</span>
                                                    </div><!-- End .rating-container -->
                                                </div><!-- End .product-body -->
                                            </div><!-- End .product -->
                                        </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
                                    @endforeach --}}
                                </div><!-- End .row -->
                            </div><!-- End .products -->
                        </div><!-- End .col-lg-9 -->
                        <aside class="col-lg-3 order-lg-first">
                            <div class="sidebar sidebar-shop">
                                <div class="widget widget-clean">
                                    <label>Filters:</label>
                                    <a onclick="clearFilters();" href="" class="sidebar-filter-clear">Clean
                                        All</a>
                                </div><!-- End .widget widget-clean -->

                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title">
                                        <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true"
                                            aria-controls="widget-4">
                                            Brand
                                        </a>
                                    </h3><!-- End .widget-title -->

                                    <div class="collapse show" id="widget-4">
                                        <div class="widget-body">
                                            <div class="filter-items">
                                                @foreach ($brands as $brand)
                                                    <div class="filter-item">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="brand-{{ $brand->id }}" name="brand">
                                                            <label class="custom-control-label"
                                                                for="brand-{{ $brand->id }}">{{ $brand->name }}</label>
                                                        </div><!-- End .custom-radio -->
                                                    </div><!-- End .filter-item -->
                                                @endforeach
                                            </div><!-- End .filter-items -->
                                        </div><!-- End .widget-body -->
                                    </div><!-- End .collapse -->
                                </div><!-- End .widget -->

                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title">
                                        <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true"
                                            aria-controls="widget-2">
                                            Size
                                        </a>
                                    </h3><!-- End .widget-title -->

                                    <div class="collapse show" id="widget-2">
                                        <div class="widget-body">
                                            <div class="filter-items">
                                                @foreach ($sizes as $size)
                                                    <div class="filter-item">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="size-{{ $size }}">
                                                            <label class="custom-control-label"
                                                                for="size-{{ $size }}">{{ $size }}</label>
                                                        </div><!-- End .custom-checkbox -->
                                                    </div><!-- End .filter-item -->
                                                @endforeach
                                            </div><!-- End .filter-items -->
                                        </div><!-- End .widget-body -->
                                    </div><!-- End .collapse -->
                                </div><!-- End .widget -->

                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title">
                                        <a data-toggle="collapse" href="#widget-4" role="button"
                                            aria-expanded="true" aria-controls="widget-4">
                                            Colours
                                        </a>
                                    </h3><!-- End .widget-title -->

                                    <div class="collapse show" id="widget-4">
                                        <div class="widget-body">
                                            <div class="filter-items">

                                                @foreach ($colours as $colour)
                                                    <div class="filter-item">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="colour-{{ $colour }}">
                                                            <label class="custom-control-label"
                                                                for="colour-{{ $colour }}">{{ $colour }}</label>
                                                        </div><!-- End .custom-checkbox -->
                                                    </div><!-- End .filter-item -->
                                                @endforeach

                                                {{-- <div class="filter-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="brand-3">
                                                        <label class="custom-control-label"
                                                            for="brand-3">Geox</label>
                                                    </div><!-- End .custom-checkbox -->
                                                </div><!-- End .filter-item --> --}}

                                            </div><!-- End .filter-items -->
                                        </div><!-- End .widget-body -->
                                    </div><!-- End .collapse -->
                                </div><!-- End .widget -->

                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title">
                                        <a data-toggle="collapse" href="#widget-4" role="button"
                                            aria-expanded="true" aria-controls="widget-4">
                                            Price
                                        </a>
                                    </h3><!-- End .widget-title -->

                                    <div class="collapse show" id="widget-4">
                                        <div class="widget-body">
                                            <div class="filter-items">
                                                @foreach ($priceRanges as $range)
                                                    <div class="filter-item">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="price-{{ $range['min'] }}, {{ $range['max'] }}">
                                                            <label class="custom-control-label"
                                                                for="price-{{ $range['min'] }}, {{ $range['max'] }}">
                                                                PKR{{ intval($range['min']) }} -
                                                                PKR{{ intval($range['max']) }}
                                                            </label>
                                                        </div><!-- End .custom-checkbox -->
                                                    </div><!-- End .filter-item -->
                                                @endforeach
                                            </div><!-- End .filter-items -->
                                        </div><!-- End .widget-body -->
                                    </div><!-- End .collapse -->
                                </div><!-- End .widget -->
                            </div><!-- End .sidebar sidebar-shop -->
                        </aside><!-- End .col-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->

        @include ('front.layout.footer')
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    @include ('front.layout.mobile')
</body>

</html>

<!-- Plugins JS File -->
{{-- <script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.hoverIntent.min.js"></script>
<script src="assets/js/jquery.waypoints.min.js"></script>
<script src="assets/js/superfish.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/wNumb.js"></script>
<script src="assets/js/bootstrap-input-spinner.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/nouislider.min.js"></script> --}}
<!-- Main JS File -->
<script src="assets/js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(".filter-item input[type='checkbox']").change(function() {
            updateProducts();
        });
    })

    function updateProducts() {
        var brands = [];
        var prices = [];
        var sizes = [];
        var colours = [];
        var sortBy = $('#sortby').val();

        $(".filter-item input[type='checkbox']").each(function() {
            if ($(this).is(':checked')) {
                var id = $(this).attr('id');
                if (id.startsWith('brand-')) {
                    brands.push(id.split('-')[1]); // Extract only the number
                }

                if (id.startsWith('price-')) {
                    prices.push([id.split('-')[1]]); // Extract only the number
                }

                if (id.startsWith('size-')) {
                    sizes.push(id.split('-')[1]); // Extract only the number
                }

                if (id.startsWith('colour-')) {
                    colours.push(id.split('-')[1]); // Extract only the number
                }
            }
        });

        // AJAX request
        $.ajax({
            url: "{{ route('category', ['category' => $category->slug]) }}",
            type: 'GET',
            dataType: 'json',
            data: {
                brands: brands,
                prices: prices,
                sizes: sizes,
                colours: colours,
                sortBy: sortBy
            },

            success: function(brands) {
                var products = brands.products;
                $('.products_data_append').empty();
                $('.toolbox-info span').text(products.length + ' Products');
                products.forEach(function(product) {
                    var productRoute =
                        "{{ route('product', ['product' => ':product', 'category' => ':category', 'subcategory' => ':subcategory']) }}";
                    productRoute = productRoute
                        .replace(':product', product.slug)
                        .replace(':category', product.subcategory.category.slug)
                        .replace(':subcategory', product.subcategory.slug);
                    var differenceInMilliseconds = Date.now() - new Date(product.created_at)
                        .getTime();
                    var newLabel = differenceInMilliseconds < 7 * 24 * 60 * 60 * 1000 ?
                        '<span class="product-label label-new">New</span>' : '';
                    $('.products_data_append').append(
                        `<div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                            <div class="product product-7 text-center">
                                                <figure class="product-media">
                                                    ${newLabel}
                                                    <a href="${productRoute}">
                                                        <img src='${product.front_image}' class="product-image">
                                                    </a>

                                                    <div class="product-action-vertical">
                                                        <a href=""
                                                            class="btn-product-icon btn-wishlist btn-expandable"><span>add
                                                                to wishlist</span></a>
                                                        <a href="popup/quickView.html"
                                                            class="btn-product-icon btn-quickview"
                                                            title="Quick view"><span>Quick view</span></a>
                                                        <a href="" class="btn-product-icon btn-compare"
                                                            title="Compare"><span>Compare</span></a>
                                                    </div><!-- End .product-action-vertical -->

                                                    <div class="product-action">
                                                        <a href="" class="btn-product btn-cart"><span>add to
                                                                cart</span></a>
                                                    </div><!-- End .product-action -->
                                                </figure><!-- End .product-media -->

                                                <div class="product-body">
                                                    <div class="product-cat">
                                                        <a
                                                            href="">${product.subcategory.category.name}</a>
                                                    </div><!-- End .product-cat -->
                                                    <h3 class="product-title"><a
                                                            href="product.html">${product.name}</a></h3>
                                                    <!-- End .product-title -->
                                                    <div class="product-price">
                                                        PKR${product.price}
                                                    </div><!-- End .product-price -->
                                                    <div class="ratings-container">
                                                        <div class="ratings">
                                                            <div class="ratings-val" style="width: 0%;"></div>
                                                            <!-- End .ratings-val -->
                                                        </div><!-- End .ratings -->
                                                        <span class="ratings-text">( 0 Reviews )</span>
                                                    </div><!-- End .rating-container -->
                                                </div><!-- End .product-body -->
                                            </div><!-- End .product -->
                                        </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->`
                    );
                });
            },


            error: function(xhr, status, error) {
                var errorMessage;
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                } else {
                    errorMessage =
                        error; // If responseJSON or message is not available, fallback to the error parameter
                }
                console.error(errorMessage); // Log the error message
            }
        });
    }

    updateProducts();
    function clearFilters() {
        $(".filter-item input[type='checkbox']").prop('checked', false);
        updateProducts();
    }
</script>
