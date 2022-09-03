<header>
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form class="d-none form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
      <div class="input-group">
        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search fa-sm"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

      <!-- Nav Item - Messages -->
      {{--<li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="/admin/lang/en">
          <span class=""><img src="/images/en.png" /> </span>
        </a>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="/admin/lang/vi">
          <span class=""><img src="/images/vn.png" /> </span>
        </a>
      </li>--}}

      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
          <img class="img-profile rounded-circle" src="/backend/img/user-avatar.png">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          {{--<a class="dropdown-item" href="#">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
          </a>
          <a class="dropdown-item" href="#">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Settings
          </a>
          <div class="dropdown-divider"></div>--}}
          <a class="dropdown-item" href="{{ route('admin.logout') }}"
             onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Đăng xuất</a>

          <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </li>

    </ul>
  </nav>
</header>