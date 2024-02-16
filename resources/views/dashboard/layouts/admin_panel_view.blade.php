<!DOCTYPE html>
<html lang="en">

@include('dashboard.layouts.head')

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

@include('dashboard.layouts.header')

@include('dashboard.layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{"Heading"}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">{{"Title"}}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
      @if (\Session::has('success'))
          <div class="row">
              <div id="message-group" class="col-md-12">
                  <div class="alert alert-success" role="alert">{{\Session::get('success')}}</div>
              </div>
          </div>
      @endif
      @if (\Session::has('error'))
          <div class="row">
              <div id="message-group" class="col-md-12">
                  <div class="alert alert-danger" role="alert">{{\Session::get('error')}}</div>
              </div>
          </div>
      @endif
    <!-- Main content -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

<!-- Main Footer -->
@include('dashboard.layouts.footer')

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
@include('dashboard.layouts.script')
@yield('js')

</body>
</html>
