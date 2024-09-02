@extends('layouts.app')

@section('content')
    <div class="home-background">
        @include('headHome')
        @if (session('message'))
            <p class="message-text text-center mt-4"> {{ session('message') }}</p>
        @endif

        {{--    <div class="col-12">
            @if (Auth::user()->status != '0')
                @if (Auth::user()->status < 3)
                    @if ($number < 101)
                        <a href="{{ url('/create-content') }}" class="box-call ml-16">เพิ่ม</a>
                    @endif
                @else
                    <a href="{{ url('/create-content') }}" class="box-call ml-16">เพิ่ม</a>
                @endif
            @endif
        </div> --}}



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
                                        $rental_ = $home->rental_price;
                                        $rental_String = (string) $rental_;
                                        if (strlen($rental_String) > 6) {
                                            $rental_String = str_replace(',', '', $rental_String);
                                            $formatted_rental = number_format($rental_String / 1000000, 1) . ' ล้าน';
                                            $rental_price = $formatted_rental;
                                        } else {
                                            $rental_price = number_format($home->rental_price) . ' บาท';
                                        }
                                    @endphp


                                    <div class="box-width-rent-sell">
                                        @if ($home->rent_sell == 'เช่า')
                                            <span
                                                class="rent-sell-primary absolute-rent-sell">{{ $home->rent_sell }}</span>
                                        @elseif ($home->rent_sell == 'ขาย')
                                            <span class="rent-sell-yellow absolute-rent-sell">{{ $home->rent_sell }}</span>
                                        @elseif ($home->rent_sell == 'เช่า/ขาย' || $home->rent_sell == 'เช่าซื้อ/ขายผ่อน')
                                            <span class="rent-sell-green absolute-rent-sell">{{ $home->rent_sell }}</span>
                                        @endif

                                        @if ($home->rent == 'เช่า')
                                            <span class="rent-sell-primary absolute-rent-sell">{{ $home->rent }}</span>
                                        @endif

                                        @if ($home->sell == 'ขาย')
                                            <span class="rent-sell-yellow absolute-rent-sell">{{ $home->sell }}</span>
                                        @endif

                                        <div class="box-price-new">

                                            @if (($home->sell_price && $home->rent_sell == 'เช่า/ขาย') || $home->rent_sell == 'เช่าซื้อ/ขายผ่อน')
                                                <p class="price-new">฿
                                                    {{ number_format($home->rental_price) }}/m
                                                </p>
                                                <p class="price-new price-top-sell2">฿ {{ $price_sell }}</p>
                                            @else
                                                @if (($home->rental_price && $home->rent_sell == 'เช่า') || $home->rent == 'เช่า')
                                                    <p class="price-new">฿ {{ number_format($home->rental_price) }}/m
                                                    </p>
                                                @endif
                                                @if (($home->sell_price && $home->rent_sell == 'ขาย') || $home->sell == 'ขาย')
                                                    <p class="price-new">฿{{ $price_sell }}</p>
                                                @endif
                                            @endif


                                        </div>
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

                                        {{-- //*  ชุดเก่า --}}
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
                                            <p class="price-new price-top-sell2">฿{{ $price_sell }}</p>
                                        @endif



                                        @if ($home->rent_sell == 'เช่า' || $home->rent == 'เช่า')
                                            <span class="rent-sell-primary absolute-rent-sell">{{ $home->rent_sell }}
                                                {{ $home->rent }}</span>
                                        @endif

                                        @if ($home->rent_sell == 'ขาย' || $home->sell == 'ขาย')
                                            <span class="rent-sell-yellow absolute-rent-sell">{{ $home->rent_sell }}
                                                {{ $home->sell }}</span>
                                        @endif
                                        @if ($home->rent_sell == 'เช่าซื้อ/ขายผ่อน' || $home->rent_sell == 'เช่า/ขาย')
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
    @include('jsHome')
@endsection
