

<style media="screen">
.nav-sidebar .nav-item>.nav-link {
  padding: 9px;
}

.sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
    background-color: #808080;
    color: #fff;
}
</style>


<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="{{ asset('img/TTS_LOGO.jpg') }}" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"> DATA CENTER </span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar nav-compact">

    <!-- Sidebar Menu -->
    <nav class="mt-3">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item @ifActiveRoute('our.*') menu-open @endIfActiveRoute">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p> ข้อมูลหลัก : บริษัท </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('our.home') }}" class="nav-link {{ active_route('our.home') }} ">
                <i class="far fa-circle nav-icon text-info"></i>
                <p> ข้อมูลพนักงาน </p>
              </a>
            </li>
          </ul>
        </li>


        <li class="nav-item @ifActiveRoute('customer.*') menu-open @endIfActiveRoute">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-check"></i>
            <p> ข้อมูลหลัก : ลูกค้า </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('customer.machine_copy') }}" class="nav-link {{ active_route('customer.machine_copy') }} ">
                <i class="far fa-circle nav-icon text-warning"></i>
                <p> ข้อมูลเครื่อง  </p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('customer.index') }}" class="nav-link {{ active_route('customer.index') }} ">
                <i class="far fa-circle nav-icon text-warning"></i>
                <p> ข้อมูลลูกค้า </p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('customer.contract') }}" class="nav-link {{ active_route('customer.contract') }}  ">
                <i class="far fa-circle nav-icon text-warning"></i>
                <p> สัญญาเช่า </p>
              </a>
            </li>
          </ul>
        </li>


      </ul>
    </nav>

    <!-- /.sidebar-menu -->

  </div><!-- /.sidebar -->
</aside>
