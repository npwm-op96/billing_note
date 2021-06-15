<!DOCTYPE html>

<html lang="en">
<head>
  <title>BILLING : @yield('title')</title>
  <link rel="shortcut icon" href="{{-- asset('img/logo.ico') --}}" />
  @include('layouts.css')
  @yield('custom-css-script')
  @yield('custom-css')
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
<!-- <body class="hold-transition sidebar-mini sidebar-collapse"> -->
<div class="wrapper">

@include('layouts.navbar')
@include('layouts.sidebar')
@yield('content')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
@include('layouts.footer')
@include('layouts.js')
@yield('custom-js-script')
@yield('custom-js')

</body>
</html>
