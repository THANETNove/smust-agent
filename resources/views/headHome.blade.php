<div class="home-head">
    <div class="col-12">
        <div class="box-head-home">
            <div data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                <img class="icon-menu-home" src="{{ URL::asset('/assets/image/welcome/menu.png') }}">
            </div>
            <div>
                <p class="p-login">ทรัพย์ของฉัน ({{ $dataCount }}) </p>
            </div>
            <div class="box-number-count">
                <div class="number-count"> 5</div>
                <img class="vector-icon" src="{{ URL::asset('/assets/image/welcome/Vector.png') }}">
            </div>
        </div>
        <div class="box-search-home">
            <img class="icon-search" src="{{ URL::asset('/assets/image/welcome/search.png') }}">
            <input type="text" class="form-control box-filter_alt" id="exampleFormControlInput1"
                placeholder="พิมพ์ค้นหา...">
        </div>
        <div class="box-filter-home">
            <div>
                <img class="icon-filterData" src="{{ URL::asset('/assets/image/welcome/filterData.png') }}">
            </div>
            <div>
                <img class="icon-filter" src="{{ URL::asset('/assets/image/welcome/filter.png') }}">
            </div>
            <div>

                <img class="icon-filterLove" src="{{ URL::asset('/assets/image/welcome/filterLove.png') }}">
            </div>
        </div>


        {{--   <ul class="nav nav-tabs">
            <li class="nav-item me-2" role="presentation">
                <button class="" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                    type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home

                </button>
                <div class="nav-link-decoration"></div>

            </li>
            <li class="nav-item ms-2 container-right" role="presentation">
                <button class="" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                    type="button" role="tab" aria-controls="profile-tab-pane"
                    aria-selected="false">Profile</button>
                <div class="nav-link-decoration2"></div>
            </li>
        </ul>
 --}}

        {{--  <div class="box-nav-link-home ">
            <div class="box-link-manu-home active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                home
            </div>
            <div class="box-link-manu-home " id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">profile</div>
        </div> --}}
        <div class="box-nav-link-home nav nav-tabs" id="myTab" role="tablist">
            <div class="box-link-manu-home active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                Home
            </div>
            <div class="box-link-manu-home" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                Profile
            </div>
        </div>


        <div class="offcanvas offcanvas-start " tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">

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
                <p class="back-home" data-bs-dismiss="offcanvas" aria-label="Close">
                    <img class="icon-account-manu" src="{{ URL::asset('/assets/image/welcome/home.png') }}">
                    หน้าหลัก: ทรัพย์ของฉัน
                </p>
                <p class="manu-bar-profile">
                    <img class="icon-account-manu" src="{{ URL::asset('/assets/image/welcome/comment.png') }}">
                    ทรัพย์ที่ลูกค้าต้องการ
                </p>
                <p class="manu-bar-profile">
                    <a href="{{ url('/plans-all') }}" class="no-underline">
                        <img class="icon-account-manu"
                            src="{{ URL::asset('/assets/image/welcome/bar_chart_4_bars.png') }}">
                        อัพเกรดแพลน
                    </a>

                </p>
                <div class="manu-bar-profile">

                    @if (Auth::user()->plans == 0)
                        <img class="icon-account-manu" src="{{ URL::asset('/assets/image/welcome/iconFree.png') }}">
                    @elseif (Auth::user()->plans == 1)
                        <img class="icon-account-manu" src="{{ URL::asset('/assets/image/welcome/iconPro.jpg') }}">
                    @elseif (Auth::user()->plans == 2)
                        <img class="icon-account-manu" src="{{ URL::asset('/assets/image/welcome/iconPremium.png') }}">
                    @endif
                    <input type="checkbox" id="toggle-menu" class="toggle-menu">
                    <label for="toggle-menu" class="upgrade-plan">พรีเมียมฟีเจอร์
                        <img class="icon-stat_minus_1"
                            src="{{ URL::asset('/assets/image/welcome/stat_minus_1.png') }}">

                    </label>
                    <ul class="menu-items">
                        <li>
                            <p>
                                <img class="icon-account-manu"
                                    src="{{ URL::asset('/assets/image/welcome/bookmark_manager.png') }}">
                                แก้ไขเว็บส่วนตัว
                                @if (Auth::user()->plans == 0)
                                    <img class="icon-account-manu-2"
                                        src="{{ URL::asset('/assets/image/welcome/iconFree.png') }}">
                                @elseif (Auth::user()->plans == 1)
                                    <img class="icon-account-manu"
                                        src="{{ URL::asset('/assets/image/welcome/iconPro.jpg') }}">
                                @elseif (Auth::user()->plans == 2)
                                    <img class="icon-account-manu"
                                        src="{{ URL::asset('/assets/image/welcome/iconPremium.png') }}">
                                @endif
                            </p>
                        </li>
                        <li>
                            <p>
                                <img class="icon-account-manu"
                                    src="{{ URL::asset('/assets/image/welcome/groups_2.png') }}">
                                หา co-agent ช่วยขาย
                                @if (Auth::user()->plans == 0)
                                    <img class="icon-account-manu-2"
                                        src="{{ URL::asset('/assets/image/welcome/iconFree.png') }}">
                                @elseif (Auth::user()->plans == 1)
                                    <img class="icon-account-manu"
                                        src="{{ URL::asset('/assets/image/welcome/iconPro.jpg') }}">
                                @elseif (Auth::user()->plans == 2)
                                    <img class="icon-account-manu"
                                        src="{{ URL::asset('/assets/image/welcome/iconPremium.png') }}">
                                @endif
                            </p>
                        </li>

                    </ul>

                </div>
                <p class="manu-bar-profile">
                    <img class="icon-account-manu" src="{{ URL::asset('/assets/image/welcome/settings.png') }}">
                    ตั้งค่าโปรไฟล์
                </p>
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
    </div>
</div>
