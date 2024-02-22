  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="/dashboard" class="brand-link">
          <img src="/assets/dashboard/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
              class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light"><b>Admin Panel</b> Portal</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="/assets/dashboard/dist/img/admin_logo.jpg" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="/dashboard" class="d-block">{{ \Illuminate\Support\Facades\Auth::user()->name }}</a>
              </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                      aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item">
                      <a href="/dashboard" class="nav-link">
                          <i class="fas fa-home"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link">
                          <i class="fas fa-users"></i>
                          <p>
                              Vendors
                              <i class="right fas fa-arrow-alt-circle-up"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('vendors.create') }}" class="nav-link">
                                  <i class="fas fa-arrow-alt-circle-right"></i>
                                  <p>Add New Vendor</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('vendors') }}" class="nav-link">
                                  <i class="fas fa-arrow-alt-circle-right"></i>
                                  <p>List of Vendors</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link">
                          <i class="fas fa-tags"></i>
                          <p>
                              Brands
                              <i class="right fas fa-arrow-alt-circle-up"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('brands.create') }}" class="nav-link">
                                  <i class="fas fa-arrow-alt-circle-right"></i>
                                  <p>Add New Brand</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('brands') }}" class="nav-link">
                                  <i class="fas fa-arrow-alt-circle-right"></i>
                                  <p>List of Brands</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link">
                          <i class="fas fa-th-large"></i>
                          <p>
                              Categories
                              <i class="right fas fa-arrow-alt-circle-up"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('categories.create') }}" class="nav-link">
                                  <i class="fas fa-arrow-alt-circle-right"></i>
                                  <p>Add New Category</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('categories') }}" class="nav-link">
                                  <i class="fas fa-arrow-alt-circle-right"></i>
                                  <p>List of Categories</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link">
                          <i class="fas fa-th"></i>
                          <p>
                              Sub-Categories
                              <i class="right fas fa-arrow-alt-circle-up"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('subcategories.create') }}" class="nav-link">
                                  <i class="fas fa-arrow-alt-circle-right"></i>
                                  <p>Add New Sub-Category</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('subcategories') }}" class="nav-link">
                                  <i class="fas fa-arrow-alt-circle-right"></i>
                                  <p>List of Sub-Categories</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link">
                          <i class="fas fa-box"></i>
                          <p>
                              Products
                              <i class="right fas fa-arrow-alt-circle-up"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('products') }}" class="nav-link">
                                  <i class="fas fa-arrow-alt-circle-right"></i>
                                  <p>List of Products</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link">
                          <i class="fas fa-cubes"></i>
                          <p>
                              Product Variants
                              <i class="right fas fa-arrow-alt-circle-up"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('productVariants') }}" class="nav-link">
                                  <i class="fas fa-arrow-alt-circle-right"></i>
                                  <p>List of Product Variants</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link">
                          <i class="fas fa-star"></i>
                          <p>
                              Top Selling Products
                              <i class="right fas fa-arrow-alt-circle-up"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('topSelling') }}" class="nav-link">
                                  <i class="fas fa-arrow-alt-circle-right"></i>
                                  <p>List of Top Selling Products</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('topSelling.create') }}" class="nav-link">
                                  <i class="fas fa-arrow-alt-circle-right"></i>
                                  <p>Add New Top Selling Product</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link">
                          <i class="fas fa-chart-line"></i>
                          <p>
                              Trending Categories
                              <i class="right fas fa-arrow-alt-circle-up"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('trendingCategory.create') }}" class="nav-link">
                                  <i class="fas fa-arrow-alt-circle-right"></i>
                                  <p>Add New Trending Categories</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('trendingCategory') }}" class="nav-link">
                                  <i class="fas fa-arrow-alt-circle-right"></i>
                                  <p>List of Trending Categories</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link">
                          <i class="fas fa-fire"></i>
                          <p>
                              Trending Products
                              <i class="right fas fa-arrow-alt-circle-up"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('trendings.create') }}" class="nav-link">
                                  <i class="fas fa-arrow-alt-circle-right"></i>
                                  <p>Add New Trending Product</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('trendings') }}" class="nav-link">
                                  <i class="fas fa-arrow-alt-circle-right"></i>
                                  <p>List of Trending Products</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link">
                          <i class="fas fa-image"></i>
                          <p>
                              Banners
                              <i class="right fas fa-arrow-alt-circle-up"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('banners.create') }}" class="nav-link">
                                  <i class="fas fa-arrow-alt-circle-right"></i>
                                  <p>Add New Banners</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('banners') }}" class="nav-link">
                                  <i class="fas fa-arrow-alt-circle-right"></i>
                                  <p>List of Banners</p>
                              </a>
                          </li>
                      </ul>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
      var url = window.location;
      $('ul.nav a').filter(function() {
          if (this.href == url) {
              $(this).addClass('active').parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open');
              return true;
          }
          return false;
      });
  </script>
