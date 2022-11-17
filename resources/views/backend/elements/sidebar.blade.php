<style>
    /* ============ desktop view ============ */
    @media all and (min-width: 992px) {

        .sidebar li {
            position: relative;
        }

        .sidebar li .submenu {
            display: none;
            position: absolute;
            left: 100%;
            top: -7px;
            min-width: 240px;
        }

        .sidebar li:hover > .submenu {
            display: block;
        }
    }

    /* ============ desktop view .end// ============ */

    /* ============ small devices ============ */
    @media (max-width: 991px) {

        .sidebar .submenu, .sidebar .dropdown-menu {
            position: static !important;
            margin-left: 0.7rem;
            margin-right: 0.7rem;
            margin-bottom: .5rem;
        }

    }

    ul.submenu.dropdown-menu {
        background: #3a6a43;
    }
    li.nav-item b.float-end{
        text-align: right;
        float: right;
    }
    .sidebar .nav-item:last-child{
        border-bottom: none;
        margin-bottom: 0;
    }
    .sidebar .submenu .nav-item:last-child .nav-link{
        border-bottom: none;
    }

    /* ============ small devices .end// ============ */
</style>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <li class="nav-item">
        <a class="sidebar-brand d-flex align-items-center" href="{{ route('admin.dashboard') }}">
            <div class="sidebar-brand-text">{{ config('const.app_name') }}</div>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    @if (Auth::user()->role > 1)
        <li class="nav-item {{ (request()->is('admin') || request()->is('admin/user-detail/*') || request()->is('admin/add-user') || request()->is('admin/member')) ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Quản lý người dùng  <b class="float-end">&raquo;</b></span></a>
            <ul class="submenu dropdown-menu">
                <li class="nav-item {{ (request()->is('admin') || request()->is('admin/user-detail/*') || request()->is('admin/add-user')) ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Quản trị viên</span></a>
                </li>
                <li class="nav-item {{ (request()->is('member') || request()->is('admin/member/*') || request()->is('admin/member')) ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.member') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Người dùng</span></a>
                </li>
            </ul>
        </li>
    @endif

    <li class="nav-item">
        <a class="nav-link{{ (request()->is('admin/scenarios') || request()->is('*scenario*')) ? ' active' : '' }}"
           href="#">
            <i class="fa fas fa-calendar"></i>
            <span>Quản lý thông tin  <b class="float-end">&raquo;</b></span></a>
            <ul class="submenu dropdown-menu">
            <li class="nav-item">
                <a class="nav-link{{ (request()->is('admin/scenarios') || request()->is('*scenario*')) ? ' active' : '' }}"
                   href="{{ route('admin.scenarios') }}">
                    <i class="fa fas fa-calendar"></i>
                    <span>Quản lý lịch tàu</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ (request()->is('admin/agents') || request()->is('*add-agent*') || request()->is('*process-agent*')) ? ' active' : '' }}"
                   href="{{ route('admin.agents') }}">
                    <i class="fa fa-briefcase"></i>
                    <span>Quản lý đại lý</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ (request()->is('admin/ships') || request()->is('*add-ship*') || request()->is('*process-ship*')) ? ' active' : '' }}"
                   href="{{ route('admin.ships') }}">
                    <i class="fa fa-taxi"></i>
                    <span>Quản lý tàu</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ (request()->is('admin/ports') || request()->is('*add-port*') || request()->is('*process-port*')) ? ' active' : '' }}"
                   href="{{ route('admin.ports') }}">
                    <i class="fa fa-hourglass-end"></i>
                    <span>Quản lý cảng</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ (request()->is('admin/countries') || request()->is('*add-country*') || request()->is('*process-country*')) ? ' active' : '' }}"
                   href="{{ route('admin.countries') }}">
                    <i class="fa fa-comments"></i>
                    <span>Quản lý quốc gia</span></a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ (request()->is('admin/scenarios') || request()->is('*scenario*')) ? ' active' : '' }}"
           href="#">
            <i class="fa fas fa-list"></i>
            <span>Quản Lý Đơn Hàng  <b class="float-end">&raquo;</b></span></a>
            <ul class="submenu dropdown-menu">
            <li class="nav-item">
                <a class="nav-link"
                   href="{{ route('admin.card') }}">
                    <i class="fa fas fa-newspaper"></i>
                    <span>Thông tin đơn hàng</span></a>
            </li>

        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link{{ (request()->is('admin/news') || request()->is('*add-new*') || request()->is('*new-detail*')) ? ' active' : '' }}"
           href="#">
            <i class="fa fa-clipboard"></i>
            <span>Quản lý tin tức <b class="float-end">&raquo;</b></span></a>
        <ul class="submenu dropdown-menu">
            <li class="nav-item">
                <a class="nav-link{{ (request()->is('admin/categories') || request()->is('admin/category') || request()->is('*category*')) ? ' active' : '' }}"
                   href="{{ route('admin.category') }}">
                    <i class="fas fa-list-alt"></i>
                    <span>Quản lý danh mục</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ (request()->is('admin/news') || request()->is('*add-new*') || request()->is('*new-detail*')) ? ' active' : '' }}"
                   href="{{ route('admin.news') }}">
                    <i class="fa fa-id-badge"></i>
                    <span>Danh sách tin</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ (request()->is('admin/news') || request()->is('*add-new*') || request()->is('*new-detail*')) ? ' active' : '' }}"
                   href="{{ route('admin.vsg.news') }}">
                    <i class="fa fa-id-badge"></i>
                    <span>Tin VSG</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ (request()->is('admin/news') || request()->is('*add-new*') || request()->is('*new-detail*')) ? ' active' : '' }}"
                   href="{{ route('admin.recruit.news') }}">
                    <i class="fa fa-id-badge"></i>
                    <span>Tuyển dụng</span></a>
            </li>
            <li class="nav-item {{ (request()->is('admin/newest-detail')) ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin.newest.detail') }}">
                    <i class="fas fa-bookmark"></i>
                    <span>Ấn phẩm mới nhất</span></a>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link{{ (request()->is('admin/product-types') || request()->is('admin/add-product-type/*') || request()->is('*product-type*')) ? ' active' : '' }}"
           href="#">
            <i class="fa fas fa-random"></i>
            <span>Quản lý giao thương <b class="float-end">&raquo;</b></span></a>
        <ul class="submenu dropdown-menu">
            <li class="nav-item">
                <a class="nav-link{{ (request()->is('admin/product-types') || request()->is('admin/add-product-type/*') || request()->is('*product-type*')) ? ' active' : '' }}"
                   href="{{ route('admin.app.news') }}?category_id=4">
                    <i class="fa fas fa fa-newspaper"></i>
                    <span>Giới Thiệu Dịch Vụ</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ (request()->is('admin/product-types') || request()->is('admin/add-product-type/*') || request()->is('*product-type*')) ? ' active' : '' }}"
                   href="{{ route('admin.app.news') }}?category_id=5">
                    <i class="fa fas fa fa-newspaper"></i>
                    <span>Giới Thiệu Sản Phẩm</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ (request()->is('admin/product-types') || request()->is('admin/add-product-type/*') || request()->is('*product-type*')) ? ' active' : '' }}"
                   href="{{ route('admin.app.news') }}?category_id=3">
                    <i class="fa fas fa fa-newspaper"></i>
                    <span>Yêu cầu báo giá</span></a>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link{{ (request()->is('admin/product-types') || request()->is('admin/add-product-type/*') || request()->is('*product-type*')) ? ' active' : '' }}"
           href="{{ route('admin.product.type') }}">
            <i class="fa fas fa-th"></i>
            <span>Quản lý sản phẩm <b class="float-end">&raquo;</b></span></a>
        <ul class="submenu dropdown-menu">
            <li class="nav-item">
                <a class="nav-link{{ (request()->is('admin/product-types') || request()->is('admin/add-product-type/*') || request()->is('*product-type*')) ? ' active' : '' }}"
                   href="{{ route('admin.product.type') }}">
                    <i class="fa fas fa fa-newspaper"></i>
                    <span>Danh mục sản phẩm</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ (request()->is('admin/product-types') || request()->is('admin/add-product-type/*') || request()->is('*product-type*')) ? ' active' : '' }}"
                   href="{{ route('admin.new.product') }}">
                    <i class="fa fas fa fa-newspaper"></i>
                    <span>Danh sách sản phẩm</span></a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-align-center"></i>
            <span>Quản lý chung <b class="float-end">&raquo;</b></span></a>
        <ul class="submenu dropdown-menu">
            <li class="nav-item {{ (request()->is('admin/partners') || request()->is('*partner*')) ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin.partners') }}">
                    <i class="fas fa-bell"></i>
                    <span>Quản lý đối tác</span></a>
            </li>
            <li class="nav-item {{ (request()->is('admin/supports') || request()->is('*support*')) ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin.supports') }}">
                    <i class="fas fa-id-card"></i>
                    <span>Hỗ trợ</span></a>
            </li>
            <li class="nav-item {{ (request()->is('admin/contacts') || request()->is('*contacts*')) ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin.contacts') }}">
                    <i class="fas fa-id-card"></i>
                    <span>Liên hệ</span></a>
            </li>
            <li class="nav-item {{ (request()->is('admin/update-config') || request()->is('*update-config*')) ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin.update.config') }}">
                    <i class="fas fa-id-card"></i>
                    <span>Cấu hình chung</span></a>
            </li>
        </ul>
    </li>
</ul>