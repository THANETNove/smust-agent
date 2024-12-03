@extends('layouts.app')

@section('content')
    <div class="box-content-background" id="container">
        @foreach ($dataHome as $home)
            @php

                $imgUrl = json_decode(htmlspecialchars_decode($home->image));
                $count = count($imgUrl);

            @endphp
            <div id="container">

                <div class="image-box" data-images="{{ json_encode($imgUrl) }}">
                    <div class="mr-4">
                        <div class="sava-image">
                            <img class="save-link ml-16" id="link-url" src="{{ URL::asset('/assets/image/home/link.png') }}">
                            <img class="save-link" id="captureButton" src="{{ URL::asset('/assets/image/home/save.png') }}">
                        </div>
                        <img class="popup-trigger image-detall-1" src="{{ URL::asset('img/product/' . $imgUrl[0]) }}"
                            data-index="0">
                    </div>
                    @if ($count > 1)
                        <div class="flex-direction-column">
                            <img class="popup-trigger image-detall-2" src="{{ URL::asset('img/product/' . $imgUrl[1]) }}"
                                data-index="1">
                            @if ($count > 2)
                                <div class="image-opacity">
                                    <img class="popup-trigger image-detall-2"
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

            <div class="box-content " id="back-home">
                <div class="content-box flex-direction-row ml-24">
                    <a href="{{ url('/home') }}" class="box-call">
                        กลับ
                    </a>

                </div>
                @if (session('message'))
                    <p class="text-center " style="color: green"> {{ session('message') }}</p>
                @endif


            </div>
            <div class="box-content">
                <div class="content-box">
                    <p class="head-text-detall ml-24">{{ $home->building_name }}</p>
                    <div class="box-icon-favorite">

                        @php
                            $fav = DB::table('favorites')
                                ->where('id_product', $home->id)
                                ->where('user_id', Auth::user()->id)
                                ->first();
                        @endphp

                        <a href="{{ url('click-favorite', $home->id) }}">
                            @if (!$fav || $fav->status_favorites == 0)
                                <img class="icon-favorite" src="{{ URL::asset('/assets/image/welcome/favorite.png') }}">
                            @else
                                <svg width="100" height="100" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                    class="heart-icon">
                                    <path
                                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                </svg>
                            @endif
                        </a>


                    </div>
                    @php
                        $createdAt = \Carbon\Carbon::parse($home->created_at);
                    @endphp
                    <p class="period-text ml-24">โพสเมื่อ:
                        @if ($createdAt->isToday())
                            {{ $createdAt->format('H:i') }}
                        @else
                            {{ $createdAt->format('d-m-Y') }}
                        @endif
                    </p>
                    <div class="price-detall flex-justify-content mt-8">
                        @if ($home->rent_sell == 'เช่า')
                            <div class="flex-direction-row">
                                <span class="rent-sell-primary width-rent-sell">
                                    {{ $home->rent_sell }}
                                </span>
                                <p> {{ number_format($home->rental_price) }}/m</p>
                            </div>
                        @endif


                        @if ($home->rent_sell == 'ขาย')
                            <div class="flex-direction-row">
                                <span class="rent-sell-yellow width-rent-sell">
                                    {{ $home->rent_sell }}
                                </span>
                                <p> {{ number_format($home->sell_price) }} บาท</p>
                            </div>
                        @endif

                        @if ($home->rent_sell == 'เช่า/ขาย')
                            <div class="flex-direction-column">
                                <div class="flex-direction-row ">
                                    <span class="rent-sell-primary width-rent-sell mb-8">
                                        เช่า
                                    </span>
                                    <p> {{ number_format($home->rental_price) }}/m</p>
                                </div>
                                <div class="flex-direction-row ">
                                    <span class="rent-sell-green width-rent-sell">
                                        {{ $home->rent_sell }}
                                    </span>
                                    <p> {{ number_format($home->sell_price) }} บาท</p>
                                </div>
                            </div>
                        @endif


                        <div class="flex-direction-column">
                            @if ($home->rent == 'เช่า')
                                <div class="flex-direction-row">
                                    <span class="rent-sell-primary width-rent-sell">
                                        {{ $home->rent }}
                                    </span>
                                    <p> {{ number_format($home->rental_price) }}/m</p>
                                </div>
                            @endif
                            @if ($home->sell == 'ขาย')
                                <div class="flex-direction-row">
                                    <span class="rent-sell-yellow width-rent-sell">
                                        {{ $home->sell }}
                                    </span>
                                    <p> {{ number_format($home->sell_price) }} บาท</p>
                                </div>
                            @endif
                            @if ($home->rent_sell == 'เช่าซื้อ/ขายผ่อน')
                                <div class="flex-direction-row ">
                                    <span class="rent-sell-green width-rent-sell">
                                        {{ $home->rent_sell }}
                                    </span>

                                </div>
                            @endif
                        </div>



                    </div>

                    <nav class="mt-wealth">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                aria-selected="true">รายละเอียดทรัพย์
                                <span class="box-nav-link"></span>
                            </button>

                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                                type="button" role="tab" aria-controls="nav-profile" aria-selected="false">ส่วนนายหน้า
                                <span class="box-nav-link"></span>
                            </button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">

                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                            tabindex="0">
                            @if ($home->url_gps)
                                <div class="flex-direction-row margin-bottom-8 mt-27">
                                    <img class="icon-content" src="{{ URL::asset('/assets/image/home/map.png') }}">
                                    <a target="_blank" rel="noopener noreferrer" href="{{ $home->url_gps }}"
                                        class="text-content-dark_100  text-ellipsis">
                                        {{ $home->url_gps }}
                                    </a>
                                </div>
                            @endif


                            @if ($home->train_name)
                                @if ($home->time_arrive < '61')
                                    <p class="text-content-dark_100 margin-bottom-8  text-ellipsis">

                                        <img class="icon-content-2"
                                            src="{{ URL::asset('/assets/image/home/directions_subway.png') }}">
                                        {{ $home->time_arrive }} mins to <span
                                            class="text-decoration">{{ $home->train_name }}
                                        </span>
                                    </p>
                                @endif
                            @endif


                            <div class="flex-direction-break-word margin-bottom-8 mt-wealth">
                                <div class="box-content-icon">
                                    <img class="icon-content-2" src="{{ URL::asset('/assets/image/home/bed_2.png') }}">
                                    <span>{{ $home->bedroom }} ห้องนอน</span>
                                </div>
                                <div class="box-content-icon">
                                    <img class="icon-content-2" src="{{ URL::asset('/assets/image/home/shower.png') }}">
                                    <span>{{ $home->bathroom }} ห้องน้ำ</span>
                                </div>
                                <div class="box-content-icon">
                                    <img class="icon-content-2"
                                        src="{{ URL::asset('/assets/image/home/screenshot_frame2.png') }}">
                                    <span>{{ $home->room_width }} ตร.ม.</span>
                                </div>
                                @if ($home->studio == 'มี')
                                    <div class="box-content-icon">
                                        <img class="icon-content-2"
                                            src="{{ URL::asset('/assets/image/home/countertops.png') }}">
                                        <span>สตูดิโอ</span>
                                    </div>
                                @endif

                                <div class="box-content-icon">
                                    <img class="icon-content-2" src="{{ URL::asset('/assets/image/home/floor.png') }}">
                                    <span>ชั้น {{ $home->number_floors }}</span>
                                </div>
                                <div class="box-content-icon">
                                    <img class="icon-content-2" src="{{ URL::asset('/assets/image/home/weekend.png') }}">
                                    <span>ตกแต่ง{{ $home->decoration }}</span>
                                </div>
                            </div>
                            @if ($home->address)
                                <p class="text-content-dark_100 margin-bottom-8">
                                    <img class="icon-content-2"
                                        src="{{ URL::asset('/assets/image/home/location_on.png') }}">
                                    {{ $home->address }} &nbsp; {{ $home->districts_name_th }}&nbsp;
                                    {{ $home->amphures_name_th }} &nbsp; {{ $home->provinces_name_th }}
                                    &nbsp;
                                    {{ $home->zip_code }}
                                </p>
                            @endif
                            @if ($home->url_video)
                                @php
                                    // รับ URL ของ YouTube
                                    $videoUrl = $home->url_video;

                                    // แปลง URL ให้เป็นรูปแบบ embed
                                    $embedUrl = preg_replace(
                                        '/^https:\/\/www\.youtube\.com\/watch\?v=/',
                                        'https://www.youtube.com/embed/',
                                        $videoUrl,
                                    );
                                @endphp
                                <div class="box-highlights top-highlights">
                                    <p class="head-content">Video</p>
                                    <iframe src="{{ $embedUrl }}" height="300" width="100%"
                                        title="Iframe Example"></iframe>
                                </div>
                            @endif



                            <div class="box-highlights top-highlights">
                                <p class="head-content">ไฮไลท์อสังหา</p>
                                <p class="head-content2">รายละเอียด</p>
                                @if ($home->announcement_name)
                                    <p class="head-content2">{{ $home->announcement_name }}</p>
                                @endif
                                <p class="text-content">{!! $home->details !!}</p>

                                @if ($home->rent_sell == 'เช่า')
                                    @include('detall.reall_detall')
                                @elseif ($home->rent_sell == 'ขาย')
                                    @include('detall.sell_detall')
                                @elseif ($home->rent_sell == 'เช่า/ขาย')
                                    @include('detall.reall_detall')
                                    @include('detall.sell_detall')
                                @endif
                                @if ($home->rent == 'เช่า' && $home->rent_sell != 'เช่าซื้อ/ขายผ่อน')
                                    @include('detall.reall_detall')
                                @elseif ($home->sell == 'ขาย' && $home->rent_sell != 'เช่าซื้อ/ขายผ่อน')
                                    @include('detall.sell_detall')
                                @elseif ($home->rent_sell == 'เช่าซื้อ/ขายผ่อน')
                                    @include('detall.reall_detall')
                                    @include('detall.sell_detall')
                                @endif




                                <p class="head-content">สิ่งอำนวยความสะดวก</p>
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
                                    @php
                                        $facilities = json_decode($home->facilities, true);
                                    @endphp
                                    @if (!empty($facilities))
                                        @foreach ($facilities as $facility)
                                            <div class="w-50">
                                                <p rel="noopener noreferrer"
                                                    class="text-content-dark_100 margin-bottom-8">
                                                    <img class="icon-content-2"
                                                        src="{{ URL::asset('/assets/image/home/check.png') }}">
                                                    {{ $facility }}
                                                </p>
                                            </div>
                                        @endforeach
                                    @endif




                                </div>
                                @php
                                    $electricalAppliances = json_decode($home->electricalAppliance, true);
                                @endphp

                                @if (!empty($electricalAppliances))
                                    <p class="head-content">เครื่องใช้ไฟฟ้า</p>
                                    <div class="flex-direction-break-word">
                                        @foreach ($electricalAppliances as $appliance)
                                            <div class="w-50">
                                                <p rel="noopener noreferrer"
                                                    class="text-content-dark_100 margin-bottom-8">
                                                    <img class="icon-content-2"
                                                        src="{{ URL::asset('/assets/image/home/check.png') }}">
                                                    {{ $appliance }}
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif



                                @php
                                    $furnitureItems = json_decode($home->furniture, true);
                                @endphp

                                @if (!empty($furnitureItems))
                                    <p class="head-content">เฟอร์นิเจอร์</p>
                                    <div class="flex-direction-break-word">
                                        @foreach ($furnitureItems as $item)
                                            <div class="w-50">
                                                <p rel="noopener noreferrer"
                                                    class="text-content-dark_100 margin-bottom-8">
                                                    <img class="icon-content-2"
                                                        src="{{ URL::asset('/assets/image/home/check.png') }}">
                                                    {{ $item }}
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                            </div>
                            @if ($home->shopping_center)
                                <div class="box-highlights">
                                    <p class="head-content">สถานที่สำคัญใกล้เคียง</p>
                                    @php
                                        // ตรวจสอบและแก้ไขข้อมูล
                                        $shoppingCenters = is_array($home->shopping_center)
                                            ? $home->shopping_center
                                            : json_decode(str_replace("\n", '', $home->shopping_center), true);
                                        $schools = is_array($home->school)
                                            ? $home->school
                                            : json_decode(str_replace("\n", '', $home->school), true);
                                    @endphp

                                    {{-- แสดง Shopping Centers --}}
                                    <p rel="noopener noreferrer" class="text-content-dark_100 margin-bottom-8">
                                        <img class="icon-content-2"
                                            src="{{ URL::asset('/assets/image/welcome/local_mall.png') }}">
                                        ศูนย์การค้า
                                    </p>
                                    @foreach ($shoppingCenters as $shopping_center)
                                        @if ($shopping_center)
                                            <li rel="noopener noreferrer" class="text-content-dark_000 margin-bottom-8">

                                                {{ $shopping_center }}
                                            </li>
                                        @endif
                                    @endforeach

                                    {{-- แสดง Schools --}}
                                    <p rel="noopener noreferrer" class="text-content-dark_100 margin-bottom-8">
                                        <img class="icon-content-2"
                                            src="{{ URL::asset('/assets/image/welcome/school.png') }}">
                                        สถานศึกษา
                                    </p>
                                    @foreach ($schools as $school)
                                        @if ($school)
                                            <li rel="noopener noreferrer" class="text-content-dark_000 margin-bottom-8">
                                                {{ $school }}
                                            </li>
                                        @endif
                                    @endforeach



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
                            @endif


                            @if ($home->thereVarious)
                                @php
                                    $thereVarious = json_decode($home->thereVarious, true);

                                @endphp
                                <div class="flex-direction-break-word">

                                    @foreach ($thereVarious as $key => $value)
                                        @if (strlen($value) > 1)
                                            <div class="w-50">
                                                <p rel="noopener noreferrer"
                                                    class="text-content-dark_100 margin-bottom-8">
                                                    <img class="icon-content-2"
                                                        src="{{ URL::asset('/assets/image/home/check.png') }}">
                                                    {{ $value }}
                                                </p>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                            @endif
                        </div>
                        <div class="tab-pane fade " id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                            tabindex="0">
                            <div class="align-items-center mt-27 ">
                                @if ($home->files)
                                    <a href="{{ url(asset($home->files)) }}" target="_blank" rel="noopener noreferrer">
                                        <div class="box-contract">
                                            <img class="icon-content-3"
                                                src="{{ URL::asset('/assets/image/welcome/article.png') }}">สัญญา
                                        </div>
                                    </a>
                                @endif
                                <div class="box-report-property-sold" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">รายงานทรัพย์ขายแล้ว</div>


                            </div>

                            <p class="contact-owner">พื้นที่ร่าง caption</p>
                            @php
                                $dataCap = DB::table('captions')
                                    ->where('id_product', $home->id)
                                    ->where('user_id', Auth::user()->id)
                                    ->first();
                            @endphp
                            <form id="multiStepForm" class="multi-step-form" method="POST"
                                action="{{ route('caption-update', $home->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-4 position-relative">
                                    <textarea class="form-control" id="caption-textarea" name="details" style="min-height: 196px;height: auto;">
@if ($dataCap)
{{ $dataCap->details }}
@endif
</textarea>
                                    <img class="icon-edit2" id="edit2-btn"
                                        src="{{ URL::asset('/assets/image/welcome/edit2.png') }}">
                                    <img class="icon-edit3" id="icon-edit3"
                                        src="{{ URL::asset('/assets/image/welcome/content_copy.png') }}">
                                </div>
                                <button type="submit" id="submitBtn-textarea" class=" btn btn-primary mb-3"
                                    style="display: none">
                                    {{ __('บันทึก') }}
                                </button>
                            </form>


                            <p class="contact-owner mb-3">ติดต่อเจ้าของ</p>


                            @if (Auth::check())
                                @php
                                    $lineIsUrl = filter_var(Auth::user()->line_id, FILTER_VALIDATE_URL);
                                    $facebookIsUrl = filter_var(Auth::user()->facebook_id, FILTER_VALIDATE_URL);
                                @endphp

                                @if (Auth::user()->line_id)
                                    <div class="input_box">
                                        <input id="down_payment_amount" type="text" class="form-control col-12 r"
                                            value="{{ Auth::user()->line_id }}">
                                        <label style="margin-left: -16px">Line ID </label>
                                        <div class="position-contact">
                                            @if ($lineIsUrl)
                                                <a href="{{ Auth::user()->line_id }}" class="no-underline"
                                                    target="_blank" rel="noopener noreferrer">
                                                    <img class="ass-icon-line"
                                                        src="{{ URL::asset('/assets/image/home/line.png') }}">
                                                </a>
                                            @else
                                                <img class="ass-icon-line"
                                                    src="{{ URL::asset('/assets/image/home/line.png') }}"
                                                    onclick="copyLineID()">
                                                <script>
                                                    function copyLineID() {
                                                        var lineName = "{{ Auth::user()->line_id }}";
                                                        Swal.fire({
                                                            title: lineName,
                                                            text: "Line ID" + "\n\nถูกคัดลอกแล้ว!",
                                                            icon: 'success',
                                                            /*   showConfirmButton: false,
                                                              timer: 2000 */
                                                            showConfirmButton: true, // ปุ่มยืนยันจะไม่หายไปเอง
                                                            confirmButtonText: 'ปิด', // ข้อความบนปุ่มยืนยัน
                                                            customClass: {
                                                                confirmButton: 'swal-btn-down' // ตั้งชื่อคลาสสำหรับปุ่มยืนยัน
                                                            }
                                                        });
                                                        navigator.clipboard.writeText(lineName).then(function() {
                                                            console.log('Line ID ถูกคัดลอกไปยัง clipboard แล้ว');
                                                        }, function(err) {
                                                            console.error('ไม่สามารถคัดลอกข้อความได้:', err);
                                                        });
                                                    }
                                                </script>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @if (Auth::user()->facebook_id)
                                    <div class="input_box mt-3">
                                        <input id="down_payment_amount" type="text" class="form-control col-12 r"
                                            value="{{ Auth::user()->facebook_id }}">
                                        <label style="margin-left: -16px">Facebook </label>
                                        <div class="position-contact">
                                            @if ($facebookIsUrl)
                                                <a href="{{ Auth::user()->facebook_id }}" target="_blank"
                                                    rel="noopener noreferrer" class="no-underline">
                                                    <img class="ass-icon-line"
                                                        src="{{ URL::asset('/assets/image/home/facbook.png') }}">
                                                </a>
                                            @else
                                                <img class="ass-icon-line"
                                                    src="{{ URL::asset('/assets/image/home/facbook.png') }}"
                                                    onclick="copyFacebookID()">
                                                <script>
                                                    function copyFacebookID() {
                                                        var fbName = "{{ Auth::user()->facebook_id }}";
                                                        Swal.fire({
                                                            title: fbName,
                                                            text: "Facebook ID" + "\n\nถูกคัดลอกแล้ว!",
                                                            icon: 'success',
                                                            showConfirmButton: true, // ปุ่มยืนยันจะไม่หายไปเอง
                                                            confirmButtonText: 'ปิด', // ข้อความบนปุ่มยืนยัน
                                                            customClass: {
                                                                confirmButton: 'swal-btn-down' // ตั้งชื่อคลาสสำหรับปุ่มยืนยัน
                                                            }
                                                        });
                                                        navigator.clipboard.writeText(fbName).then(function() {
                                                            console.log('Facebook ID ถูกคัดลอกไปยัง clipboard แล้ว');
                                                        }, function(err) {
                                                            console.error('ไม่สามารถคัดลอกข้อความได้:', err);
                                                        });
                                                    }
                                                </script>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @if (Auth::user()->phone)
                                    <div class="input_box mt-3">
                                        <input id="down_payment_amount" type="text" class="form-control col-12 r"
                                            value="{{ Auth::user()->phone }}">
                                        <label style="margin-left: -16px">Phone </label>
                                        <div class="position-contact">
                                            <a href="tel:{{ Auth::user()->phone }}" rel="noopener noreferrer"
                                                class="no-underline">
                                                <img class="ass-icon-line"
                                                    src="{{ URL::asset('/assets/image/home/thone.png') }}">
                                            </a>
                                        </div>
                                    </div>

                                    @if ($home->user_phone != Auth::user()->phone)
                                        <div class="input_box mt-3">
                                            <input id="down_payment_amount" type="text" class="form-control col-12 r"
                                                value="{{ $home->user_phone }}">
                                            <label style="margin-left: -16px">Phone </label>
                                            <div class="position-contact">
                                                <a href="tel:{{ $home->user_phone }}" rel="noopener noreferrer"
                                                    class="no-underline">
                                                    <img class="ass-icon-line"
                                                        src="{{ URL::asset('/assets/image/home/thone.png') }}">
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @else
                            @endif

                        </div>
                    </div>
                </div>
            </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="know-property">คุณทราบได้อย่างไรว่าทรัพย์นี้ - ได้ลูกค้าแล้ว</p>
                    <form id="multiStepForm" class="multi-step-form" method="POST"
                        action="{{ route('report-product-update', $home->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-check">
                            <input class="form-check-input" name="report[]" type="checkbox"
                                value="โทรถามเจ้าของแล้ว - ติดจอง" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                โทรถามเจ้าของแล้ว - ติดจอง </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="report[]" type="checkbox"
                                value="เห็นว่าขายได้แล้วที่อื่น" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                เห็นว่าขายได้แล้วที่อื่น
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="report[]" type="checkbox" value="ฉันเป็นคนขายได้เอง"
                                id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                ฉันเป็นคนขายได้เอง </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="report[]" type="checkbox"
                                value="โทรถามเจ้าของแล้ว - ได้ผู้เช่า/ผู้ซื้อแล้ว" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                โทรถามเจ้าของแล้ว - ได้ผู้เช่า/ผู้ซื้อแล้ว
                            </label>
                        </div>
                        <button type="submit" class="btn btn-report">
                            รายงาน
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    @endforeach
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
            <button class="prev-btn" id="prev-btn" onclick="changeMedia(-1)">&#10094;</button>
            <button class="next-btn" id="next-btn" onclick="changeMedia(1)">&#10095;</button>
        </div>
    </div>



    </div>




    <script>
        document.getElementById('edit2-btn').addEventListener('click', function() {
            var submitBtn = document.getElementById('submitBtn-textarea');
            // Toggle the display of the button
            if (submitBtn.style.display === 'none') {
                submitBtn.style.display = 'block';
            } else {
                submitBtn.style.display = 'none';
            }
        });
        document.getElementById('icon-edit3').addEventListener('click', function() {
            // Get the textarea element
            var textArea = document.getElementById('exampleFormControlTextarea1');

            // Copy the content of the textarea to the clipboard
            navigator.clipboard.writeText(textArea.value).then(function() {
                alert('ข้อความถูกคัดลอกแล้ว!');
            }).catch(function(error) {
                console.error('การคัดลอกข้อความล้มเหลว:', error);
            });
        });

        var currentMedia = 0;
        var currentImages = []; // ตัวแปรนี้จะเก็บภาพสำหรับรายการปัจจุบัน

        document.querySelectorAll('.popup-trigger').forEach(function(element) {
            element.addEventListener('click', function() {
                // ดึงข้อมูลภาพจาก data-attribute ของ wel-image-box
                var imageBox = element.closest('.image-box');
                var images = JSON.parse(imageBox.getAttribute('data-images'));
                console.log("images", images);
                // เปิด popup และแสดงภาพ
                openPopup(parseInt(element.getAttribute('data-index')), images);
            });
        });

        function openPopup(index, images) {
            console.log("Opening popup with images: ", images);
            currentMedia = index;
            currentImages = images; // เก็บภาพใน currentImages
            showMedia(currentMedia, currentImages);

            var popup = document.getElementById('imagePopup');
            popup.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closePopup() {
            var popup = document.getElementById('imagePopup');
            popup.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        function changeMedia(direction) {
            currentMedia += direction;

            // ตรวจสอบว่า currentMedia ไม่เกินขอบเขตของ images array
            if (currentMedia < 0) {
                currentMedia = 0;
            }
            if (currentMedia >= currentImages.length) {
                currentMedia = currentImages.length - 1;
            }

            showMedia(currentMedia, currentImages);
        }

        function showMedia(index, images) {
            var prevBtn = document.getElementById("prev-btn");
            var nextBtn = document.getElementById("next-btn");

            // ตรวจสอบการแสดงผลปุ่ม next และ prev
            if (index >= images.length - 1) {
                nextBtn.style.display = "none";
            } else {
                nextBtn.style.display = "block";
            }
            if (index <= 0) {
                prevBtn.style.display = "none";
            } else {
                prevBtn.style.display = "block";
            }

            // แสดงภาพที่เลือก
            var popupMediaContainer = document.getElementById('popupMediaContainer');
            popupMediaContainer.innerHTML = '';

            var assetUrl = "{{ asset('img/product') }}";
            var img = document.createElement('img');
            img.src = assetUrl + "/" + images[index];
            popupMediaContainer.appendChild(img);
        }


        document.getElementById('save-image-btn').addEventListener('click', function() {
            if (currentImages[currentMedia]) {
                var assetUrl = "{{ asset('img/product') }}";
                var imageUrl = assetUrl + "/" + currentImages[currentMedia];
                saveImage(imageUrl);
            } else {
                console.error('No image found to save.');
            }
        });






        function saveAll() {
            var assetUrl = "{{ asset('img/product') }}";

            currentImages.forEach(function(item) {
                var imageUrl = assetUrl + '/' + item;
                saveImage(imageUrl);
            });
        }

        function saveImage(imageUrl) {
            var downloadLink = document.createElement('a');
            downloadLink.href = imageUrl;
            downloadLink.download = 'image.jpg';
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }


        function captureContainer(imageUrl) {
            var downloadLink = document.createElement('a');
            downloadLink.href = imageUrl;
            downloadLink.download = 'image.jpg';
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }

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
    <!-- Modal -->

@endsection
