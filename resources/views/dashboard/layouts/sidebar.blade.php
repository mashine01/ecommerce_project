  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
      <img src="/assets/dashboard/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><b>Admin Panel</b> Portal</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
        <?php
        if(\Illuminate\Support\Facades\Auth::user() == null || \Illuminate\Support\Facades\Auth::user() == '') {
            return \Illuminate\Support\Facades\Redirect::route('login');
        }
        ?>
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/assets/dashboard/dist/img/admin_logo.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="/dashboard" class="d-block">{{\Illuminate\Support\Facades\Auth::user()->fullname}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
{{--          <li class="nav-item">--}}
{{--            <a href="#" class="nav-link">--}}
{{--              <i class="nav-icon fas fa-user-circle"></i>--}}
{{--              <p>--}}
{{--                Users Management--}}
{{--                <i class="right fas fa-arrow-alt-circle-up"></i>--}}
{{--              </p>--}}
{{--            </a>--}}
{{--            <ul class="nav nav-treeview">--}}
{{--                  <li class="nav-item">--}}
{{--                    <a href="/list-of-users" class="nav-link">--}}
{{--                      <i class="fas fa-arrow-alt-circle-right"></i>--}}
{{--                      <p>List</p>--}}
{{--                    </a>--}}
{{--                  </li>--}}
{{--            </ul>--}}
{{--          </li>--}}

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-shopping-cart"></i>
                    <p>
                        Vendor Management
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
                <a href="#" class="nav-link">
                    <i class="fas fa-shopping-cart"></i>
                    <p>
                        Brand Management
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
                <a href="#" class="nav-link">
                    <i class="fas fa-shopping-cart"></i>
                    <p>
                        Category Management
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
                <a href="#" class="nav-link">
                    <i class="fas fa-shopping-cart"></i>
                    <p>
                        Sub-Category Management
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
                <a href="#" class="nav-link">
                    <i class="fas fa-shopping-cart"></i>
                    <p>
                        Product Management
                        <i class="right fas fa-arrow-alt-circle-up"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('products.create') }}" class="nav-link">
                            <i class="fas fa-arrow-alt-circle-right"></i>
                            <p>Add New Product</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('products') }}" class="nav-link">
                            <i class="fas fa-arrow-alt-circle-right"></i>
                            <p>List of Products</p>
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
