

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
    <span class="brand-text font-weight-light"> Billing Note </span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar nav-compact">

    <!-- Sidebar Menu -->
    <nav class="mt-3">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item @ifActiveRoute(['home','copy_machine','price']) menu-open @endIfActiveRoute">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p> ข้อมูลหลัก : บริษัท </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('home') }}" class="nav-link {{ Active::check('home') }} ">
                <i class="far fa-circle nav-icon text-warning"></i>
                <p> พนักงาน </p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{-- route('copy_machine') --}}" class="nav-link {{-- Active::check('copy_machine') --}} ">
                <i class="far fa-circle nav-icon text-warning"></i>
                <p> เครื่องถ่ายเอกสาร </p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{-- route('price') --}}" class="nav-link {{-- Active::check('price') --}} ">
                <i class="far fa-circle nav-icon text-warning"></i>
                <p> เรทราคา </p>
              </a>
            </li>
          </ul>
        </li>


        <li class="nav-item @ifActiveRoute(['customer','customer.contract']) menu-open @endIfActiveRoute">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-check"></i>
            <p> ข้อมูลหลัก : ลูกค้า </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('customer') }}" class="nav-link {{ Active::check('customer') }} ">
                <i class="far fa-circle nav-icon text-warning"></i>
                <p> รายละเอียด </p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{-- route('customer.contract') --}}" class="nav-link {{-- Active::check('customer.contract') --}} ">
                <i class="far fa-circle nav-icon text-warning"></i>
                <p> สัญญา / ข้อตกลง </p>
              </a>
            </li>
          </ul>
        </li>

      </ul>
    </nav>

    <!-- /.sidebar-menu -->

  </div><!-- /.sidebar -->
</aside>
