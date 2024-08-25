<div data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
    <img class="icon-menu-home" src="{{ URL::asset('/assets/image/welcome/menu.png') }}">
</div>
<div class="offcanvas offcanvas-start " tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">

    <div class="box-profile-image-home">
        <div>
            @if (Auth::user()->image)
                <img class="image-profile" src="{{ URL::asset(Auth::user()->image) }}">
            @else
                <img class="image-profile" src="{{ URL::asset('/assets/image/welcome/profile.png') }}">
            @endif

        </div>
        <div class="box-nam-profile">
            <p class="auto-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
            <p class="auto-email">{{ Auth::user()->email }} </p>

            @if (Auth::user()->plans == 0)
                <p class="auto-account">
                    <img class="icon-account" src="{{ URL::asset('/assets/image/welcome/iconFree.jpg') }}">
                    Free Trial Account
                </p>
            @elseif (Auth::user()->plans == 1)
                <p class="auto-account">
                    <img class="icon-account" src="{{ URL::asset('/assets/image/welcome/iconPro.jpg') }}">
                    Pro Account
                </p>
            @elseif (Auth::user()->plans == 2)
                <p class="auto-account">
                    <img class="icon-account" src="{{ URL::asset('/assets/image/welcome/iconPremium.png') }}">
                    Premium Account
                </p>
            @endif
        </div>
    </div>
    <div class="box-profile-manu">
        <a class="no-underline"
            @if (Request::is('home')) data-bs-dismiss="offcanvas" aria-label="Close"
    @else
        href="{{ url('/home') }}" @endif>
            <p class="back-home">
                <img class="icon-account-manu" src="{{ URL::asset('/assets/image/welcome/home.png') }}">
                หน้าหลัก: ทรัพย์ของฉัน
            </p>
        </a>
        <a class="no-underline"
            @if (Request::is('assets-customer')) data-bs-dismiss="offcanvas" aria-label="Close"
        @else
            href="{{ url('/assets-customer') }}" @endif>
            <p class="manu-bar-profile">
                <img class="icon-account-manu" src="{{ URL::asset('/assets/image/welcome/comment.png') }}">
                ทรัพย์ที่ลูกค้าต้องการ
            </p>
        </a>
        <a href="{{ url('/plans-all') }}" class="no-underline">
            <p class="manu-bar-profile">
                <img class="icon-account-manu" src="{{ URL::asset('/assets/image/welcome/bar_chart_4_bars.png') }}">
                อัพเกรดแพลน
            </p>
        </a>
        <div class="manu-bar-profile">


            <img class="icon-account-manu" src="{{ URL::asset('/assets/image/welcome/iconPremium.png') }}">

            <input type="checkbox" id="toggle-menu" class="toggle-menu">
            <label for="toggle-menu" class="upgrade-plan">พรีเมียมฟีเจอร์
                <img class="icon-stat_minus_1" src="{{ URL::asset('/assets/image/welcome/stat_minus_1.png') }}">

            </label>
            <ul class="menu-items">
                <li>
                    <a @if (Auth::user()->plans == 2) href="{{ url('personal-website') }}" @endif>
                        <p>
                            <img class="icon-account-manu"
                                src="{{ URL::asset('/assets/image/welcome/bookmark_manager.png') }}">
                            แก้ไขเว็บส่วนตัว
                            <img class="icon-account-manu"
                                src="{{ URL::asset('/assets/image/welcome/iconPremium.png') }}">
                        </p>
                    </a>
                </li>
                <li>
                    <a @if (Auth::user()->plans == 2) href="{{ url('co-agent') }}" @endif>
                        <p>
                            <img class="icon-account-manu"
                                src="{{ URL::asset('/assets/image/welcome/groups_2.png') }}">
                            หา co-agent ช่วยขาย
                            <img class="icon-account-manu"
                                src="{{ URL::asset('/assets/image/welcome/iconPremium.png') }}">
                        </p>
                    </a>
                </li>

            </ul>

        </div>
        <a href="{{ url('/edit-profile') }}" class="no-underline">
            <p class="manu-bar-profile">

                <img class="icon-account-manu" src="{{ URL::asset('/assets/image/welcome/settings.png') }}">
                ตั้งค่าโปรไฟล์

            </p>
        </a>

    </div>


    <div class="offcanvas-body">
        <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
     document.getElementById('logout-form').submit();">
            <img class="icon-account-manu" src="{{ URL::asset('/assets/image/welcome/logout.png') }}">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>
