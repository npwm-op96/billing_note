<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
  </ul>


  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">

    <li class="nav-item dropdown">

      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <b> {{ Auth::user()->username }} </b>
            </a>


            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

              <!-- <a class="dropdown-item" href="https://hr.ddc.moph.go.th" target="_blank">แก้ไขข้อมูลส่วนตัว</a> -->

              <!-- <div class="dropdown-divider"></div> -->

                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <b> <i class="fas fa-power-off"></i> </b> {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>

      </div>
    </li>

  </ul>





</nav>
