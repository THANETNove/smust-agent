@extends('layouts.app')

@section('content')
    @include('layouts.navbar_welcome')
    <div class="bg-navbar">
        <p class="integration-platform">แพลตฟอร์มรวมอสังหาริมทรัพย์<br> และนายหน้าฝีมือดี พร้อมช่วยคุณหาทรัพย์ที่ตรงใจ</p>
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
        <div class="box-or-agent">
            <div class="box-or">
                <p class="or-text">หรือ</p>
                <a href="{{ url('create-assets-customer') }}">
                    <div class="box-agent">ให้สามารถเอเจนท์ (SMUST Agent) ช่วยหาทรัพย์ตรงใจ</div>
                </a>

            </div>
        </div>

    </div>
    <div class="box-bg">
        <div class="location_away-box">
            <div>
                <img class="groups_2w" src="{{ URL::asset('/assets/image/welcome/location_away.png') }}">
                <a href="{{ url('co-create') }}">
                    <div class="deposit-assets-now">ฝากทรัพย์เลย</div>
                </a>

            </div>
            <div class="box-the-owner">
                <p class="text-the-owner ">สำหรับเจ้าของ</p>
                <li class="for-sale-rent-out">ฝากขาย-ปล่อยเช่ากับเราได้ภายใน 5 นาที<br>
                    <span style="margin-left: 22px">ไม่มีสัญญาปิดผูกมัด</span>
                </li>
                <li class="for-sale-rent-out">ส่งที่เดียว นายหน้า <span style="color:#FAA631">
                        @php
                            $userQuery = DB::table('users')->count();
                        @endphp
                        {{ $userQuery }}
                    </span> คนพร้อมช่วยขาย</li>
            </div>


        </div>
        <div class="box-line"></div>
        <div class="location_away-box">

            <div>
                <img class="groups_2w" src="{{ URL::asset('/assets/image/welcome/groups_2w.png') }}">
                <a href="{{ url('home-login') }}">
                    <div class="deposit-assets-now">สมัครนายหน้าเลย</div>
                </a>
            </div>
            <div class="box-the-owner">
                <p class="text-the-owner ">สมัครนายหน้าเลย</p>
                <li class="for-sale-rent-out">สมัครเป็นนายหน้า เพียง 299 บาท แล้วรับทรัพย์จากเจ้าของตรงมากมาย<br>
                    <span style="margin-left: 22px;color:#FAA631">แล้วรับทรัพย์จากเจ้าของตรงมากมาย</span>
                </li>
                <li class="for-sale-rent-out">ไม่ต้องแชร์ค่าคอมมิชชัน <br><span
                        style="margin-left: 22px;color:#FAA631">ไม่ต้องแชร์ค่าคอมมิชชัน ท่านรับไปเลยคนเดียว</span></li>
            </div>
        </div>
    </div>
    <p class="text-can-agent">SMUST Agent (สามารถเอเจนท์) คือ?</p>
    <div class="container-we">

        <ul class="nav nav-pills mb-3 box-nav-link-home-we" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link-home-we active" id="pills-home-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                    aria-selected="true">สำหรับเจ้าของ</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link-home-we" id="pills-profile-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                    aria-selected="false">สำหรับนายหน้า</button>
            </li>

        </ul>
        <div class="right-content">
            <p class="or-you-are">หรือท่านกำลังหาทรัพย์เช่า / หาซื้ออยู่...</p>
            <a href="{{ url('house-condo') }}">
                <div class="btn-find-search-now">ค้นหาเลย</div>
            </a>
        </div>


    </div>

    <div class="box-tab-content-we">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                tabindex="0">
                <div class="row justify-content-center img-value_easy-margin-top">
                    <div class="col-12 col-md-6 mb-4">
                        <img class="img-value_easy img-fluid w-100" src="{{ URL::asset('/assets/image/home/value.png') }}"
                            alt="Image 1">
                    </div>
                    <div class="col-12 col-md-6 mb-4">
                        <img class="img-value_easy img-fluid w-100"
                            src="{{ URL::asset('/assets/image/home/value2.png') }}" alt="Image 2">
                    </div>
                    <div class="col-12 text-center">
                        <img class="img-value_easy img-fluid w-100"
                            src="{{ URL::asset('/assets/image/home/value3.png') }}" alt="Image 3">
                    </div>
                </div>

                <div class="full-screen-center">
                    <a href="{{ url('co-create') }}">
                        <div class="btn-for-sale-rent-now">ฝากขาย / เช่าเลย</div>

                    </a>

                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                tabindex="0">

                <p class="we-are-platform">เราคือแพลตฟอร์มที่ถือว่าเป็น <span>“เครื่องมือ”</span> หรือ
                    <span>“ผู้ช่วยฝีมือดี”</span>
                    ให้กับนายหน้าเลยก็ว่าได้ ไม่ว่าจะเป็น....
                </p>
                <img class="match_easy" src="{{ URL::asset('/assets/image/home/Match_easy.png') }}">

                <div class="full-screen-center">
                    <a href="{{ url('interested-more') }}">
                        <div class="btn-for-sale-rent-now">สนใจรายละเอียดเพิ่มเติม</div>
                    </a>

                </div>
            </div>
        </div>
    </div>


    <div class="box-latest-announcement">
        <p class="text-latest-announcement-new">ประกาศล่าสุด <span>NEW</span></p>
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
                        <a href="{{ url('house-condo-details', $que->id) }}">
                            <div class="item" data-index="{{ $key }}">
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
                                        alt="Slide" style="{{ $index === 0 ? 'display: block;' : 'display: none;' }}">
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
                        </a>
                    @endforeach




                </div>
            </div>
        </div>
        <div class="full-screen-center">
            <a href="{{ url('house-condo') }}">
                <div class="btn-for-sale-rent-now" style="margin-bottom: 56px">ดูเพิ่มเติม</div>
            </a>
        </div>



    </div>



    <div class="box-latest-announcement-2">
        <div class="container-we">
            <ul class="nav nav-pills mb-3 box-nav-link-home-we-2" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link-home-we active" id="pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-home-2" type="button" role="tab" aria-controls="pills-home"
                        aria-selected="true">สำหรับเจ้าของ</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link-home-we" id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-profile-2" type="button" role="tab" aria-controls="pills-profile"
                        aria-selected="false">สำหรับนายหน้า</button>
                </li>

            </ul>
        </div>

        <div class="box-tab-content-we-2">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home-2" role="tabpanel"
                    aria-labelledby="pills-home-tab" tabindex="0">
                    <p class="summary-rental-process">สรุปขั้นตอนการปล่อยเช่า / หาผู้ซื้อแสนง่าย</p>
                    <p class="comprehensive-service">บริการครบวงจร หาลูกค้า บริการสัญญา และบริการหลังการขาย</p>

                    <div class="box-fa-all">
                        <img class="img-fa-all" src="{{ URL::asset('/assets/image/welcome/fa1.png') }}">
                        <img class="img-fa-all" src="{{ URL::asset('/assets/image/welcome/fa2.png') }}">
                        <img class="img-fa-all" src="{{ URL::asset('/assets/image/welcome/fa3.png') }}">
                        <img class="img-fa-all" src="{{ URL::asset('/assets/image/welcome/fa4.png') }}">
                        <img class="img-fa-all" src="{{ URL::asset('/assets/image/welcome/fa5.png') }}">
                    </div>

                </div>
                <div class="tab-pane fade" id="pills-profile-2" role="tabpanel" aria-labelledby="pills-profile-tab"
                    tabindex="0">

                    <p class="summary-rental-process">นอกจากนี้ เรายังมี...</p>
                    <div class="box-fa-all">
                        <img class="img-wa-all" src="{{ URL::asset('/assets/image/welcome/wa1.png') }}">
                        <img class="img-wa-all" src="{{ URL::asset('/assets/image/welcome/wa2.png') }}">
                        <img class="img-wa-all" src="{{ URL::asset('/assets/image/welcome/wa3.png') }}">
                        <img class="img-wa-all" src="{{ URL::asset('/assets/image/welcome/wa4.png') }}">
                    </div>
                    <p class="apply-premium-plan">หรือสมัคร Premium Plan เพื่อรับ....</p>
                </div>
            </div>
            <div class="box-have-personal-center">
                <div class="box-have-personal">
                    <div class="row">
                        <div class="col-ms-12 col-md-6">
                            <img class="img-3171-1"
                                src="{{ URL::asset('/assets/image/welcome/' . $professionals->image) }}">
                        </div>
                        <div class="col-ms-12 col-md-6 text-36171">
                            <p class="text-36171-head">{!! $professionals->website_head !!}</p>
                            <p class="text-36171-sell">{!! $professionals->website_price !!}</p>
                            <p class="having-online">{!! $professionals->website_details !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="frequently-asked-questions">
            <div class="row">
                <div class="col-ms-12 col-md-6 box-text-ask">
                    @foreach ($asked as $ask)
                        @if ($ask->status == 1)
                            <p>{!! $ask->asked_head !!}</p>
                        @endif
                    @endforeach

                </div>
                <div class="col-ms-12 col-md-6 accordion-flush-box ">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        @foreach ($asked as $key => $ask)
                            @if ($ask->status == 0)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $key }}">
                                        <button class="accordion-button collapsed asked_head-btn" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $key }}"
                                            aria-expanded="false" aria-controls="flush-collapse{{ $key }}">
                                            {!! $ask->asked_head !!}
                                        </button>
                                    </h2>
                                    <div id="flush-collapse{{ $key }}" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body text-asked-details">
                                            {!! $ask->asked_details !!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="box-cross-we"></div>
        <div class="box-words-smust-users">
            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- First carousel item -->

                    @foreach ($words as $key => $word)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }} w-100">
                            <div class="container my-5">
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-md-10">
                                        <div class="card testimonial-card text-center border-0">
                                            <div class="row-align-items-center">
                                                <div class="">
                                                    <img src="{{ URL::asset('/assets/image/welcome/bxs_quote-left.png') }}"
                                                        class="bxs_quote-left" alt="user">
                                                </div>
                                                <div class="">

                                                    <h5 class="card-title-smust">{!! $word->words_head !!}</h5>
                                                    <img src="{{ URL::asset('/assets/image/welcome/' . $word->words_image) }}"
                                                        class="frame-188" alt="user">
                                                    <p class="card-text-smust">{!! $word->words_details !!}</p>
                                                    <p class="card-subtitle">{!! $word->words_name !!}</p>

                                                </div>
                                                <div>
                                                    <img src="{{ URL::asset('/assets/image/welcome/bxs_quote-right.png') }}"
                                                        class="bxs_quote-right" alt="user">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach




                </div>

                <!-- Carousel controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="prev">
                    <img src="{{ URL::asset('/assets/image/welcome/arrow_back_ios_new.png') }}"
                        class="arrow_back_ios_new" alt="user">
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="next">
                    <img src="{{ URL::asset('/assets/image/welcome/arrow_next_ios_new.png') }}"
                        class="arrow_next_ios_new" alt="user">
                </button>
            </div>

        </div>
    </div>
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
