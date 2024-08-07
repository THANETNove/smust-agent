@extends('layouts.app')

@section('content')
    <div class="home-background">
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


                <ul class="nav nav-tabs">
                    <li class="nav-item me-2" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                            type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home

                        </button>
                        <div class="nav-link-decoration"></div>

                    </li>
                    <li class="nav-item ms-2" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                            type="button" role="tab" aria-controls="profile-tab-pane"
                            aria-selected="false">Profile</button>
                        <div class="nav-link-decoration2"></div>
                    </li>
                </ul>



                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
                    aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if (session('message'))
            <p class="message-text text-center mt-4"> {{ session('message') }}</p>
        @endif

        <div class="col-12">
            @if (Auth::user()->status != '0')
                @if (Auth::user()->status < 3)
                    @if ($number < 101)
                        <a href="{{ url('/create-content') }}" class="box-call ml-16">เพิ่ม</a>
                    @endif
                @else
                    <a href="{{ url('/create-content') }}" class="box-call ml-16">เพิ่ม</a>
                @endif
            @endif
        </div>



        <div class="card-content">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                    tabindex="0">
                    <div class="row">
                        @foreach ($dataHome as $home)
                            @php
                                $imgUrl = json_decode(htmlspecialchars_decode($home->image));
                            @endphp
                            <a href="{{ url('get-detall', $home->id) }}">
                                <div class="card-new">
                                    @if (Carbon\Carbon::parse($home->created_at)->diffInDays(Carbon\Carbon::now()) < 4)
                                        <div class="box-new">NEW</div>
                                    @endif
                                    <div class="box-img-new">
                                        <img class="img-0831 lazy"
                                            data-src="{{ URL::asset('/img/product/' . $imgUrl[0]) }}">
                                    </div>
                                    <div class="box-name-new">
                                        <p class="name-content">{{ $home->building_name }}</p>
                                        <p class="name-details">
                                            <img class="img-icon "
                                                src="{{ URL::asset('/assets/image/home/location_on.png') }}">
                                            {{ $home->districts_name_th }} {{ $home->amphures_name_th }}
                                            {{ $home->provinces_name_th }}
                                        </p>
                                        @if ($home->train_name != 'ไม่มี' && $home->train_name)
                                            @if ($home->time_arrive < '61')
                                                <p class="name-details">
                                                    <img class="img-icon"
                                                        src="{{ URL::asset('/assets/image/home/directions_subway.png') }}">
                                                    {{ $home->train_name }}
                                                </p>
                                            @endif
                                        @endif

                                        <p class="number-rooms text-ellipsis">
                                            <span class="img-icon-ri2">
                                                <img class="img-icon img-icon-ri"
                                                    src="{{ URL::asset('/assets/image/home/bed.png') }}">
                                                {{ $home->bedroom }} ห้องนอน
                                            </span>
                                            <span>
                                                <img class="img-icon img-icon-ri"
                                                    src="{{ URL::asset('/assets/image/home/screenshot_frame.png') }}">
                                                {{ $home->room_width }} ตร.ม.
                                            </span>
                                        </p>
                                    </div>

                                    @php
                                        $price = $home->sell_price;
                                        $priceString = (string) $price;
                                        if (strlen($priceString) > 6) {
                                            $priceString = str_replace(',', '', $priceString);
                                            $formattedPrice = number_format($priceString / 1000000, 1) . ' ล้าน';
                                            $price_sell = $formattedPrice;
                                        } else {
                                            $price_sell = number_format($home->sell_price) . ' บาท';
                                        }
                                    @endphp

                                    <div class="box-price-new">
                                        @if ($home->rental_price && $home->rent_sell == 'เช่า')
                                            <p class="price-new price-top">฿ {{ number_format($home->rental_price) }}/m
                                            </p>
                                        @endif
                                        @if ($home->sell_price && $home->rent_sell == 'ขาย')
                                            <p class="price-new price-top-sell">฿ {{ $price_sell }}</p>
                                        @endif

                                        @if ($home->sell_price && $home->rent_sell == 'เช่า/ขาย')
                                            <p class="price-new price-top-2">฿ {{ number_format($home->rental_price) }}/m
                                            </p>
                                            <p class="price-new price-top-sell2">฿ {{ $price_sell }}</p>
                                        @endif

                                        @if ($home->rent_sell == 'เช่า')
                                            <span
                                                class="rent-sell-primary absolute-rent-sell">{{ $home->rent_sell }}</span>
                                        @elseif ($home->rent_sell == 'ขาย')
                                            <span
                                                class="rent-sell-yellow absolute-rent-sell">{{ $home->rent_sell }}</span>
                                        @else
                                            <span class="rent-sell-green absolute-rent-sell">{{ $home->rent_sell }}</span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                    tabindex="0">
                    <div class="row">
                        @foreach ($dataHome as $home)
                            @php
                                $imgUrl = json_decode(htmlspecialchars_decode($home->image));
                            @endphp
                            <a href="{{ url('get-detall', $home->id) }}">
                                <div class="card-new">
                                    @if (Carbon\Carbon::parse($home->created_at)->diffInDays(Carbon\Carbon::now()) < 4)
                                        <div class="box-new">NEW</div>
                                    @endif
                                    <div class="box-img-new">
                                        <img class="img-0831 lazy"
                                            data-src="{{ URL::asset('/img/product/' . $imgUrl[0]) }}">
                                    </div>
                                    <div class="box-name-new">
                                        <p class="name-content">{{ $home->building_name }}</p>
                                        <p class="name-details">
                                            <img class="img-icon "
                                                src="{{ URL::asset('/assets/image/home/location_on.png') }}">
                                            {{ $home->districts_name_th }} {{ $home->amphures_name_th }}
                                            {{ $home->provinces_name_th }}
                                        </p>
                                        @if ($home->train_name != 'ไม่มี' && $home->train_name)
                                            @if ($home->time_arrive < '61')
                                                <p class="name-details">
                                                    <img class="img-icon"
                                                        src="{{ URL::asset('/assets/image/home/directions_subway.png') }}">
                                                    {{ $home->train_name }}
                                                </p>
                                            @endif
                                        @endif

                                        <p class="number-rooms text-ellipsis">
                                            <span class="img-icon-ri2">
                                                <img class="img-icon img-icon-ri"
                                                    src="{{ URL::asset('/assets/image/home/bed.png') }}">
                                                {{ $home->bedroom }} ห้องนอน
                                            </span>
                                            <span>
                                                <img class="img-icon img-icon-ri"
                                                    src="{{ URL::asset('/assets/image/home/screenshot_frame.png') }}">
                                                {{ $home->room_width }} ตร.ม.
                                            </span>
                                        </p>
                                    </div>

                                    @php
                                        $price = $home->sell_price;
                                        $priceString = (string) $price;
                                        if (strlen($priceString) > 6) {
                                            $priceString = str_replace(',', '', $priceString);
                                            $formattedPrice = number_format($priceString / 1000000, 1) . ' ล้าน';
                                            $price_sell = $formattedPrice;
                                        } else {
                                            $price_sell = number_format($home->sell_price) . ' บาท';
                                        }
                                    @endphp

                                    <div class="box-price-new">
                                        @if ($home->rental_price && $home->rent_sell == 'เช่า')
                                            <p class="price-new price-top">฿ {{ number_format($home->rental_price) }}/m
                                            </p>
                                        @endif
                                        @if ($home->sell_price && $home->rent_sell == 'ขาย')
                                            <p class="price-new price-top-sell">฿ {{ $price_sell }}</p>
                                        @endif

                                        @if ($home->sell_price && $home->rent_sell == 'เช่า/ขาย')
                                            <p class="price-new price-top-2">฿ {{ number_format($home->rental_price) }}/m
                                            </p>
                                            <p class="price-new price-top-sell2">฿ {{ $price_sell }}</p>
                                        @endif

                                        @if ($home->rent_sell == 'เช่า')
                                            <span
                                                class="rent-sell-primary absolute-rent-sell">{{ $home->rent_sell }}</span>
                                        @elseif ($home->rent_sell == 'ขาย')
                                            <span
                                                class="rent-sell-yellow absolute-rent-sell">{{ $home->rent_sell }}</span>
                                        @else
                                            <span class="rent-sell-green absolute-rent-sell">{{ $home->rent_sell }}</span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>


        </div>
        <div class="mt-5">
            {!! $dataHome->links() !!}

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title fs-5">
                        <img class="filter_alt-img" src="{{ URL::asset('/assets/image/home/filter_alt.png') }}">กรอง
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="user" id="myForm" method="POST" action="{{ route('search-data') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <p class="font-size-12-black">ประเภททรัพย์</p>
                        <div class="flex-direction-row">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="property_type" value="คอนโด"
                                    id="property_type1">
                                <label class="form-check-label check-icon" for="property_type1">
                                    <img class="property-img" src="{{ URL::asset('/assets/image/home/apartment.png') }}">
                                    <p class="font-size-12-black text-lr">คอนโด</p>
                                </label>
                            </div>
                            &nbsp; &nbsp; &nbsp; &nbsp;
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="property_type" value="บ้าน"
                                    id="property_type2">
                                <label class="form-check-label check-icon" for="property_type2">
                                    <img class="property-img" src="{{ URL::asset('/assets/image/home/cottage.png') }}">
                                    <p class="font-size-12-black text-lr-2">บ้าน</p>
                                </label>
                            </div>
                        </div>
                        <p class="font-size-12-black mt-21">ประเภทสัญญา</p>
                        <div class="flex-direction-row">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rent_sell" value="เช่า"
                                    id="rent_sell1">
                                <label class="form-check-label" for="rent_sell1">เช่า</label>
                            </div>
                            &nbsp; &nbsp; &nbsp; &nbsp;
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rent_sell" value="ขาย"
                                    id="rent_sell2">
                                <label class="form-check-label" for="rent_sell2">ขาย</label>
                            </div>
                            &nbsp; &nbsp; &nbsp; &nbsp;
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rent_sell" value="เช่า/ขาย"
                                    id="rent_sell3">
                                <label class="form-check-label" for="rent_sell3">เช่า/ขาย</label>
                            </div>
                        </div>
                        <p class="font-size-12-black mt-21">พื้นที่</p>
                        @include('layouts.address')

                        <p class="font-size-12-black mt-21">สถานีรถไฟฟ้า</p>
                        <img class="property-img" src="{{ URL::asset('/assets/image/home/directions_subway.png') }}">
                        @include('layouts.train_station')
                        <div class="box-button">
                            <button class="btn-search">ค้นหา</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.home_address')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));
            if ("IntersectionObserver" in window) {
                let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            let lazyImage = entry.target;
                            lazyImage.src = lazyImage.dataset.src;
                            lazyImage.classList.remove("lazy");
                            lazyImageObserver.unobserve(lazyImage);
                        }
                    });
                });
                lazyImages.forEach(function(lazyImage) {
                    lazyImageObserver.observe(lazyImage);
                });
            } else {
                // Fallback for older browsers
                let lazyLoad = function() {
                    lazyImages.forEach(function(img) {
                        if (img.getBoundingClientRect().top <= window.innerHeight && img
                            .getBoundingClientRect().bottom >= 0 && getComputedStyle(img).display !==
                            "none") {
                            img.src = img.dataset.src;
                            img.classList.remove("lazy");
                        }
                    });
                    if (lazyImages.length == 0) {
                        document.removeEventListener("scroll", lazyLoad);
                        window.removeEventListener("resize", lazyLoad);
                        window.removeEventListener("orientationchange", lazyLoad);
                    }
                };
                document.addEventListener("scroll", lazyLoad);
                window.addEventListener("resize", lazyLoad);
                window.addEventListener("orientationchange", lazyLoad);
            }
        });
    </script>
@endsection
