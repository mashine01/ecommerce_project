<!DOCTYPE html>
<html lang="en">

@include('front.layout.head')

<body>
    <div class="page-wrapper">
        @include('front.layout.header')
        <main class="main">
            <div class="intro-slider-container">
                <div class="owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl"
                    data-owl-options='{"nav": false}'>
                    @foreach ($banners->where('banner_type', 'intro')->sortBy('priority') as $banner)
                        <div class="intro-slide" style="background-image: url({{ $banner->banner_path }});">
                            <div class="container intro-content">
                                <h3 class="intro-subtitle">{{ $banner->banner_subtitle }}</h3>
                                <!-- End .h3 intro-subtitle -->
                                <h1 class="intro-title">{{ $banner->banner_title }}</h1><!-- End .intro-title -->

                                <a href="category.html" class="btn btn-primary">
                                    <span>Shop Now</span>
                                    <i class="icon-long-arrow-right"></i>
                                </a>
                            </div><!-- End .container intro-content -->
                        </div><!-- End .intro-slide -->
                    @endforeach
                </div><!-- End .owl-carousel owl-simple -->

                <span class="slider-loader text-white"></span><!-- End .slider-loader -->
            </div><!-- End .intro-slider-container -->

            <div class="brands-border owl-carousel owl-simple" data-toggle="owl"
                data-owl-options='{
                    "nav": false,
                    "dots": false,
                    "margin": 0,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":2
                        },
                        "420": {
                            "items":3
                        },
                        "600": {
                            "items":4
                        },
                        "900": {
                            "items":5
                        },
                        "1024": {
                            "items":6
                        },
                        "1360": {
                            "items":7
                        }
                    }
                }'>
                @foreach ($brands as $brand)
                    @if ($brand->show_in_page == true)
                        <a href="" class="brand">
                            <img src="{{ asset($brand->logo) }}" alt="{{ $brand->name }}">
                        </a>
                    @endif
                @endforeach
            </div><!-- End .owl-carousel -->

            <div class="mb-3 mb-lg-5"></div><!-- End .mb-3 mb-lg-5 -->

            <div class="banner-group">
                <div class="container">
                    <div class="row">
                        @foreach ($banners->where('banner_type', 'product') as $banner)
                            @if ($banner->priority == 1)
                                <div class="col-md-12 col-lg-5">
                                    <div class="banner banner-large banner-overlay banner-overlay-light">
                                        <a href="#">
                                            <img src="{{ $banner->banner_path }}" alt="Banner">
                                        </a>
                                        <div class="banner-content banner-content-top">
                                            <h4 class="banner-subtitle">{{ $banner->banner_subtitle }}</h4>
                                            <!-- End .banner-subtitle -->
                                            <h3 class="banner-title">{{ $banner->banner_title }}</h3>
                                            <!-- End .banner-title -->
                                            <div class="banner-text">{{ $banner->text }}</div><!-- End .banner-text -->
                                            <a href="#" class="btn btn-outline-gray banner-link">Shop Now<i
                                                    class="icon-long-arrow-right"></i></a>
                                        </div><!-- End .banner-content -->
                                    </div><!-- End .banner -->
                                </div><!-- End .col-lg-5 -->
                            @elseif($banner->priority == 2)
                                <div class="col-md-6 col-lg-3">
                                    <div class="banner banner-overlay">
                                        <a href="#">
                                            <img src="{{ $banner->banner_path }}" alt="Banner">
                                        </a>

                                        <div class="banner-content banner-content-bottom">
                                            <h4 class="banner-subtitle text-grey">{{ $banner->banner_subtitle }}</h4>
                                            <!-- End .banner-subtitle -->
                                            <h3 class="banner-title text-white">{{ $banner->banner_title }}</h3>
                                            <!-- End .banner-title -->
                                            <div class="banner-text text-white">{{ $banner->text }}</div>
                                            <!-- End .banner-text -->
                                            <a href="#" class="btn btn-outline-white banner-link">Discover Now<i
                                                    class="icon-long-arrow-right"></i></a>
                                        </div><!-- End .banner-content -->
                                    </div><!-- End .banner -->
                                </div><!-- End .col-lg-3 -->
                            @elseif($banner->priority == 3)
                                <div class="col-md-6 col-lg-4">
                                    <div class="banner banner-overlay">
                                        <a href="#">
                                            <img src="{{ $banner->banner_path }}" alt="Banner">
                                        </a>

                                        <div class="banner-content banner-content-top">
                                            <h4 class="banner-subtitle text-grey">{{ $banner->banner_subtitle }}</h4>
                                            <!-- End .banner-subtitle -->
                                            <h3 class="banner-title text-white">{{ $banner->banner_title }}</h3>
                                            <!-- End .banner-title -->
                                            <a href="#" class="btn btn-outline-white banner-link">Discover Now<i
                                                    class="icon-long-arrow-right"></i></a>
                                        </div><!-- End .banner-content -->
                                    </div><!-- End .banner -->
                                </div><!-- End .col-lg-4 -->
                            @elseif($banner->priority == 4)
                                <div class="col-md-6 col-lg-4">
                                    <div class="banner banner-overlay banner-overlay-light">
                                        <a href="#">
                                            <img src="{{ $banner->banner_path }}" alt="Banner">
                                        </a>

                                        <div class="banner-content banner-content-top">
                                            <h4 class="banner-subtitle">{{ $banner->banner_subtitle }}</h4>
                                            <!-- End .banner-subtitle -->
                                            <h3 class="banner-title">{{ $banner->banner_title }}</h3>
                                            <!-- End .banner-title -->
                                            <div class="banner-text">{{ $banner->text }}</div><!-- End .banner-text -->
                                            <a href="#" class="btn btn-outline-gray banner-link">Shop Now<i
                                                    class="icon-long-arrow-right"></i></a>
                                        </div><!-- End .banner-content -->
                                    </div><!-- End .banner -->
                                </div><!-- End .col-lg-4 -->
                            @endif
                        @endforeach
                    </div><!-- End .col-lg-4 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
    </div><!-- End .banner-group -->

    <div class="mb-3"></div><!-- End .mb-6 -->

    @if (count($trendings) > 0)
        <div class="container">
            <ul class="nav nav-pills nav-border-anim nav-big justify-content-center mb-3" role="tablist">
                @foreach ($trendingsCategories as $category)
                    @if (count($category->trendings->flatMap->products) > 0)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                                id="products-{{ strtolower($category->name) }}-link" data-toggle="tab"
                                href="#products-{{ strtolower($category->name) }}-tab" role="tab"
                                aria-controls="products-{{ strtolower($category->name) }}-tab"
                                aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $category->name }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div><!-- End .container -->

        <div class="container-fluid">
            <div class="tab-content tab-content-carousel">
                @foreach ($trendingsCategories as $category)
                    <div class="tab-pane p-0 fade {{ $loop->first ? 'show active' : '' }}"
                        id="products-{{ strtolower($category->name) }}-tab" role="tabpanel"
                        aria-labelledby="products-{{ strtolower($category->name) }}-link">
                        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow"
                            data-toggle="owl"
                            data-owl-options='{
                                "nav": false,
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1200": {
                                        "items":5
                                    },
                                    "1600": {
                                        "items":6,
                                        "nav": true
                                    }
                                }
                            }'>
                            @foreach ($category->trendings->flatMap->products as $product)
                                <div class="product product-11 text-center">
                                    <figure class="product-media">
                                        <a href="#">
                                            <img src="{{ $product->front_image }}" alt="{{ $product->name }}"
                                                class="product-image">
                                            {{-- <img src="{{ $product->hover_image }}" alt="{{ $product->name }}" class="product-image-hover"> --}}
                                        </a>

                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist"><span>add to
                                                    wishlist</span></a>
                                        </div><!-- End .product-action-vertical -->
                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <h3 class="product-title"><a href="#">{{ $product->name }}</a></h3>
                                        <!-- End .product-title -->
                                        <div class="product-price">
                                            PKR{{ $product->price }}
                                        </div><!-- End .product-price -->
                                    </div><!-- End .product-body -->
                                    <div class="product-action">
                                        <a href="#" class="btn-product btn-cart"><span>add to
                                                cart</span></a>
                                    </div><!-- End .product-action -->
                                </div><!-- End .product -->
                            @endforeach
                        </div><!-- End .owl-carousel -->
                    </div><!-- .End .tab-pane -->
                @endforeach
            </div><!-- End .tab-content -->
        </div><!-- End .container-fluid -->
    @endif

    <div class="mb-5"></div><!-- End .mb-5 -->

    <div class="mb-6"></div><!-- End .mb-6 -->

    @if (count($topSellings) > 0 && count($topSellings->where('product.category.show_on_menu', true)))
        <div class="container">
            <div class="heading heading-center mb-3">
                <h2 class="title">Top Selling Products</h2><!-- End .title -->
                <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="top-all-link" data-toggle="tab" href="#top-all-tab"
                            role="tab" aria-controls="top-all-tab" aria-selected="true">All</a>
                    </li>
                    @foreach ($topSellings->unique('product.category.name') as $topSelling)
                        @if ($topSelling->product->category->show_on_menu == true)
                            <li class="nav-item">
                                <a class="nav-link"
                                    id="top-{{ strtolower($topSelling->product->category->name) }}-link"
                                    data-toggle="tab"
                                    href="#top-{{ strtolower($topSelling->product->category->name) }}-tab"
                                    role="tab"
                                    aria-controls="top-{{ strtolower($topSelling->product->category->name) }}-tab"
                                    aria-selected="false">{{ $topSelling->product->category->name }}</a>
                            </li>
                        @endif
                    @endforeach

                </ul>
            </div><!-- End .heading -->

            <div class="tab-content">
                <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel"
                    aria-labelledby="top-all-link">
                    <div class="products">
                        <div class="row justify-content-center">
                            @foreach ($topSellings as $topSelling)
                                @if ($topSelling->product->category->show_on_menu == true)
                                    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                                        <div class="product product-11 text-center">
                                            <figure class="product-media">
                                                <a href="product.html">
                                                    <img src="{{ $topSelling->product->front_image }}"
                                                        alt="Product image" class="product-image">
                                                    {{-- <img src="{{ $topSelling->product->images['hover'] }}" alt="Product image" class="product-image-hover"> --}}
                                                </a>

                                                <div class="product-action-vertical">
                                                    <a href="#" class="btn-product-icon btn-wishlist "><span>add
                                                            to wishlist</span></a>
                                                </div><!-- End .product-action-vertical -->
                                            </figure><!-- End .product-media -->

                                            <div class="product-body">
                                                <div class="product-cat">
                                                    <a href="#">{{ $topSelling->product->category->name }}</a>
                                                </div><!-- End .product-cat -->
                                                <h3 class="product-title"><a
                                                        href="product.html">{{ $topSelling->product->name }}</a></h3>
                                                <!-- End .product-title -->
                                                <div class="product-price">
                                                    PKR{{ number_format($topSelling->product->price, 2) }}
                                                </div><!-- End .product-price -->
                                            </div><!-- End .product-body -->
                                            <div class="product-action">
                                                <a href="#" class="btn-product btn-cart"><span>add to
                                                        cart</span></a>
                                            </div><!-- End .product-action -->
                                        </div><!-- End .product -->
                                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
                                @endif
                            @endforeach

                        </div><!-- End .row -->
                    </div><!-- End .products -->
                </div><!-- .End .tab-pane -->
                @foreach ($topSellings as $topSelling)
                    <div class="tab-pane p-0 fade"
                        id="top-{{ strtolower($topSelling->product->category->name) }}-tab" role="tabpanel"
                        aria-labelledby="top-{{ strtolower($topSelling->product->category->name) }}-link">
                        <div class="products">
                            <div class="row justify-content-center">
                                @foreach ($topSelling->products as $product)
                                    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                                        <div class="product product-11 text-center">
                                            <figure class="product-media">
                                                @if ($product->is_on_sale)
                                                    <span class="product-label label-circle label-sale">Sale</span>
                                                @endif
                                                @if ($product->is_new)
                                                    <span class="product-label label-circle label-new">New</span>
                                                @endif
                                                <a href="#">
                                                    <img src="{{ asset($product->front_image) }}" alt="Product image"
                                                        class="product-image">
                                                    {{-- <img src="{{ asset($product->hover_image) }}" alt="Product image" class="product-image-hover"> --}}
                                                </a>

                                                <div class="product-action-vertical">
                                                    <a href="#" class="btn-product-icon btn-wishlist "><span>add
                                                            to wishlist</span></a>
                                                </div><!-- End .product-action-vertical -->
                                            </figure><!-- End .product-media -->

                                            <div class="product-body">
                                                <div class="product-cat">
                                                    <a href="#">{{ $product->category->name }}</a>
                                                </div><!-- End .product-cat -->
                                                <h3 class="product-title"><a href="#">{{ $product->name }}</a>
                                                </h3><!-- End .product-title -->
                                                <div class="product-price">
                                                    @if ($product->discount > 0)
                                                        <span
                                                            class="new-price">PKR{{ $product->discount_price }}</span>
                                                        <span class="old-price">PKR{{ $product->price }}</span>
                                                    @else
                                                        PKR{{ $product->price }}
                                                    @endif
                                                </div><!-- End .product-price -->
                                            </div><!-- End .product-body -->
                                            <div class="product-action">
                                                <a href="#" class="btn-product btn-cart"><span>add to
                                                        cart</span></a>
                                            </div><!-- End .product-action -->
                                        </div><!-- End .product -->
                                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
                                @endforeach
                            </div><!-- End .row -->
                        </div><!-- End .products -->
                    </div><!-- .End .tab-pane -->
                @endforeach

            </div><!-- End .tab-content -->
        </div><!-- End .container -->
        <div class="container">
            <hr class="mt-1 mb-6">
        </div><!-- End .container -->
    @endif

    <div class="blog-posts">
        <div class="container">
            <h2 class="title text-center">From Our Blog</h2><!-- End .title-lg text-center -->

            <div class="owl-carousel owl-simple carousel-with-shadow" data-toggle="owl"
                data-owl-options='{
                            "nav": false,
                            "dots": true,
                            "items": 3,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "600": {
                                    "items":2
                                },
                                "992": {
                                    "items":3
                                }
                            }
                        }'>
                <article class="entry entry-display">
                    <figure class="entry-media">
                        <a href="single.html">
                            <img src="/frontend/assets/images/demos/demo-2/blog/post-1.jpg" alt="image desc">
                        </a>
                    </figure><!-- End .entry-media -->

                    <div class="entry-body text-center">
                        <div class="entry-meta">
                            <a href="#">Nov 22, 2018</a>, 0 Comments
                        </div><!-- End .entry-meta -->

                        <h3 class="entry-title">
                            <a href="single.html">Sed adipiscing ornare.</a>
                        </h3><!-- End .entry-title -->

                        <div class="entry-content">
                            <a href="single.html" class="read-more">Continue Reading</a>
                        </div><!-- End .entry-content -->
                    </div><!-- End .entry-body -->
                </article><!-- End .entry -->

                <article class="entry entry-display">
                    <figure class="entry-media">
                        <a href="single.html">
                            <img src="/frontend/assets/images/demos/demo-2/blog/post-2.jpg" alt="image desc">
                        </a>
                    </figure><!-- End .entry-media -->

                    <div class="entry-body text-center">
                        <div class="entry-meta">
                            <a href="#">Dec 12, 2018</a>, 0 Comments
                        </div><!-- End .entry-meta -->

                        <h3 class="entry-title">
                            <a href="single.html">Fusce lacinia arcuet nulla.</a>
                        </h3><!-- End .entry-title -->

                        <div class="entry-content">
                            <a href="single.html" class="read-more">Continue Reading</a>
                        </div><!-- End .entry-content -->
                    </div><!-- End .entry-body -->
                </article><!-- End .entry -->

                <article class="entry entry-display">
                    <figure class="entry-media">
                        <a href="single.html">
                            <img src="/frontend/assets/images/demos/demo-2/blog/post-3.jpg" alt="image desc">
                        </a>
                    </figure><!-- End .entry-media -->

                    <div class="entry-body text-center">
                        <div class="entry-meta">
                            <a href="#">Dec 19, 2018</a>, 2 Comments
                        </div><!-- End .entry-meta -->

                        <h3 class="entry-title">
                            <a href="single.html">Quisque volutpat mattis eros.</a>
                        </h3><!-- End .entry-title -->

                        <div class="entry-content">
                            <a href="single.html" class="read-more">Continue Reading</a>
                        </div><!-- End .entry-content -->
                    </div><!-- End .entry-body -->
                </article><!-- End .entry -->
            </div><!-- End .owl-carousel -->

            <div class="more-container text-center mt-2">
                <a href={{ route('blog') }} class="btn btn-outline-darker btn-more"><span>View more articles</span><i
                        class="icon-long-arrow-right"></i></a>
            </div><!-- End .more-container -->
        </div><!-- End .container -->
    </div><!-- End .blog-posts -->
    </main><!-- End .main -->
    @include('front.layout.footer')
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    @include('front.layout.mobile')
    @include('front.layout.signin_register_modal')


    {{-- <div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="row no-gutters bg-white newsletter-popup-content">
                    <div class="col-xl-3-5col col-lg-7 banner-content-wrap">
                        <div class="banner-content text-center">
                            <img src="/frontend/assets/images/popup/newsletter/logo.png" class="logo" alt="logo" width="60" height="15">
                            <h2 class="banner-title">get <span>25<light>%</light></span> off</h2>
                            <p>Subscribe to the Molla eCommerce newsletter to receive timely updates from your favorite products.</p>
                            <form action="#">
                                <div class="input-group input-group-round">
                                    <input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><span>go</span></button>
                                    </div><!-- .End .input-group-append -->
                                </div><!-- .End .input-group -->
                            </form>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                <label class="custom-control-label" for="register-policy-2">Do not show this popup again</label>
                            </div><!-- End .custom-checkbox -->
                        </div>
                    </div>
                    <div class="col-xl-2-5col col-lg-5 ">
                        <img src="/frontend/assets/images/popup/newsletter/img-1.jpg" class="newsletter-img" alt="newsletter">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    @include('front.layout.script')
</body>

</html>
