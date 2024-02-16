@extends('admin_panel.layouts.admin_panel_view')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <?php $count_users = \App\Models\User::where('role', '!=', 'admin')->where('active', '=', 1)->whereNull('deleted_at')->count(); ?>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i style="font-weight: 1000;"
                                                                           class="fas fa-user-circle"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Users</span>
                            <span class="info-box-number">@if($count_users < 10)
                                    0{{$count_users}} @else {{$count_users}} @endif</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>
                <?php $count_product = \App\Models\Product::whereNull('deleted_at')->count(); ?>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Products</span>
                            <span class="info-box-number">@if($count_product < 10)
                                    0{{$count_product}}@else{{$count_product}}@endif</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            {{--            <div class="col-12 col-sm-6 col-md-3">--}}
            {{--                <div class="info-box mb-3">--}}
            {{--                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>--}}

            {{--                    <div class="info-box-content">--}}
            {{--                        <span class="info-box-text">New Members</span>--}}
            {{--                        <span class="info-box-number">2,000</span>--}}
            {{--                    </div>--}}
            {{--                    <!-- /.info-box-content -->--}}
            {{--                </div>--}}
            {{--                <!-- /.info-box -->--}}
            {{--            </div>--}}
            <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-12">
                    <!-- MAP & BOX PANE -->
                    <!-- /.card -->
                    <div class="row">
                        <!-- /.col -->
{{--                        <div class="col-md-6">--}}
{{--                            <!-- USERS LIST -->--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-header">--}}
{{--                                    <h3 class="card-title">Latest Members</h3>--}}

{{--                                    <div class="card-tools">--}}
{{--                                        <span class="badge badge-danger"><?php echo $count_users ?> New @if($count_users == 1)--}}
{{--                                                Member @else Members @endif</span>--}}
{{--                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">--}}
{{--                                            <i class="fas fa-minus"></i>--}}
{{--                                        </button>--}}
{{--                                        <button type="button" class="btn btn-tool" data-card-widget="remove">--}}
{{--                                            <i class="fas fa-times"></i>--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!-- /.card-header -->--}}
{{--                                @foreach($users as $usr)--}}
{{--                                    <div class="card-body p-0">--}}
{{--                                        <ul class="users-list clearfix">--}}
{{--                                            <li>--}}
{{--                                                @if($usr->image == null || $usr->image == '')--}}
{{--                                                    <img src="/assets/admin_panel/dist/img/admin_logo.jpg"--}}
{{--                                                         alt="User Image">--}}
{{--                                                @else--}}
{{--                                                    <img src="{{$usr->image}}" alt="User Image">--}}
{{--                                                @endif--}}
{{--                                                <a class="users-list-name" href="#">{{$usr->name}}</a>--}}
{{--                                                <span--}}
{{--                                                    class="users-list-date"><?php echo date('j F Y', strtotime($usr->created_at)); ?></span>--}}
{{--                                            </li>--}}
{{--                                        </ul>--}}
{{--                                        <!-- /.users-list -->--}}
{{--                                    </div>--}}
{{--                            @endforeach--}}
{{--                            <!-- /.card-body -->--}}
{{--                                <div class="card-footer text-center">--}}
{{--                                    <a href="/list-of-users">View All Users</a>--}}
{{--                                </div>--}}
{{--                                <!-- /.card-footer -->--}}
{{--                            </div>--}}
{{--                            <!--/.card -->--}}
{{--                        </div>--}}
                        <!-- /.col -->
                        <div class="col-md-12">
                            <!-- PRODUCT LIST -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Recently Added Products</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <ul class="products-list product-list-in-card pl-2 pr-2">
                                        @foreach($products as $prods)
                                            <li class="item">
                                                <div class="product-img">
                                                    <img src="{{$prods->image}}" alt="Product Image"
                                                         class="img-size-50">
                                                </div>
                                                <div class="product-info">
                                                    <a href="{{$prods->slug}}"
                                                       class="product-title">{{$prods->product_name}}
                                                        @if($prods->status == 1)
                                                            <span class="badge badge-success float-right">Active</span>
                                                        @else
                                                            <span class="badge badge-danger float-right">Inactive</span>
                                                        @endif
                                                    </a>
                                                    <span class="product-description">
                                                    <?php
                                                        $length = strlen($prods->description);
//                                                        print_r($length);die('length');
                                                        if ($length > 42) {
                                                            print_r(substr($prods->description, 0, 50) . '<span style="red">...</span>');
//                                                            print_r(substr($prods->description, 0, 50));
                                                        } else {
                                                            print_r($prods->description);
                                                        }
                                                        ?>
                                                </span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">
                                    <a href="/list-of-products" class="uppercase">View All Products</a>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                        </div>

                    </div>
                    <!-- /.row -->

                    <!-- TABLE: LATEST ORDERS -->
{{--                    <div class="card">--}}
{{--                        <div class="card-header border-transparent">--}}
{{--                            <h3 class="card-title">Latest Orders</h3>--}}

{{--                            <div class="card-tools">--}}
{{--                                <button type="button" class="btn btn-tool" data-card-widget="collapse">--}}
{{--                                    <i class="fas fa-minus"></i>--}}
{{--                                </button>--}}
{{--                                <button type="button" class="btn btn-tool" data-card-widget="remove">--}}
{{--                                    <i class="fas fa-times"></i>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- /.card-header -->--}}
{{--                        <div class="card-body p-0">--}}
{{--                            <div class="table-responsive">--}}
{{--                                <table class="table m-0">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th>Order ID</th>--}}
{{--                                        <th>Item</th>--}}
{{--                                        <th>Status</th>--}}
{{--                                        <th>Popularity</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    <tr>--}}
{{--                                        <td><a href="pages/examples/invoice.html">OR9842</a></td>--}}
{{--                                        <td>Call of Duty IV</td>--}}
{{--                                        <td><span class="badge badge-success">Shipped</span></td>--}}
{{--                                        <td>--}}
{{--                                            <div class="sparkbar" data-color="#00a65a" data-height="20">--}}
{{--                                                90,80,90,-70,61,-83,63--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td><a href="pages/examples/invoice.html">OR1848</a></td>--}}
{{--                                        <td>Samsung Smart TV</td>--}}
{{--                                        <td><span class="badge badge-warning">Pending</span></td>--}}
{{--                                        <td>--}}
{{--                                            <div class="sparkbar" data-color="#f39c12" data-height="20">--}}
{{--                                                90,80,-90,70,61,-83,68--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td><a href="pages/examples/invoice.html">OR7429</a></td>--}}
{{--                                        <td>iPhone 6 Plus</td>--}}
{{--                                        <td><span class="badge badge-danger">Delivered</span></td>--}}
{{--                                        <td>--}}
{{--                                            <div class="sparkbar" data-color="#f56954" data-height="20">--}}
{{--                                                90,-80,90,70,-61,83,63--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td><a href="pages/examples/invoice.html">OR7429</a></td>--}}
{{--                                        <td>Samsung Smart TV</td>--}}
{{--                                        <td><span class="badge badge-info">Processing</span></td>--}}
{{--                                        <td>--}}
{{--                                            <div class="sparkbar" data-color="#00c0ef" data-height="20">--}}
{{--                                                90,80,-90,70,-61,83,63--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td><a href="pages/examples/invoice.html">OR1848</a></td>--}}
{{--                                        <td>Samsung Smart TV</td>--}}
{{--                                        <td><span class="badge badge-warning">Pending</span></td>--}}
{{--                                        <td>--}}
{{--                                            <div class="sparkbar" data-color="#f39c12" data-height="20">--}}
{{--                                                90,80,-90,70,61,-83,68--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td><a href="pages/examples/invoice.html">OR7429</a></td>--}}
{{--                                        <td>iPhone 6 Plus</td>--}}
{{--                                        <td><span class="badge badge-danger">Delivered</span></td>--}}
{{--                                        <td>--}}
{{--                                            <div class="sparkbar" data-color="#f56954" data-height="20">--}}
{{--                                                90,-80,90,70,-61,83,63--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td><a href="pages/examples/invoice.html">OR9842</a></td>--}}
{{--                                        <td>Call of Duty IV</td>--}}
{{--                                        <td><span class="badge badge-success">Shipped</span></td>--}}
{{--                                        <td>--}}
{{--                                            <div class="sparkbar" data-color="#00a65a" data-height="20">--}}
{{--                                                90,80,90,-70,61,-83,63--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                            <!-- /.table-responsive -->--}}
{{--                        </div>--}}
{{--                        <!-- /.card-body -->--}}
{{--                        <div class="card-footer clearfix">--}}
{{--                            <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>--}}
{{--                            <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All--}}
{{--                                Orders</a>--}}
{{--                        </div>--}}
{{--                        <!-- /.card-footer -->--}}
{{--                    </div>--}}
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>

@endsection


@section('js')


@endsection
