<!DOCTYPE html>
<html>


    @include('back.layouts.head')
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            @include('back.layouts.header')
            <!-- Left side column. contains the logo and sidebar -->

            @include('back.layouts.sidebar')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Version 2.0</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Info boxes -->
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Total Case Studies</span>
                                    <span class="info-box-number"><?php echo count($listCaseStudy) ?></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <?php $read_email = DB::table('contact')->where('read', '=', 1)->whereNull('deleted_at')->count() ?>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Read Queries</span>
                                    <span class="info-box-number">{{$read_email}}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <!-- fix for small devices only -->
                        <div class="clearfix visible-sm-block"></div>

                        <?php $unread_emails = DB::table('contact')->where('read', '=', 0)->whereNull('deleted_at')->count() ?>

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fa fa-refresh"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Unread Queries</span>
                                    <span class="info-box-number">{{$unread_emails}}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
<!--                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-dollar"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Total Price</span>
                                    <span class="info-box-number">{{-- number_format($report->total_price) --}}</span>
                                </div>
                                 /.info-box-content 
                            </div>
                             /.info-box 
                        </div>-->
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <!-- Left col -->
                        <div class="col-md-12">


                            <!-- TABLE: LATEST ORDERS -->
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Recent Case Studies</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table class="table no-margin">
                                            <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                {{--<th class="text-center">Page Title</th>--}}
                                                <th class="text-center">Case Title</th>
                                                <th class="text-center">Image</th>
                                                {{--<th class="text-center">Content</th>--}}
                                                <th class="text-center">Role</th>
                                                <th class="text-center">Active / Inactive</th>
                                                {{--<th class="text-center">Edit</th>--}}
                                                {{--<th class="text-center">Delete</th>--}}
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($listCaseStudy as $list)

                                                <tr>
                                                    <td>{{$list->id}}</td>
                                                    {{--<td>{{$list->page_title}}</td>--}}
                                                    <td>{{$list->case_title}}</td>
                                                    <td class="text-center"><img src="/{{$list->image}}" width="90px" height="90px"></td>
                                                    {{--<td>{!! $list->content !!}</td>--}}
                                                    <td>{{$list->role}}</td>
                                                    <td class="text-center">
                                                        @if($list->status == 1)
                                                            <span class="label label-success label-mini tooltips" data-original-title="Active" style="color: white; background-color: green; ">Active</span>
                                                        @else
                                                            <span class="label label-danger label-mini tooltips" data-original-title="Inactive"style="color: white; background-color: red; ">Inactive</span>
                                                        @endif
                                                    </td>
                                                    {{--<td class="text-center"><a type="button" href="{{ URL::route('edit.casestudy',array($list->id))}}" class="msg-pencil-icon tooltips" data-original-title="Edit"><i class="fa fa-edit" aria-hidden="true" style="font-size: 17px"></i></a>&nbsp;&nbsp;</td>--}}
                                                    {{--<td class="text-center"><a href="{{URL::route('delete.casestudy',array($list->id))}}" onclick="return confirm('Are you sure?')"><i class="fa fa-recycle"></i></a></td>--}}

                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer clearfix">
                                    <!-- <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a> -->
                                    <!-- <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a> -->
                                </div>
                                <!-- /.box-footer -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-4">



                            <!-- PRODUCT LIST -->
                            {{--<div class="box box-primary">--}}
                                {{--<div class="box-header with-border">--}}
                                    {{--<h3 class="box-title">Recently Added Products</h3>--}}

                                    {{--<div class="box-tools pull-right">--}}
                                        {{--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>--}}
                                        {{--</button>--}}
                                        {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<!-- /.box-header -->--}}
                                {{--<div class="box-body">--}}
                                    {{--<ul class="products-list product-list-in-box">--}}
                                        {{--<li class="item">--}}
                                            {{--<div class="product-img">--}}
                                                {{--<img src="/assets/dist/img/default-50x50.gif" alt="Product Image">--}}
                                            {{--</div>--}}
                                            {{--<div class="product-info">--}}
                                                {{--<a href="javascript:void(0)" class="product-title">N/A--}}
                                                    {{--<!--<span class="label label-warning pull-right">$1800</span></a>-->--}}
{{--<!--                                                <span class="product-description">--}}
                                                    {{--Samsung 32" 1080p 60Hz LED Smart HDTV.--}}
                                                {{--</span>-->--}}
                                            {{--</div>--}}
                                        {{--</li>--}}
                                        {{--<li class="item">--}}
                                            {{--<div class="product-img">--}}
                                                {{--<img src="/assets/dist/img/default-50x50.gif" alt="Product Image">--}}
                                            {{--</div>--}}
                                            {{--<div class="product-info">--}}
                                                {{--<a href="javascript:void(0)" class="product-title">N/A--}}
                                                    {{--<!--<span class="label label-warning pull-right">$1800</span></a>-->--}}
{{--<!--                                                <span class="product-description">--}}
                                                    {{--Samsung 32" 1080p 60Hz LED Smart HDTV.--}}
                                                {{--</span>-->--}}
                                            {{--</div>--}}
                                        {{--</li>--}}
                                        {{--<li class="item">--}}
                                            {{--<div class="product-img">--}}
                                                {{--<img src="/assets/dist/img/default-50x50.gif" alt="Product Image">--}}
                                            {{--</div>--}}
                                            {{--<div class="product-info">--}}
                                                {{--<a href="javascript:void(0)" class="product-title">N/A--}}
                                                    {{--<!--<span class="label label-warning pull-right">$1800</span></a>-->--}}
{{--<!--                                                <span class="product-description">--}}
                                                    {{--Samsung 32" 1080p 60Hz LED Smart HDTV.--}}
                                                {{--</span>-->--}}
                                            {{--</div>--}}
                                        {{--</li>--}}
                                        {{--<li class="item">--}}
                                            {{--<div class="product-img">--}}
                                                {{--<img src="/assets/dist/img/default-50x50.gif" alt="Product Image">--}}
                                            {{--</div>--}}
                                            {{--<div class="product-info">--}}
                                                {{--<a href="javascript:void(0)" class="product-title">N/A--}}
                                                    {{--<!--<span class="label label-warning pull-right">$1800</span></a>-->--}}
{{--<!--                                                <span class="product-description">--}}
                                                    {{--Samsung 32" 1080p 60Hz LED Smart HDTV.--}}
                                                {{--</span>-->--}}
                                            {{--</div>--}}
                                        {{--</li>--}}
                                        {{----}}
                                    {{--</ul>--}}
                                {{--</div>--}}
                                {{--<!-- /.box-body -->--}}
                                {{--<div class="box-footer text-center">--}}
                                    {{--<a href="javascript:void(0)" class="uppercase">View All Products</a>--}}
                                {{--</div>--}}
                                {{--<!-- /.box-footer -->--}}
                            {{--</div>--}}
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    </div>


                    {{--<div class="row">--}}
                        {{--<div class="col-md-12">--}}
                            {{--<div class="box">--}}
                                {{--<div class="box-header with-border">--}}
                                    {{--<h3 class="box-title">Monthly Recap Report</h3>--}}

                                    {{--<div class="box-tools pull-right">--}}
                                        {{--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>--}}
                                        {{--</button>--}}
                                        {{--<div class="btn-group">--}}
                                            {{--<button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">--}}
                                                {{--<i class="fa fa-wrench"></i></button>--}}
                                            {{--<ul class="dropdown-menu" role="menu">--}}
                                                {{--<li><a href="#">Action</a></li>--}}
                                                {{--<li><a href="#">Another action</a></li>--}}
                                                {{--<li><a href="#">Something else here</a></li>--}}
                                                {{--<li class="divider"></li>--}}
                                                {{--<li><a href="#">Separated link</a></li>--}}
                                            {{--</ul>--}}
                                        {{--</div>--}}
                                        {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<!-- /.box-header -->--}}
                                {{--<div class="box-body">--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="col-md-8">--}}
                                            {{--<p class="text-center">--}}
                                                {{--<strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>--}}
                                            {{--</p>--}}

                                            {{--<div class="chart">--}}
                                                {{--<!-- Sales Chart Canvas -->--}}
                                                {{--<canvas id="salesChart" style="height: 180px;"></canvas>--}}
                                            {{--</div>--}}
                                            {{--<!-- /.chart-responsive -->--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-4">--}}


                                            {{--<div class="box box-default">--}}
                                                {{--<div class="box-header with-border">--}}
                                                    {{--<h3 class="box-title">Browser Usage</h3>--}}

                                                    {{--<div class="box-tools pull-right">--}}
                                                        {{--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>--}}
                                                        {{--</button>--}}
                                                        {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<!-- /.box-header -->--}}
                                                {{--<div class="box-body">--}}
                                                    {{--<div class="row">--}}
                                                        {{--<div class="col-md-8">--}}
                                                            {{--<div class="chart-responsive">--}}
                                                                {{--<canvas id="pieChart" height="150"></canvas>--}}
                                                            {{--</div>--}}
                                                            {{--<!-- ./chart-responsive -->--}}
                                                        {{--</div>--}}
                                                        {{--<!-- /.col -->--}}
                                                        {{--<div class="col-md-4">--}}
                                                            {{--<ul class="chart-legend clearfix">--}}
                                                                {{--@foreach($stores as $st)--}}
                                                                {{--<li><i class="fa fa-circle-o text---}}{{--$st->pie_color--}}{{--"></i> --}}{{--$st->store_name--}}{{--</li>--}}
                                                                {{--@endforeach--}}
                                                            {{--</ul>--}}
                                                        {{--</div>--}}
                                                        {{--<!-- /.col -->--}}
                                                    {{--</div>--}}
                                                    {{--<!-- /.row -->--}}
                                                {{--</div>--}}
                                                {{--<!-- /.box-body -->--}}
                                                {{--<div class="box-footer no-padding">--}}
                                                    {{--<ul class="nav nav-pills nav-stacked">--}}
                                                        {{--<li><a href="#">United States of America--}}
                                                                {{--<span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>--}}
                                                        {{--<li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a>--}}
                                                        {{--</li>--}}
                                                        {{--<li><a href="#">China--}}
                                                                {{--<span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>--}}
                                                    {{--</ul>--}}
                                                {{--</div>--}}
                                                {{--<!-- /.footer -->--}}
                                            {{--</div>--}}
                                            {{--<!-- /.box -->--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<!-- /.row -->--}}
                                {{--</div>--}}
                                {{--<!-- ./box-body -->--}}
                                {{--<div class="box-footer">--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="col-sm-3 col-xs-6">--}}
                                            {{--<div class="description-block border-right">--}}
                                                {{--<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>--}}
                                                {{--<h5 class="description-header">$35,210.43</h5>--}}
                                                {{--<span class="description-text">TOTAL REVENUE</span>--}}
                                            {{--</div>--}}
                                            {{--<!-- /.description-block -->--}}
                                        {{--</div>--}}
                                        {{--<!-- /.col -->--}}
                                        {{--<div class="col-sm-3 col-xs-6">--}}
                                            {{--<div class="description-block border-right">--}}
                                                {{--<span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>--}}
                                                {{--<h5 class="description-header">$10,390.90</h5>--}}
                                                {{--<span class="description-text">TOTAL COST</span>--}}
                                            {{--</div>--}}
                                            {{--<!-- /.description-block -->--}}
                                        {{--</div>--}}
                                        {{--<!-- /.col -->--}}
                                        {{--<div class="col-sm-3 col-xs-6">--}}
                                            {{--<div class="description-block border-right">--}}
                                                {{--<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>--}}
                                                {{--<h5 class="description-header">$24,813.53</h5>--}}
                                                {{--<span class="description-text">TOTAL PROFIT</span>--}}
                                            {{--</div>--}}
                                            {{--<!-- /.description-block -->--}}
                                        {{--</div>--}}
                                        {{--<!-- /.col -->--}}
                                        {{--<div class="col-sm-3 col-xs-6">--}}
                                            {{--<div class="description-block">--}}
                                                {{--<span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>--}}
                                                {{--<h5 class="description-header">1200</h5>--}}
                                                {{--<span class="description-text">GOAL COMPLETIONS</span>--}}
                                            {{--</div>--}}
                                            {{--<!-- /.description-block -->--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<!-- /.row -->--}}
                                {{--</div>--}}
                                {{--<!-- /.box-footer -->--}}
                            {{--</div>--}}
                            {{--<!-- /.box -->--}}
                        {{--</div>--}}
                        {{--<!-- /.col -->--}}
                    {{--</div>--}}
                    <!-- /.row -->

                    <!-- Main row -->

                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            @include('back.layouts.footer')


            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                    <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane" id="control-sidebar-home-tab">
                        <h3 class="control-sidebar-heading">Recent Activity</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                        <p>Will be 23 on April 24th</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-user bg-yellow"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                        <p>New phone +1(800)555-1234</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                        <p>nora@example.com</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-file-code-o bg-green"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                        <p>Execution time 5 seconds</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- /.control-sidebar-menu -->

                        <h3 class="control-sidebar-heading">Tasks Progress</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Custom Template Design
                                        <span class="label label-danger pull-right">70%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Update Resume
                                        <span class="label label-success pull-right">95%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Laravel Integration
                                        <span class="label label-warning pull-right">50%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Back End Framework
                                        <span class="label label-primary pull-right">68%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- /.control-sidebar-menu -->

                    </div>
                    <!-- /.tab-pane -->

                    <!-- Settings tab content -->
                    <div class="tab-pane" id="control-sidebar-settings-tab">
                        <form method="post">
                            {{csrf_field()}}
                            <h3 class="control-sidebar-heading">General Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Report panel usage
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Some information about this general settings option
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Allow mail redirect
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Other sets of options are available
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Expose author name in posts
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Allow the user to show his name in blog posts
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <h3 class="control-sidebar-heading">Chat Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Show me as online
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Turn off notifications
                                    <input type="checkbox" class="pull-right">
                                </label>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Delete chat history
                                    <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                                </label>
                            </div>
                            <!-- /.form-group -->
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
            </aside>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>

        </div>
        <!-- ./wrapper -->

        <!-- jQuery 3 -->
        <script src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="/assets/bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="/assets/dist/js/adminlte.min.js"></script>
        <!-- Sparkline -->
        <script src="/assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
        <!-- jvectormap  -->
        <script src="/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- SlimScroll -->
        <script src="/assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- ChartJS -->
        <script src="/assets/bower_components/chart.js/Chart.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="/assets/dist/js/pages/dashboard2.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="/assets/dist/js/demo.js"></script>
    </body>

    <!-- Mirrored from adminlte.io/themes/AdminLTE/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Nov 2019 10:49:47 GMT -->
</html>
