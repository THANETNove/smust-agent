@extends('layouts.app')

@section('content')
    @include('layouts.navbar_welcome')
    <div class="bg-navbar-home-condo">
        <div class="search-welcome-home-condo">
            <form method="POST" action="{{ route('house-condo') }}" enctype="multipart/form-data">
                @csrf
                <div class="search-welcome-box mb-3">
                    <div>
                        <input type="radio" id="rent" name="property-type" value="เช่า" checked>
                        <label for="rent" class="search-text-head">เช่า</label>
                    </div>

                    <div>
                        <input type="radio" id="buy" name="property-type" value="ซื้อ">
                        <label for="buy" class="search-text-head">ซื้อ</label>
                    </div>

                    <div>
                        <input type="radio" id="owner-financing" name="property-type" value="ownerFinancing">
                        <label for="owner-financing" class="search-text-head2 head-new">ผ่อนตรงเจ้าของ
                            <span style="color: #E34234">(NEW)</span>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-12 col-sm-2">
                        <select class="form-select" aria-label="Default select example">
                            <option selected disabled>ประเภททรัพย์</option>
                            <option value="บ้านเดี่ยว">บ้านเดี่ยว</option>
                            <option value="คอนโด">คอนโด </option>
                            <option value="ทาวน์เฮ้าส์">ทาวน์เฮ้าส์</option>
                            <option value="ที่ดิน">ที่ดิน</option>
                            <option value="พาณิชย์">พาณิชย์</option>
                        </select>
                    </div>
                    <div class="mb-3  col-12 col-sm-3">
                        <input type="text" class="form-control" data-bs-toggle="modal" name="stations" id="stations"
                            data-bs-target="#exampleModalWelocome" placeholder="ค้นหาด้วยทำเล รถไฟฟ้า" readonly>

                    </div>

                    <div class="mb-3  col-12 col-sm-2">
                        <input type="text" class="form-control" data-bs-toggle="modal" name="welocome_filter"
                            id="welocome_filter" data-bs-target="#exampleModalWelocomeFilter" placeholder="กรอง" readonly>

                    </div>
                    <div class="mb-3  col-12 col-sm-2">
                        <input type="text" class="form-control" data-bs-toggle="modal" name="sort_by" id="sort-by"
                            data-bs-target="#exampleModalWelocomeSortBy" placeholder="เรียงตาม" readonly>

                    </div>
                    @include('layouts.model_welcome')
                    <div class="mb-3  col-12 col-sm-3">
                        <button type="submit" class="btn-find-out-now">ค้นหาเลย!</button>

                    </div>
                </div>
            </form>
        </div>
        <div class="box-or-agent-we">
            <div class="box-or">
                <p class="or-text">หรือ</p>
                <a href="{{ url('co-create') }}">
                    <div class="box-agent">ให้สามารถเอเจนท์ (SMUST Agent) ช่วยหาทรัพย์ตรงใจ</div>
                </a>

            </div>
        </div>
    </div>
    <p class="all-search-results">ผลการค้นหาทั้งหมด </p>
    <div class="box-all-search-results">

        @foreach ($weData as $key => $que)
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
                            <img class="icon-content-2-we" src="{{ URL::asset('/assets/image/home/countertops.png') }}">
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
    @include('layouts.footer_welocome')
@endsection
