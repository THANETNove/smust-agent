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
    <div class="box-all-assets-head">
        <p class="search-for-assets">ค้นหาทรัพย์ได้เลย</p>
        <div class="container-box-free">
            <div class="search-welcome">
                <form method="POST" action="{{ route('house-condo') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="search-welcome-box mb-3">
                        <div>
                            <input type="radio" id="rent" name="sale_rent" value="rent" checked>
                            <label for="rent" class="search-text-head">เช่า</label>
                        </div>

                        <div>
                            <input type="radio" id="buy" name="sale_rent" value="sale">
                            <label for="buy" class="search-text-head">ซื้อ</label>
                        </div>

                        <div>
                            <input type="radio" id="owner-financing" name="sale_rent" value="ownerFinancing">
                            <label for="owner-financing" class="search-text-head2 head-new">ผ่อนตรงเจ้าของ
                                <span style="color: #E34234">(NEW)</span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-12 col-sm-4">
                            <select class="form-select" aria-label="Default select example" name="property_type">
                                <option selected disabled>ประเภททรัพย์</option>
                                <option value="บ้านเดี่ยว">บ้านเดี่ยว</option>
                                <option value="คอนโด">คอนโด </option>
                                <option value="ทาวน์เฮ้าส์">ทาวน์เฮ้าส์</option>
                                <option value="ที่ดิน">ที่ดิน</option>
                                <option value="พาณิชย์">พาณิชย์</option>
                            </select>
                        </div>
                        <div class="mb-3  col-12 col-sm-5">
                            <input type="text" class="form-control" data-bs-toggle="modal" name="stations" id="stations"
                                data-bs-target="#exampleModalWelocome" placeholder="ค้นหาด้วยทำเล รถไฟฟ้า" readonly>
                        </div>



                        <div class="mb-3  col-12 col-sm-3">
                            <button type="submit" class="btn-find-out-now">ค้นหาเลย!</button>

                        </div>
                    </div>
                    @include('layouts.model_welcome')

                </form>
            </div>
        </div>
    </div>
    <div class="box-all-assets-conter">
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
            <a href="{{ url('house-condo-details', $que->id) }}">
                <div class="item item-home-condo" data-index="{{ $key }}">
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
            </a>
        @endforeach
    </div>
    @include('layouts.footer_welocome')
@endsection
