@extends('layouts.app')

@section('content')
    @include('layouts.navbar_welcome')
    <div class="box-all-details-wel">
        <a href="javascript:void(0);" onclick="goBack()">
            <p class="return-search"><span> <img class="east-img" id="link-url"
                        src="{{ URL::asset('/assets/image/welcome/east.png') }}"></span>กลับสู่หน้าค้นหา</p>
        </a>

        @php
            $count = 0;
        @endphp

        <div class="row">
            <div class="col-sm-12 col-md-8">
                @foreach ($dataHome as $home)
                    @php

                        $imgUrl = json_decode(htmlspecialchars_decode($home->image));
                        $count = count($imgUrl);

                    @endphp
                    <div id="container" style="margin-top: 22px">
                        <div class="wel-image-box">
                            <div class="mr-4">
                                <img class="popup-trigger wel-image-detall-1"
                                    src="{{ URL::asset('img/product/' . $imgUrl[0]) }}" data-index="0">
                            </div>
                            @if ($count > 1)
                                <div class="flex-direction-column">
                                    <img class="popup-trigger wel-image-detall-2"
                                        src="{{ URL::asset('img/product/' . $imgUrl[1]) }}" data-index="1">
                                    @if ($count > 2)
                                        <div class="wel-image-opacity">
                                            <img class="popup-trigger wel-image-detall-2"
                                                src="{{ URL::asset('img/product/' . $imgUrl[2]) }}" data-index="2">
                                            @if ($count > 3)
                                                <p class="number-image">+{{ $count - 3 }}</p>
                                            @endif

                                        </div>
                                    @endif
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="wel-box-name-details ">
                        <div class="rent-sell-wel">
                            @if ($home->rent_sell == 'เช่า')
                                <div class="flex-direction-row">
                                    <span class="rent-sell-primary width-rent-sell">
                                        {{ $home->rent_sell }}
                                    </span>
                                </div>
                            @endif

                            @if ($home->rent_sell == 'ขาย')
                                <div class="flex-direction-row">
                                    <span class="rent-sell-yellow width-rent-sell">
                                        {{ $home->rent_sell }}
                                    </span>
                                </div>
                            @endif

                            @if ($home->rent_sell == 'เช่า/ขาย')
                                <div class="flex-direction-column">
                                    <div class="flex-direction-row">
                                        <span class="rent-sell-primary width-rent-sell mb-8">
                                            เช่า
                                        </span>
                                    </div>
                                    <div class="flex-direction-row">
                                        <span class="rent-sell-green width-rent-sell">
                                            {{ $home->rent_sell }}
                                        </span>
                                    </div>
                                </div>
                            @endif

                            @if ($home->rent == 'เช่า')
                                <div class="flex-direction-row">
                                    <span class="rent-sell-primary width-rent-sell">
                                        {{ $home->rent }}
                                    </span>
                                </div>
                            @endif

                            @if ($home->sell == 'ขาย')
                                <div class="flex-direction-row">
                                    <span class="rent-sell-yellow width-rent-sell">
                                        {{ $home->sell }}
                                    </span>
                                </div>
                            @endif

                            @if ($home->rent_sell == 'เช่าซื้อ/ขายผ่อน')
                                <div class="flex-direction-row">
                                    <span class="rent-sell-green width-rent-sell">
                                        {{ $home->rent_sell }}
                                    </span>
                                </div>
                            @endif

                        </div>
                        <div class="wel-name-home-condo">
                            {{ $home->building_name }}
                        </div>
                        <!-- Corrected the col-md class here -->

                    </div>





                    @if ($home->rent_sell == 'เช่า/ขาย' || $home->rent_sell == 'เช่าซื้อ/ขายผ่อน')
                        <p class="rent-sell-wel-price">$ {{ number_format($home->rental_price) }}/m</p>
                        <p class="rent-sell-wel-price" style="margin-top: -8px">$ {{ number_format($home->sell_price) }}
                            บาท</p>
                    @else
                        @if ($home->rent_sell == 'เช่า' || $home->rent == 'เช่า')
                            <p class="rent-sell-wel-price">$ {{ number_format($home->rental_price) }}/m</p>
                        @endif
                        @if ($home->rent_sell == 'ขาย' || $home->sell == 'ขาย')
                            <p class="rent-sell-wel-price"
                                @if ($home->rent_sell == 'เช่า' || $home->rent == 'เช่า') style="margin-top: -8px" @endif>$
                                {{ number_format($home->sell_price) }} บาท</p>
                        @endif
                    @endif


                    <p class="name-details">
                        <img class="img-icon " src="{{ URL::asset('/assets/image/home/location_on.png') }}">
                        {{ $home->address }} &nbsp; {{ $home->districts_name_th }}&nbsp;
                        {{ $home->amphures_name_th }} &nbsp; {{ $home->provinces_name_th }}
                        &nbsp;
                        {{ $home->zip_code }}
                    </p>
                    <div class="flex-direction-row mb-2">
                        <img class="icon-content" src="{{ URL::asset('/assets/image/home/map.png') }}">
                        <a target="_blank" rel="noopener noreferrer" href="{{ $home->url_gps }}"
                            class="text-content-dark_100  text-ellipsis">
                            {{ $home->url_gps }}
                        </a>
                    </div>
                    <p class="text-content-dark_100 margin-bottom-8  text-ellipsis">

                        <img class="icon-content-2" src="{{ URL::asset('/assets/image/home/directions_subway.png') }}">
                        @if ($home->time_arrive)
                            {{ $home->time_arrive }} mins to
                        @endif <span class="text-decoration">
                            {{ $home->train_name }}
                        </span>
                    </p>
                    <div class="real-estate-information">
                        <p class="name-history-profile-p">ข้อมูลอสังหา</p>
                        <div class="flex-direction-break-word margin-bottom-8 mt-wealth">
                            <div class="box-content-icon-wel">
                                <img class="icon-content-2-wel-details"
                                    src="{{ URL::asset('/assets/image/welcome/bed.png') }}">
                                <span>{{ $home->bedroom }} ห้องนอน</span>
                            </div>
                            <div class="box-content-icon-wel">
                                <img class="icon-content-2-wel-details"
                                    src="{{ URL::asset('/assets/image/welcome/shower.png') }}">
                                <span>{{ $home->bathroom }} ห้องน้ำ</span>
                            </div>
                            <div class="box-content-icon-wel">
                                <img class="icon-content-2-wel-details"
                                    src="{{ URL::asset('/assets/image/welcome/screenshot_frame.png') }}">
                                <span>{{ $home->room_width }} ตร.ม.</span>
                            </div>
                            @if ($home->studio == 'มี')
                                <div class="box-content-icon-wel">
                                    <img class="icon-content-2-wel-details"
                                        src="{{ URL::asset('/assets/image/welcome/countertops.png') }}">
                                    <span>สตูดิโอ</span>
                                </div>
                            @endif

                            <div class="box-content-icon-wel">
                                <img class="icon-content-2-wel-details"
                                    src="{{ URL::asset('/assets/image/welcome/floor.png') }}">
                                <span>ชั้น {{ $home->number_floors }}</span>
                            </div>
                            <div class="box-content-icon-wel">
                                <img class="icon-content-2-wel-details"
                                    src="{{ URL::asset('/assets/image/welcome/weekend.png') }}">
                                <span>ตกแต่ง{{ $home->decoration }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="property-highlights-information">
                        <p class="name-history-profile-p">ไฮไลท์อสังหา</p>
                        <div class="row">
                            <div class="col-ms-12 col-md-4">
                                <p class="post-head-name">สิ่งอำนวยความสะดวก</p>
                                <div class="flex-direction-break-word">
                                    @if ($home->kitchen)
                                        <div class="w-50">
                                            <p rel="noopener noreferrer" class="text-content-dark_100 margin-bottom-8">
                                                <img class="icon-content-2"
                                                    src="{{ URL::asset('/assets/image/home/check.png') }}">
                                                ห้องครัว
                                            </p>
                                        </div>
                                    @endif

                                    @if ($home->fitness)
                                        <div class="w-50">
                                            <p rel="noopener noreferrer" class="text-content-dark_100 margin-bottom-8">
                                                <img class="icon-content-2"
                                                    src="{{ URL::asset('/assets/image/home/check.png') }}">
                                                ฟิตเนส
                                            </p>
                                        </div>
                                    @endif
                                    @if ($home->parking)
                                        <div class="w-50">
                                            <p rel="noopener noreferrer" class="text-content-dark_100 margin-bottom-8">
                                                <img class="icon-content-2"
                                                    src="{{ URL::asset('/assets/image/home/check.png') }}">
                                                ที่จอดรถ
                                            </p>
                                        </div>
                                    @endif
                                    @if ($home->bed)
                                        <div class="w-50">
                                            <p rel="noopener noreferrer" class="text-content-dark_100 margin-bottom-8">
                                                <img class="icon-content-2"
                                                    src="{{ URL::asset('/assets/image/home/check.png') }}">
                                                เตียง
                                            </p>
                                        </div>
                                    @endif
                                    @if ($home->wardrobe)
                                        <div class="w-50">
                                            <p rel="noopener noreferrer" class="text-content-dark_100 margin-bottom-8">
                                                <img class="icon-content-2"
                                                    src="{{ URL::asset('/assets/image/home/check.png') }}">
                                                ตู้เสื้อผ้า
                                            </p>
                                        </div>
                                    @endif
                                    @if ($home->air_conditioner)
                                        <div class="w-50">
                                            <p rel="noopener noreferrer" class="text-content-dark_100 margin-bottom-8">
                                                <img class="icon-content-2"
                                                    src="{{ URL::asset('/assets/image/home/check.png') }}">
                                                เครื่องปรับอากาศ
                                            </p>
                                        </div>
                                    @endif
                                    @if ($home->facilities)
                                        <div class="w-50">
                                            <p rel="noopener noreferrer" class="text-content-dark_100 margin-bottom-8">
                                                <img class="icon-content-2"
                                                    src="{{ URL::asset('/assets/image/home/check.png') }}">
                                                {{ $home->facilities }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-ms-12 col-md-4">
                                <p class="post-head-name">เครื่องใช้ไฟฟ้า</p>
                                <div class="flex-direction-break-word">
                                    @if ($home->electricalAppliance)
                                        <div class="w-50">
                                            <p rel="noopener noreferrer" class="text-content-dark_100 margin-bottom-8">
                                                <img class="icon-content-2"
                                                    src="{{ URL::asset('/assets/image/home/check.png') }}">
                                                {{ $home->electricalAppliance }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-ms-12 col-md-4">
                                <p class="post-head-name">เฟอร์นิเจอร์</p>
                                <div class="flex-direction-break-word">
                                    @if ($home->furniture)
                                        <div class="w-50">
                                            <p rel="noopener noreferrer" class="text-content-dark_100 margin-bottom-8">
                                                <img class="icon-content-2"
                                                    src="{{ URL::asset('/assets/image/home/check.png') }}">
                                                {{ $home->furniture }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="property-highlights-information">
                        <p class="name-history-profile-p">ไฮไลท์อสังหา</p>
                        <p> {!! $home->details !!}</p>
                    </div>
                    <div class="property-highlights-information">
                        <p class="name-history-profile-p">สถานที่สำคัญใกล้เคียง</p>
                        <div class="row">
                            <div class="col-ms-12 col-md-4">
                                @php
                                    // ตรวจสอบและแก้ไขข้อมูล
                                    $shoppingCenters = is_array($home->shopping_center)
                                        ? $home->shopping_center
                                        : json_decode(str_replace("\n", '', $home->shopping_center), true);
                                    $schools = is_array($home->school)
                                        ? $home->school
                                        : json_decode(str_replace("\n", '', $home->school), true);
                                @endphp
                                <p rel="noopener noreferrer" class="text-content-dark_100 margin-bottom-8">
                                    <img class="icon-content-2"
                                        src="{{ URL::asset('/assets/image/welcome/local_mall.png') }}">
                                    ศูนย์การค้า
                                </p>
                                @if ($shoppingCenters)
                                    @foreach ($shoppingCenters as $shopping_center)
                                        <li rel="noopener noreferrer" class="text-content-dark_000 margin-bottom-8">

                                            {{ $shopping_center }}
                                        </li>
                                    @endforeach
                                @endif


                            </div>
                            <div class="col-ms-12 col-md-4">
                                <p rel="noopener noreferrer" class="text-content-dark_100 margin-bottom-8">
                                    <img class="icon-content-2"
                                        src="{{ URL::asset('/assets/image/welcome/school.png') }}">
                                    สถานศึกษา
                                </p>
                                @if ($schools)
                                    @foreach ($schools as $school)
                                        <li rel="noopener noreferrer" class="text-content-dark_000 margin-bottom-8">
                                            {{ $school }}
                                        </li>
                                    @endforeach
                                @endif

                            </div>
                            <div class="col-ms-12 col-md-4">
                                <p rel="noopener noreferrer" class="text-content-dark_100 margin-bottom-8">
                                    <img class="icon-content-2"
                                        src="{{ URL::asset('/assets/image/welcome/storefront.png') }}">
                                    ร้านสะดวกซื้อ
                                </p>

                                @if ($home->meters_store)
                                    <li rel="noopener noreferrer" class="text-content-dark_000 margin-bottom-8">
                                        {{ $home->meters_store }}
                                    </li>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-sm-12 col-md-4">
                Column
            </div>


        </div>

        <p class="property-nearby-area">ทรัพย์ในพื้นที่ใกล้เคียง</p>
        <div>
            <div class="owl-carousel owl-theme">
                @foreach ($welcomeQuery as $key => $que)
                    @php
                        $price = $que->sell_price;
                        $priceString = (string) $price;
                        if (strlen($priceString) > 6) {
                            $priceString = str_replace(',', '', $priceString);
                            $formattedPrice = number_format($priceString / 1000000, 1) . ' ล้าน';
                            $price_sell = $formattedPrice;
                        } else {
                            $price_sell = number_format($que->sell_price) . ' บาท';
                        }
                        $rental_ = $que->rental_price;
                        $rental_String = (string) $rental_;
                        if (strlen($rental_String) > 6) {
                            $rental_String = str_replace(',', '', $rental_String);
                            $formatted_rental = number_format($rental_String / 1000000, 1) . ' ล้าน';
                            $rental_price = $formatted_rental;
                        } else {
                            $rental_price = number_format($que->rental_price) . ' บาท';
                        }

                        $imgUrl = json_decode(htmlspecialchars_decode($que->image));
                    @endphp
                    <div class="item-home-condo item" data-index="{{ $key }}">
                        <div class="rent_sell-box-we">
                            @if ($que->rent_sell == 'เช่า')
                                <span class="rent-sell-primary absolute-rent-sell">{{ $que->rent_sell }}</span>
                            @elseif ($que->rent_sell == 'ขาย')
                                <span class="rent-sell-yellow absolute-rent-sell">{{ $que->rent_sell }}</span>
                            @elseif ($que->rent_sell == 'เช่า/ขาย' || $que->rent_sell == 'เช่าซื้อ/ขายผ่อน')
                                <span class="rent-sell-green absolute-rent-sell">{{ $que->rent_sell }}</span>
                            @endif

                            @if ($que->rent == 'เช่า')
                                <span class="rent-sell-primary absolute-rent-sell">{{ $que->rent }}</span>
                            @endif

                            @if ($que->sell == 'ขาย')
                                <span class="rent-sell-yellow absolute-rent-sell">{{ $que->sell }}</span>
                            @endif
                        </div>
                        <button class="prev-btn2" onclick="changeImage(event, -1)">
                            <span>
                                < </span>
                        </button>
                        @foreach ($imgUrl as $index => $image)
                            <img class="sliderImage" src="{{ URL::asset('img/product/' . $image) }}" alt="Slide"
                                style="{{ $index === 0 ? 'display: block;' : 'display: none;' }}">
                        @endforeach
                        <button class="next-btn2" onclick="changeImage(event, 1)">
                            <span> > </span>
                        </button>
                        <p class="building_name-we">{{ $que->building_name }}</p>



                        <div class="box-width-rent-sell">
                            <div class="box-price-new-we">
                                @if (($que->sell_price && $que->rent_sell == 'เช่า/ขาย') || $que->rent_sell == 'เช่าซื้อ/ขายผ่อน')
                                    <p class="price-new-we">฿
                                        {{ number_format($que->rental_price) }}/m
                                    </p>
                                    <p class="price-new-we">฿ {{ $price_sell }}</p>
                                @else
                                    @if (($que->rental_price && $que->rent_sell == 'เช่า') || $que->rent == 'เช่า')
                                        <p class="price-new-we">฿ {{ number_format($que->rental_price) }}/m
                                        </p>
                                    @endif
                                    @if (($que->sell_price && $que->rent_sell == 'ขาย') || $que->sell == 'ขาย')
                                        <p class="price-new-we">฿{{ $price_sell }}</p>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <p class="provinces-we">
                            <img class="location_on-we" src="{{ URL::asset('/assets/image/home/location_on.png') }}"
                                alt="Slide">
                            {{ $que->districts_name_th }} {{ $que->amphures_name_th }}
                            {{ $que->provinces_name_th }}
                        </p>
                        <p class="number-rooms text-ellipsis img-we">
                            <span class="img-icon-ri2 img-we" style="margin-right: 12px">
                                <img class="img-icon img-icon-ri" src="{{ URL::asset('/assets/image/home/bed.png') }}">
                                {{ $que->bedroom }} ห้องนอน
                            </span>
                            <span class="img-icon-ri2 img-we">
                                <img class="img-icon img-icon-ri"
                                    src="{{ URL::asset('/assets/image/home/screenshot_frame.png') }}">
                                {{ $que->room_width }} ตร.ม.
                            </span>
                        </p>

                        <div class="flex-direction-break-word margin-bottom-8 mt-wealth">
                            <div class="box-content-icon">
                                <img class="icon-content-2-we" src="{{ URL::asset('/assets/image/home/bed_2.png') }}">
                                <span>{{ $que->bedroom }} ห้องนอน</span>
                            </div>
                            <div class="box-content-icon">
                                <img class="icon-content-2-we" src="{{ URL::asset('/assets/image/home/shower.png') }}">
                                <span>{{ $que->bathroom }} ห้องน้ำ</span>
                            </div>
                            <div class="box-content-icon">
                                <img class="icon-content-2-we"
                                    src="{{ URL::asset('/assets/image/home/screenshot_frame2.png') }}">
                                <span>{{ $que->room_width }} ตร.ม.</span>
                            </div>
                            @if ($que->studio == 'มี')
                                <div class="box-content-icon">
                                    <img class="icon-content-2-we"
                                        src="{{ URL::asset('/assets/image/home/countertops.png') }}">
                                    <span>สตูดิโอ</span>
                                </div>
                            @endif

                            <div class="box-content-icon">
                                <img class="icon-content-2-we" src="{{ URL::asset('/assets/image/home/floor.png') }}">
                                <span>ชั้น {{ $que->number_floors }}</span>
                            </div>
                            <div class="box-content-icon">
                                <img class="icon-content-2-we" src="{{ URL::asset('/assets/image/home/weekend.png') }}">
                                <span>ตกแต่ง{{ $que->decoration }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach




            </div>
        </div>
    </div>

    <div class="popup" id="imagePopup">
        <div class="popup-content">

            <div id="popupMediaContainer">
            </div>

            <span class="close-btn" onclick="closePopup()">&times;</span>
            <span class="save-image-btn" id="save-image-btn">
                <img class="icon-save" src="{{ URL::asset('/assets/image/home/save_icon_152542.png') }}">
            </span>
            {{--   <span class="save-image-btn-all" id="save-all-images-btn">
                <img class="icon-save" src="{{ URL::asset('/assets/image/home/save_icon_152542.png') }}"> --}}

            </span>
            <button class="prev-btn " id="prev-btn" onclick="changeMedia(-1)">&#10094;</button>
            <button class="next-btn" id="next-btn" onclick="changeMedia(1)">&#10095;</button>
        </div>
    </div>
    <div class="popup" id="imagePopup">
        <div class="popup-content">
            <img id="popupImage" src="" alt="Popup Image">
            <span class="close-btn" onclick="closePopup()">&times;</span>
        </div>
    </div>
    @include('detall.javascript_popupImage')




    @include('layouts.footer_welocome')
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 3000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    },
                    1200: {
                        items: 4
                    }

                }
            });
        });
    </script>
@endsection
