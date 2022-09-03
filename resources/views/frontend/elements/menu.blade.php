<div class="menuSidebar">
    <div class="menu-sidebar-inner">
        <div class="scrollWrapper">
            <ul class="lesson-list list-unstyled">
                <li><a href="{{ route('home') }}">ホーム <i class="fa fa-angle-right"></i></a></li>
                <li><a href="javascript:void(0);" onclick="$('.btn-chapter').trigger('click');">書籍 <i class="fa fa-angle-right"></i></a></li>
{{--                <li><a href="{{ route('settings') }}">設定 <i class="fa fa-angle-right"></i></a></li>--}}
{{--                <li><a href="{{ route('notify') }}">お知らせ <i class="fa fa-angle-right"></i></a></li>--}}
                <li><a href="{{ route('policy') }}">プライバシーポリシー <i class="fa fa-angle-right"></i></a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト <i class="fa fa-sign-out"></i></a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </div>
    </div>    
</div>
