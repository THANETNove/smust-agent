@extends('layouts.app')

@section('content')
    @include('layouts.navbar_welcome')
    <div class="img-rectangle-1234"></div>
    <div class="box-rectangle-profile row">
        <div class="col-md-12 col-lg-8">
            <div class="row">
                <div class="col-md-12 col-lg-5"><img class="icon-user-contact-agent"
                        @if ($userQuery[0]->image) src="{{ URL::asset($userQuery[0]->image) }}" @else 
            src="{{ URL::asset('/assets/image/welcome/usercontact.jpg') }}" @endif>
                </div>
                <div class="col-md-12 col-lg-7 mt-lg-agent">
                    <p class="text-36171-head">{{ $userQuery[0]->first_name }} {{ $userQuery[0]->last_name }}</p>
                    <p class="premium-address">
                        <img class="icon-explore_nearby-premium"
                            src="{{ URL::asset('/assets/image/welcome/explore_nearby-pro.png') }}">
                        {{ $userQuery[0]->provinces }}
                    </p>
                </div>
            </div>



        </div>
        <div class="col-md-12 col-lg-4  mt-lg-agent-2">

            <div class="box-type-agent">
                <p> <img class="contract" src="{{ URL::asset('/assets/image/welcome/contract-wi.png') }}"> ประเภทสัญญา:
                    {{ $userQuery[0]->contract_type }}
                </p>
                <p> <img class="contract" src="{{ URL::asset('/assets/image/welcome/domain-wi.png') }}">
                    ประเภททรัพย์: {{ $userQuery[0]->property_type }}
                </p>
                <p> <img class="contract" src="{{ URL::asset('/assets/image/welcome/domain-wi.png') }}">
                    ลักษณะเฉพาะ: {{ $userQuery[0]->characteristics }}
                </p>

            </div>
            @php
                $lineIsUrl = filter_var($userQuery[0]->line_id, FILTER_VALIDATE_URL);
                $facebookIsUrl = filter_var($userQuery[0]->facebook_id, FILTER_VALIDATE_URL);
            @endphp
            @if ($userQuery[0]->line_id)
                <a
                    @if ($lineIsUrl) href="{{ $userQuery[0]->line_id }}"  target="_blank" @else onclick="copyLineID()" @endif>
                    <div class="box-contact-agent-profile">
                        <img class="btn-box-profile-icon-line" src="{{ URL::asset('/assets/image/home/line.png') }}">
                        <span> LINE ID:
                            {{ $userQuery[0]->line_id }}</span>
                    </div>
                </a>


                <script>
                    function copyLineID() {
                        var lineName = "{{ $userQuery[0]->line_id }}";
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

            @if ($userQuery[0]->facebook_id)
                <a
                    @if ($facebookIsUrl) href="{{ $userQuery[0]->facebook_id }}" target="_blank" @else onclick="copyFacebookID()" @endif>
                    <div class="box-contact-agent-profile">
                        <img class="btn-box-profile-icon-line" src="{{ URL::asset('/assets/image/home/facbook.png') }}">
                        <span> FB: {{ $userQuery[0]->facebook_id }}</span>
                    </div>
                </a>

                <script>
                    function copyFacebookID() {
                        var fbName = "{{ $userQuery[0]->facebook_id }}";
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

            @if ($userQuery[0]->phone)
                <a href="tel:{{ $userQuery[0]->phone }}" target="_blank" rel="noopener noreferrer">
                    <div class="box-contact-agent-profile">
                        <img class="btn-box-profile-icon-line" src="{{ URL::asset('/assets/image/home/thone.png') }}">
                        <span> Tel: {{ $userQuery[0]->phone }}</span>
                    </div>
                </a>
            @endif
        </div>

    </div>
    <div class="services-such">
        <p class="services-such-as-text">บริการ อาทิ</p>
        <div class="row">
            @foreach ($userQuery as $userQ)
                <div class="col-sm-12 col-md-4">
                    <div class="box-img-services-as">
                        <img class="img-services-as" src="{{ URL::asset($userQ->image_1) }}">
                        <p class="name-1-as">{{ $userQ->name_1 }}</p>
                        <p class="details-1-as">{{ $userQ->details_1 }}</p>
                    </div>

                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="box-img-services-as">
                        <img class="img-services-as" src="{{ URL::asset($userQ->image_2) }}">
                        <p class="name-1-as">{{ $userQ->name_2 }}</p>
                        <p class="details-1-as">{{ $userQ->details_2 }}</p>
                    </div>

                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="box-img-services-as">
                        <img class="img-services-as" src="{{ URL::asset($userQ->image_3) }}">
                        <p class="name-1-as">{{ $userQ->name_3 }}</p>
                        <p class="details-1-as">{{ $userQ->details_3 }}</p>
                    </div>

                </div>
            @endforeach

            {{--  <div class="col-sm-12 col-md-4">
                <img class="img-services-as" src="{{ URL::asset('/assets/image/welcome/image-2.png') }}">
            </div>
            <div class="col-sm-12 col-md-4">
                <img class="img-services-as" src="{{ URL::asset('/assets/image/welcome/image-3.png') }}">
            </div> --}}
        </div>
        <div class="btn-box-profile-center">
            <div class="contact-now-as">ติดต่อเลย</div>
        </div>
        <div class="row" style="margin-top: 67px">
            <div class="col-sm-12 col-md-3 ">
                <div style="display: flex;justify-content: flex-start;">
                    <div class="box-suct-number">
                        <div style="margin-right: 40px">
                            <p class="property-for-rent">ทรัพย์ให้เช่า</p>
                            <p class="text-for-rent">{{ $countRent }}</p>
                        </div>
                        <div>
                            <p class="property-for-rent">ทรัพย์พร้อมขาย</p>
                            <p class="text-for-rent">{{ $countSell }}</p>
                        </div>
                    </div>
                </div>
                <div class="contact-now-as-2">ติดต่อเลย</div>

            </div>
            <div class="col-sm-12 col-md-9">
                <div class="carousel-container">
                    <div class="container">
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
                                <div class="item" data-index="{{ $key }}" style="margin-right: 20px">
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
                                        <img class="sliderImage" src="{{ URL::asset('img/product/' . $image) }}"
                                            alt="Slide"
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
                                        <img class="location_on-we"
                                            src="{{ URL::asset('/assets/image/home/location_on.png') }}" alt="Slide">
                                        {{ $que->districts_name_th }} {{ $que->amphures_name_th }}
                                        {{ $que->provinces_name_th }}
                                    </p>
                                    <p class="number-rooms text-ellipsis img-we">
                                        <span class="img-icon-ri2 img-we" style="margin-right: 12px">
                                            <img class="img-icon img-icon-ri"
                                                src="{{ URL::asset('/assets/image/home/bed.png') }}">
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
                                            <img class="icon-content-2-we"
                                                src="{{ URL::asset('/assets/image/home/bed_2.png') }}">
                                            <span>{{ $que->bedroom }} ห้องนอน</span>
                                        </div>
                                        <div class="box-content-icon">
                                            <img class="icon-content-2-we"
                                                src="{{ URL::asset('/assets/image/home/shower.png') }}">
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
                                            <img class="icon-content-2-we"
                                                src="{{ URL::asset('/assets/image/home/floor.png') }}">
                                            <span>ชั้น {{ $que->number_floors }}</span>
                                        </div>
                                        <div class="box-content-icon">
                                            <img class="icon-content-2-we"
                                                src="{{ URL::asset('/assets/image/home/weekend.png') }}">
                                            <span>ตกแต่ง{{ $que->decoration }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <p class="highlight-as">Highlight</p>
    <div class="box-highlight-post-as">

        <div class="box-left-as"></div>


        <div class="box-center-as">

            @if ($postQuery->count() > 0)
                <img class="post-query-image" src="{{ URL::asset($postQuery[0]->image) }}">
                <div style="padding: 0px 10%">
                    <p class="name-as">{{ $postQuery[0]->name }}</p>
                    <p class="details-post-as">{{ $postQuery[0]->details_post }}</p>
                </div>
            @endif
            <p class="posts-as">Posts</p>

            @foreach ($postQuery as $postQ)
                <div class="box-posts-as-all">
                    <p class="name-as">{{ $postQ->name }}</p>
                    <img class="post-query-image" src="{{ URL::asset($postQ->image) }}">
                    <p class="details-post-as-all">{{ $postQ->details_post }}</p>
                </div>
            @endforeach


        </div>

        <div class="box-right-as"></div>

    </div>

    @include('layouts.footer_welocome')
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: false,
                dots: false,
                autoplay: true,
                autoplayTimeout: 3000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1.8
                    },
                    900: {
                        items: 2.5
                    },
                    1024: {
                        items: 2.2
                    },
                    1200: {
                        items: 3.2
                    },
                    1600: {
                        items: 3.8
                    },

                }
            });
        });
    </script>
@endsection
