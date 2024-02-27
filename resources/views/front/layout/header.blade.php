<header class="header header-2 header-intro-clearance">
    @include('front.layout.signin_register_modal')
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <p>Special collection already available.</p><a href="">&nbsp;Read more ...</a>
            </div><!-- End .header-left -->

            <div class="header-right">

                <ul class="top-menu">
                    <li>
                        <a href="">Links</a>
                        <ul>
                            <li>
                                <div class="header-dropdown">
                                    <a href="">USD</a>
                                    <div class="header-menu">
                                        <ul>
                                            <li><a href="">Eur</a></li>
                                            <li><a href="">Usd</a></li>
                                        </ul>
                                    </div><!-- End .header-menu -->
                                </div>
                            </li>
                            <li>
                                <div class="header-dropdown">
                                    <a href="">English</a>
                                    <div class="header-menu">
                                        <ul>
                                            <li><a href="">English</a></li>
                                            <li><a href="">French</a></li>
                                            <li><a href="">Spanish</a></li>
                                        </ul>
                                    </div><!-- End .header-menu -->
                                </div>
                            </li>
                            @if (!Auth::check())
                                <li><a href="#" data-toggle="modal" data-target="#signin-modal">Sign in / Sign up</a></li>
                            @else
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href=""
                                            onclick="event.preventDefault(); this.closest('form').submit();"
                                            class="logout-link">Logout</a>
                                    </form>
                                </li>
                            @endif
                            @include('front.layout.signin_register_modal')
                        </ul>
                    </li>
                </ul><!-- End .top-menu -->
            </div><!-- End .header-right -->

        </div><!-- End .container -->
    </div><!-- End .header-top -->

    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>

                <a href="{{ route('index') }}" class="logo">
                    <img src="/frontend/assets/images/demos/demo-2/logo.png" alt="Molla Logo" width="105"
                        height="25">
                </a>
            </div><!-- End .header-left -->

            <div class="header-center">
                <div
                    class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">
                    <a href="" class="search-toggle" role="button"><i class="icon-search"></i></a>
                    <form action="#" method="get">
                        <div class="header-search-wrapper search-wrapper-wide">
                            <label for="q" class="sr-only">Search</label>
                            <input type="search" class="form-control" name="q" id="q"
                                placeholder="Search product ..." required>
                            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div><!-- End .header-search -->
            </div>
            <div class="header-right">
                <div class="account">
                    @if (Auth()->check())
                        <a href="{{ route('account') }}" title="My account">
                            <div class="icon">
                                <i class="icon-user"></i>
                            </div>
                            <p>Account</p>
                        </a>
                    @endif
                </div><!-- End .compare-dropdown -->

                <div class="wishlist">
                    <a href="wishlist.html" title="Wishlist">
                        <div class="icon">
                            <i class="icon-heart-o"></i>
                            <span class="wishlist-count badge">3</span>
                        </div>
                        <p>Wishlist</p>
                    </a>
                </div><!-- End .compare-dropdown -->

                <div class="dropdown cart-dropdown">
                    <a href="" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" data-display="static">
                        <div class="icon">
                            <i class="icon-shopping-cart"></i>
                            <span class="cart-count">2</span>
                        </div>
                        <p>Cart</p>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-cart-products">
                            <div class="product">
                                <div class="product-cart-details">
                                    <h4 class="product-title">
                                        <a href="product.html">Beige knitted elastic runner shoes</a>
                                    </h4>

                                    <span class="cart-product-info">
                                        <span class="cart-product-qty">1</span>
                                        x $84.00
                                    </span>
                                </div><!-- End .product-cart-details -->

                                <figure class="product-image-container">
                                    <a href="product.html" class="product-image">
                                        <img src="/frontend/assets/images/products/cart/product-1.jpg" alt="product">
                                    </a>
                                </figure>
                                <a href="" class="btn-remove" title="Remove Product"><i
                                        class="icon-close"></i></a>
                            </div><!-- End .product -->

                            <div class="product">
                                <div class="product-cart-details">
                                    <h4 class="product-title">
                                        <a href="product.html">Blue utility pinafore denim dress</a>
                                    </h4>

                                    <span class="cart-product-info">
                                        <span class="cart-product-qty">1</span>
                                        x $76.00
                                    </span>
                                </div><!-- End .product-cart-details -->

                                <figure class="product-image-container">
                                    <a href="product.html" class="product-image">
                                        <img src="/frontend/assets/images/products/cart/product-2.jpg" alt="product">
                                    </a>
                                </figure>
                                <a href="" class="btn-remove" title="Remove Product"><i
                                        class="icon-close"></i></a>
                            </div><!-- End .product -->
                        </div><!-- End .cart-product -->

                        <div class="dropdown-cart-total">
                            <span>Total</span>

                            <span class="cart-total-price">$160.00</span>
                        </div><!-- End .dropdown-cart-total -->

                        <div class="dropdown-cart-action">
                            <a href="cart.html" class="btn btn-primary">View Cart</a>
                            <a href="checkout.html" class="btn btn-outline-primary-2"><span>Checkout</span><i
                                    class="icon-long-arrow-right"></i></a>
                        </div><!-- End .dropdown-cart-total -->
                    </div><!-- End .dropdown-menu -->
                </div><!-- End .cart-dropdown -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->

    <div class="header-bottom sticky-header">
        <div class="container">
            <div class="header-left">
                <div class="dropdown category-dropdown">
                    <a href="" class="dropdown-toggle" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" data-display="static" title="Browse Categories">
                        Browse Categories
                    </a>

                    <div class="dropdown-menu">
                        <nav class="side-nav">
                            <ul class="menu-vertical sf-arrows">
                                @foreach ($categories as $category)
                                    @if ($category->show_on_side_menu == true)
                                        <li>
                                            <a
                                                href="{{ route('category', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul><!-- End .menu-vertical -->
                        </nav><!-- End .side-nav -->
                    </div><!-- End .dropdown-menu -->
                </div><!-- End .category-dropdown -->
            </div><!-- End .header-left -->

            <div class="header-center">
                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        @foreach ($categories as $category)
                            @if ($category->show_on_menu == true)
                                <li>
                                    <a href="category.html" class="sf-with-ul">{{ $category->name }}</a>
                                    <div class="megamenu megamenu-md">
                                        <div class="row no-gutters">
                                            <div class="col-md-8">
                                                <div class="menu-col">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <ul>
                                                                @foreach ($subCategories->where('category_id', $category->id) as $subCategory)
                                                                    <li><a
                                                                            href="{{ route('subcategory', ['category' => $category->slug, 'subcategory' => $subCategory->slug]) }}">{{ $subCategory->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div><!-- End .col-md-6 -->
                                                    </div><!-- End .row -->
                                                </div><!-- End .menu-col -->
                                            </div><!-- End .col-md-8 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .megamenu megamenu-md -->
                                </li>
                            @endif
                        @endforeach
                    </ul><!-- End .menu -->
                </nav><!-- End .main-nav -->
            </div><!-- End .header-center -->

            <div class="header-right">
                <i class="la la-lightbulb-o"></i>
                <p>Clearance<span class="highlight">&nbsp;Up to 30% Off</span></p>
            </div>
        </div><!-- End .container -->
    </div><!-- End .header-bottom -->
</header><!-- End .header -->
