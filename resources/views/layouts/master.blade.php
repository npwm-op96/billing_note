<!DOCTYPE html>

<html lang="en">
<head>
  <title>BILLING : @yield('title')</title>
  <link rel="shortcut icon" href="{{ asset('img/logo.ico') }}" />
  @include('layouts.css')
  @yield('custom-css-script')
  @yield('custom-css')
</head>



<body class="hold-transition sidebar-mini layout-fixed">
<!-- <body class="hold-transition sidebar-mini sidebar-collapse"> -->
  <div class="wrapper">

  <!-- START of Topbar -->
    @include('layouts.navbar')
  <!-- End of Topbar -->



  <!-- START of Sidebar -->
    @include('layouts.sidebar')
  <!-- End of Sidebar -->



  <!-- Content Wrapper. Contains page content -->


    <!-- START CONTENTS  -->
      @yield('content')
    <!-- END CONTENTS  -->


  <!-- /.content-wrapper -->



  <!-- START of Footer -->
    @include('layouts.footer')
  <!-- End of Footer -->



  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


    <!-- START Bootstrap core JS -->
    @include('layouts.js')
    @yield('custom-js-script')
    @yield('custom-js')
    <!-- END Bootstrap core JS -->


  </body>
</html>
