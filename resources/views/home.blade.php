@extends('layouts.app')

@section('content')
    @php

        $currentDate = Carbon\Carbon::now(); // วันและเวลาปัจจุบัน
        $userCreatedDate = Carbon\Carbon::parse(Auth::user()->created_at); // วันที่ของผู้ใช้
        $createdDate = $userCreatedDate->lessThan($currentDate->subDays(3));
        $authCount = Auth::user()->plans == 0 && $createdDate ? 1 : 2;
    @endphp


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
                        @if ($authCount == 1)
                            @foreach ($dataHome2->take(10) as $home2)
                                @php
                                    $imgUrl = json_decode(htmlspecialchars_decode($home2->image));
                                @endphp
                                <a href="{{ url('get-detall', $home2->id) }}">
                                    <div class="card-new">
                                        @if (Carbon\Carbon::parse($home2->created_at)->diffInDays(Carbon\Carbon::now()) < 4)
                                            <div class="box-new">NEW</div>
                                        @endif
                                        <div class="box-img-new">
                                            <img class="img-0831 lazy" loading="lazy"
                                                data-src="{{ URL::asset('img/product/' . $imgUrl[0]) }}">
                                        </div>
                                        <div class="box-name-new">
                                            <p class="name-content">{{ $home2->building_name }}</p>
                                            <p class="name-details">
                                                <img class="img-icon " loading="lazy"
                                                    src="{{ URL::asset('/assets/image/home/location_on.png') }}">
                                                {{ $home2->districts_name_th }} {{ $home2->amphures_name_th }}
                                                {{ $home2->provinces_name_th }}
                                            </p>
                                            @if ($home2->train_name != 'ไม่มี' && $home2->train_name)
                                                @if ($home2->time_arrive < '61')
                                                    <p class="name-details">
                                                        <img class="img-icon" loading="lazy"
                                                            src="{{ URL::asset('/assets/image/home/directions_subway.png') }}">
                                                        {{ $home2->train_name }}
                                                    </p>
                                                @endif
                                            @endif

                                            <p class="number-rooms text-ellipsis">
                                                <span class="img-icon-ri2">
                                                    <img class="img-icon img-icon-ri" loading="lazy"
                                                        src="{{ URL::asset('/assets/image/home/bed.png') }}">
                                                    {{ $home2->bedroom }} ห้องนอน
                                                </span>
                                                <span>
                                                    <img class="img-icon img-icon-ri" loading="lazy"
                                                        src="{{ URL::asset('/assets/image/home/screenshot_frame.png') }}">
                                                    {{ $home2->room_width }} ตร.ม.
                                                </span>
                                            </p>
                                            @if ($home2->number_floors)
                                                <p class="number-rooms text-ellipsis">
                                                    <span class="img-icon-ri2">
                                                        <img class="img-icon img-icon-ri" loading="lazy"
                                                            src="{{ URL::asset('/assets/image/home/floor.png') }}">
                                                        {{ $home2->number_floors }} ชั้น
                                                    </span>
                                                </p>
                                            @endif

                                        </div>

                                        @php
                                            $price = $home2->sell_price;
                                            $priceString = (string) $price;
                                            if (strlen($priceString) > 6) {
                                                $priceString = str_replace(',', '', $priceString);
                                                $formattedPrice = number_format($priceString / 1000000, 1) . ' ล้าน';
                                                $price_sell = $formattedPrice;
                                            } else {
                                                $price_sell = number_format($home2->sell_price) . ' บาท';
                                            }
                                            $rental_ = $home2->rental_price;
                                            $rental_String = (string) $rental_;
                                            if (strlen($rental_String) > 6) {
                                                $rental_String = str_replace(',', '', $rental_String);
                                                $formatted_rental =
                                                    number_format($rental_String / 1000000, 1) . ' ล้าน';
                                                $rental_price = $formatted_rental;
                                            } else {
                                                $rental_price = number_format($home2->rental_price) . ' บาท';
                                            }
                                        @endphp


                                        <div class="box-width-rent-sell">
                                            @if ($home2->rent_sell == 'เช่า')
                                                <span
                                                    class="rent-sell-primary absolute-rent-sell">{{ $home2->rent_sell }}</span>
                                            @elseif ($home2->rent_sell == 'ขาย')
                                                <span
                                                    class="rent-sell-yellow absolute-rent-sell">{{ $home2->rent_sell }}</span>
                                            @elseif ($home2->rent_sell == 'เช่า/ขาย' || $home2->rent_sell == 'เช่าซื้อ/ขายผ่อน')
                                                <span
                                                    class="rent-sell-green absolute-rent-sell">{{ $home2->rent_sell }}</span>
                                            @endif

                                            @if ($home2->rent == 'เช่า')
                                                <span
                                                    class="rent-sell-primary absolute-rent-sell">{{ $home2->rent }}</span>
                                            @endif

                                            @if ($home2->sell == 'ขาย')
                                                <span
                                                    class="rent-sell-yellow absolute-rent-sell">{{ $home2->sell }}</span>
                                            @endif

                                            <div class="box-price-new">

                                                @if (($home2->sell_price && $home2->rent_sell == 'เช่า/ขาย') || $home2->rent_sell == 'เช่าซื้อ/ขายผ่อน')
                                                    <p class="price-new">฿
                                                        {{ number_format($home2->rental_price) }}/m
                                                    </p>
                                                    <p class="price-new price-top-sell2">฿ {{ $price_sell }}</p>
                                                @else
                                                    @if (($home2->rental_price && $home2->rent_sell == 'เช่า') || $home2->rent == 'เช่า')
                                                        <p class="price-new">฿ {{ number_format($home2->rental_price) }}/m
                                                        </p>
                                                    @endif
                                                    @if (($home2->sell_price && $home2->rent_sell == 'ขาย') || $home2->sell == 'ขาย')
                                                        <p class="price-new">฿{{ $price_sell }}</p>
                                                    @endif
                                                @endif


                                            </div>
                                        </div>


                                    </div>
                                </a>
                            @endforeach
                        @else
                            @foreach ($dataHome2 as $home2)
                                @php
                                    $imgUrl = json_decode(htmlspecialchars_decode($home2->image));
                                @endphp
                                <a href="{{ url('get-detall', $home2->id) }}">
                                    <div class="card-new">
                                        @if (Carbon\Carbon::parse($home2->created_at)->diffInDays(Carbon\Carbon::now()) < 4)
                                            <div class="box-new">NEW</div>
                                        @endif
                                        <div class="box-img-new">
                                            <img class="img-0831 lazy" loading="lazy"
                                                data-src="{{ URL::asset('img/product/' . $imgUrl[0]) }}">
                                        </div>
                                        <div class="box-name-new">
                                            <p class="name-content">{{ $home2->building_name }}</p>
                                            <p class="name-details">
                                                <img class="img-icon "
                                                    src="{{ URL::asset('/assets/image/home/location_on.png') }}">
                                                {{ $home2->districts_name_th }} {{ $home2->amphures_name_th }}
                                                {{ $home2->provinces_name_th }}
                                            </p>
                                            @if ($home2->train_name != 'ไม่มี' && $home2->train_name)
                                                @if ($home2->time_arrive < '61')
                                                    <p class="name-details">
                                                        <img class="img-icon" loading="lazy"
                                                            src="{{ URL::asset('/assets/image/home/directions_subway.png') }}">
                                                        {{ $home2->train_name }}
                                                    </p>
                                                @endif
                                            @endif

                                            <p class="number-rooms text-ellipsis">
                                                <span class="img-icon-ri2">
                                                    <img class="img-icon img-icon-ri" loading="lazy"
                                                        src="{{ URL::asset('/assets/image/home/bed.png') }}">
                                                    {{ $home2->bedroom }} ห้องนอน
                                                </span>
                                                <span>
                                                    <img class="img-icon img-icon-ri" loading="lazy"
                                                        src="{{ URL::asset('/assets/image/home/screenshot_frame.png') }}">
                                                    {{ $home2->room_width }} ตร.ม.
                                                </span>
                                            </p>
                                            @if ($home2->number_floors)
                                                <p class="number-rooms text-ellipsis">
                                                    <span class="img-icon-ri2">
                                                        <img class="img-icon img-icon-ri" loading="lazy"
                                                            src="{{ URL::asset('/assets/image/home/floor.png') }}">
                                                        {{ $home2->number_floors }} ชั้น
                                                    </span>
                                                </p>
                                            @endif

                                        </div>

                                        @php
                                            $price = $home2->sell_price;
                                            $priceString = (string) $price;
                                            if (strlen($priceString) > 6) {
                                                $priceString = str_replace(',', '', $priceString);
                                                $formattedPrice = number_format($priceString / 1000000, 1) . ' ล้าน';
                                                $price_sell = $formattedPrice;
                                            } else {
                                                $price_sell = number_format($home2->sell_price) . ' บาท';
                                            }
                                            $rental_ = $home2->rental_price;
                                            $rental_String = (string) $rental_;
                                            if (strlen($rental_String) > 6) {
                                                $rental_String = str_replace(',', '', $rental_String);
                                                $formatted_rental =
                                                    number_format($rental_String / 1000000, 1) . ' ล้าน';
                                                $rental_price = $formatted_rental;
                                            } else {
                                                $rental_price = number_format($home2->rental_price) . ' บาท';
                                            }
                                        @endphp


                                        <div class="box-width-rent-sell">
                                            @if ($home2->rent_sell == 'เช่า')
                                                <span
                                                    class="rent-sell-primary absolute-rent-sell">{{ $home2->rent_sell }}</span>
                                            @elseif ($home2->rent_sell == 'ขาย')
                                                <span
                                                    class="rent-sell-yellow absolute-rent-sell">{{ $home2->rent_sell }}</span>
                                            @elseif ($home2->rent_sell == 'เช่า/ขาย' || $home2->rent_sell == 'เช่าซื้อ/ขายผ่อน')
                                                <span
                                                    class="rent-sell-green absolute-rent-sell">{{ $home2->rent_sell }}</span>
                                            @endif

                                            @if ($home2->rent == 'เช่า')
                                                <span
                                                    class="rent-sell-primary absolute-rent-sell">{{ $home2->rent }}</span>
                                            @endif

                                            @if ($home2->sell == 'ขาย')
                                                <span
                                                    class="rent-sell-yellow absolute-rent-sell">{{ $home2->sell }}</span>
                                            @endif

                                            <div class="box-price-new">

                                                @if (($home2->sell_price && $home2->rent_sell == 'เช่า/ขาย') || $home2->rent_sell == 'เช่าซื้อ/ขายผ่อน')
                                                    <p class="price-new">฿
                                                        {{ number_format($home2->rental_price) }}/m
                                                    </p>
                                                    <p class="price-new price-top-sell2">฿ {{ $price_sell }}</p>
                                                @else
                                                    @if (($home2->rental_price && $home2->rent_sell == 'เช่า') || $home2->rent == 'เช่า')
                                                        <p class="price-new">฿ {{ number_format($home2->rental_price) }}/m
                                                        </p>
                                                    @endif
                                                    @if (($home2->sell_price && $home2->rent_sell == 'ขาย') || $home2->sell == 'ขาย')
                                                        <p class="price-new">฿{{ $price_sell }}</p>
                                                    @endif
                                                @endif


                                            </div>
                                        </div>


                                    </div>
                                </a>
                            @endforeach
                        @endif

                    </div>
                    @if ($authCount == 2)
                        <div class="mt-5">
                            {!! $dataHome2->links() !!}

                        </div>
                    @endif

                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                    tabindex="0">
                    <div class="row">
                        @if ($authCount == 1)
                            @foreach ($dataHome->take(10) as $home)
                                @php
                                    $imgUrl = json_decode(htmlspecialchars_decode($home->image));
                                @endphp
                                <a href="{{ url('get-detall', $home->id) }}">
                                    <div class="card-new">
                                        @if (Carbon\Carbon::parse($home->created_at)->diffInDays(Carbon\Carbon::now()) < 4)
                                            <div class="box-new">NEW</div>
                                        @endif
                                        <div class="box-img-new">
                                            <img class="img-0831 lazy" loading="lazy"
                                                data-src="{{ URL::asset('img/product/' . $imgUrl[0]) }}">
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
                                                        <img class="img-icon" loading="lazy"
                                                            src="{{ URL::asset('/assets/image/home/directions_subway.png') }}">
                                                        {{ $home->train_name }}
                                                    </p>
                                                @endif
                                            @endif

                                            <p class="number-rooms text-ellipsis">
                                                <span class="img-icon-ri2">
                                                    <img class="img-icon img-icon-ri" loading="lazy"
                                                        src="{{ URL::asset('/assets/image/home/bed.png') }}">
                                                    {{ $home->bedroom }} ห้องนอน
                                                </span>
                                                <span>
                                                    <img class="img-icon img-icon-ri" loading="lazy"
                                                        src="{{ URL::asset('/assets/image/home/screenshot_frame.png') }}">
                                                    {{ $home->room_width }} ตร.ม.
                                                </span>
                                            </p>
                                            @if ($home->number_floors)
                                                <p class="number-rooms text-ellipsis">
                                                    <span class="img-icon-ri2">
                                                        <img class="img-icon img-icon-ri" loading="lazy"
                                                            src="{{ URL::asset('/assets/image/home/floor.png') }}">
                                                        {{ $home->number_floors }} ชั้น
                                                    </span>
                                                </p>
                                            @endif
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
                                                $formatted_rental =
                                                    number_format($rental_String / 1000000, 1) . ' ล้าน';
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
                                                <span
                                                    class="rent-sell-yellow absolute-rent-sell">{{ $home->rent_sell }}</span>
                                            @elseif ($home->rent_sell == 'เช่า/ขาย' || $home->rent_sell == 'เช่าซื้อ/ขายผ่อน')
                                                <span
                                                    class="rent-sell-green absolute-rent-sell">{{ $home->rent_sell }}</span>
                                            @endif

                                            @if ($home->rent == 'เช่า')
                                                <span
                                                    class="rent-sell-primary absolute-rent-sell">{{ $home->rent }}</span>
                                            @endif

                                            @if ($home->sell == 'ขาย')
                                                <span
                                                    class="rent-sell-yellow absolute-rent-sell">{{ $home->sell }}</span>
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
                        @else
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
                                            <img class="img-0831 lazy" loading="lazy"
                                                data-src="{{ URL::asset('img/product/' . $imgUrl[0]) }}">
                                        </div>
                                        <div class="box-name-new">
                                            <p class="name-content">{{ $home->building_name }}</p>
                                            <p class="name-details">
                                                <img class="img-icon" loading="lazy"
                                                    src="{{ URL::asset('/assets/image/home/location_on.png') }}">
                                                {{ $home->districts_name_th }} {{ $home->amphures_name_th }}
                                                {{ $home->provinces_name_th }}
                                            </p>
                                            @if ($home->train_name != 'ไม่มี' && $home->train_name)
                                                @if ($home->time_arrive < '61')
                                                    <p class="name-details">
                                                        <img class="img-icon" loading="lazy"
                                                            src="{{ URL::asset('/assets/image/home/directions_subway.png') }}">
                                                        {{ $home->train_name }}
                                                    </p>
                                                @endif
                                            @endif

                                            <p class="number-rooms text-ellipsis">
                                                <span class="img-icon-ri2">
                                                    <img class="img-icon img-icon-ri" loading="lazy"
                                                        src="{{ URL::asset('/assets/image/home/bed.png') }}">
                                                    {{ $home->bedroom }} ห้องนอน
                                                </span>
                                                <span>
                                                    <img class="img-icon img-icon-ri" loading="lazy"
                                                        src="{{ URL::asset('/assets/image/home/screenshot_frame.png') }}">
                                                    {{ $home->room_width }} ตร.ม.
                                                </span>
                                            </p>
                                            @if ($home->number_floors)
                                                <p class="number-rooms text-ellipsis">
                                                    <span class="img-icon-ri2">
                                                        <img class="img-icon img-icon-ri" loading="lazy"
                                                            src="{{ URL::asset('/assets/image/home/floor.png') }}">
                                                        {{ $home->number_floors }} ชั้น
                                                    </span>
                                                </p>
                                            @endif
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
                                                $formatted_rental =
                                                    number_format($rental_String / 1000000, 1) . ' ล้าน';
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
                                                <span
                                                    class="rent-sell-yellow absolute-rent-sell">{{ $home->rent_sell }}</span>
                                            @elseif ($home->rent_sell == 'เช่า/ขาย' || $home->rent_sell == 'เช่าซื้อ/ขายผ่อน')
                                                <span
                                                    class="rent-sell-green absolute-rent-sell">{{ $home->rent_sell }}</span>
                                            @endif

                                            @if ($home->rent == 'เช่า')
                                                <span
                                                    class="rent-sell-primary absolute-rent-sell">{{ $home->rent }}</span>
                                            @endif

                                            @if ($home->sell == 'ขาย')
                                                <span
                                                    class="rent-sell-yellow absolute-rent-sell">{{ $home->sell }}</span>
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
                        @endif

                    </div>
                    @if ($authCount == 2)
                        <div class="mt-5">
                            {!! $dataHome->links() !!}

                        </div>
                    @endif
                </div>
            </div>


        </div>

    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        <img class="icon-filterData" loading="lazy"
                            src="{{ URL::asset('/assets/image/welcome/filterData.png') }}">

                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('search-data') }}">
                    @csrf

                    <div class="modal-body">
                        <p>เลือกทำเลจาก</p>

                        <div class="row-box">
                            <div class="filter-box selected" data-type="area" onclick="toggleSelection(this)">
                                <img class="icon-location" loading="lazy"
                                    src="{{ URL::asset('/assets/image/welcome/location_on.png') }}">
                                <p>ย่าน</p>
                            </div>
                            <div class="filter-box" data-type="station" onclick="toggleSelection(this)">
                                <img class="icon-location" loading="lazy"
                                    src="{{ URL::asset('/assets/image/welcome/train.png') }}">
                                <p>สถานีรถไฟฟ้า</p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <input type="text" id="area-station" name="area_station" value="area"
                                style="display: none">
                            <div class="id-address">
                                @include('layouts.address')
                            </div>

                            <div class="id-trainStation" style="display: none">
                                @include('assetsCustomer.trainStation2')
                            </div>

                        </div>
                        <p style="margin-top: 12px">ประเภทสัญญา</p>


                        <div class="row-box mb-4">
                            <div class="form-check-home">
                                <input class="form-check-input" type="radio" name="sale_rent" value="rent"
                                    id="filterArea" style="display: none">
                                <label class="form-check-label3" for="filterArea">
                                    เช่า
                                </label>
                            </div>

                            <div class="form-check-home">
                                <input class="form-check-input" type="radio" name="sale_rent" value="sale"
                                    id="filterStation" style="display: none">
                                <label class="form-check-label3" for="filterStation">
                                    ซื้อ
                                </label>
                            </div>

                            <div class="form-check-home">
                                <input class="form-check-input" type="radio" name="sale_rent" value="sale_rent"
                                    id="filterAll" style="display: none">
                                <label class="form-check-label3" for="filterAll">
                                    ทั้งหมด
                                </label>
                            </div>
                        </div>

                        <p style="margin-top: 12px">ประเภททรัพย์</p>
                        <div class="flex-direction-row mb-4">
                            <div class="form-check-home">
                                <input class="form-check-input" type="radio" name="property_type" value="บ้าน"
                                    id="property_type2" style="display: none">
                                <label class="form-check-label2" for="property_type2">
                                    <img class="property-img" loading="lazy"
                                        src="{{ URL::asset('/assets/image/home/cottage.png') }}">
                                    <p class="font-size-12-black">บ้าน</p>
                                </label>
                            </div>
                            <div class="form-check-home">
                                <input class="form-check-input" type="radio" name="property_type" value="คอนโด"
                                    id="property_type1" style="display: none">
                                <label class="form-check-label2 check-icon" for="property_type1">
                                    <img class="property-img" loading="lazy"
                                        src="{{ URL::asset('/assets/image/home/apartment.png') }}">
                                    <p class="font-size-12-black text-center">คอนโด</p>
                                </label>
                            </div>


                            <div class="form-check-home">
                                <input class="form-check-input" type="radio" name="property_type" value="ทาวน์เฮาส์"
                                    id="property_type3" style="display: none">
                                <label class="form-check-label2" for="property_type3">
                                    <img class="property-img" loading="lazy"
                                        src="{{ URL::asset('/assets/image/welcome/fluent_.png') }}">
                                    <p class="font-size-12-black">ทาวน์เฮาส์</p>
                                </label>
                            </div>
                            <div class="form-check-home">
                                <input class="form-check-input" type="radio" name="property_type" value="ที่ดิน"
                                    id="property_type4" style="display: none">
                                <label class="form-check-label2" for="property_type4">
                                    <img class="property-img" loading="lazy"
                                        src="{{ URL::asset('/assets/image/welcome/group_49.png') }}">
                                    <p class="font-size-12-black">ที่ดิน</p>
                                </label>
                            </div>
                            <div class="form-check-home">
                                <input class="form-check-input" type="radio" name="property_type" value="พาณิชย์"
                                    id="property_type5" style="display: none">
                                <label class="form-check-label2" for="property_type5">
                                    <img class="property-img" loading="lazy"
                                        src="{{ URL::asset('/assets/image/welcome/location_city.png') }}">
                                    <p class="font-size-12-black">พาณิชย์</p>
                                </label>
                            </div>
                        </div>

                        <select class="form-select mb-3" aria-label="Default select example" name="usable_area">
                            <option selected disabled>พื้นที่ใช้สอย</option>
                            <option value="29">น้อยกว่า 30 ตร.ม.</option>
                            <option value="30-50">30-50 ตร.ม.</option>
                            <option value="50-100">50-100 ตร.ม.</option>
                            <option value="100-1000">100-1,000 ตร.ม.</option>
                            <option value="1000-5000">1,000-5,000 ตร.ม.</option>
                            <option value="5001">มากกว่า 5,000 ตร.ม.</option>
                        </select>
                        <select class="form-select mb-3" aria-label="Default select example" name="price_range">
                            <option selected disabled>ช่วงราคา</option>
                            <option value="9999">น้อยกว่า 10,000 บาท</option>
                            <option value="10000-15000">10,000-15,0000 บาท</option>
                            <option value="15000-20000">15,000-20,000 บาท</option>
                            <option value="20000-30000">20,000-30,000 บาท</option>
                            <option value="30000-50000">30,000-50,000 บาท</option>
                            <option value="50000-100000">50,000-100,000 บาท</option>
                            <option value="100000-500000">100,000-500,000 บาท</option>
                            <option value="500000-1000000">500,000-1,000,000 บาท</option>
                            <option value="1000000-2000000">1-2 ล้าน</option>
                            <option value="2000000-3000000">2-3 ล้าน</option>
                            <option value="3000000-5000000">3-5 ล้าน</option>
                            <option value="5000000-10000000">5-10 ล้าน</option>
                            <option value="10000001">มากกว่า 10 ล้าน</option>
                        </select>
                        <select class="form-select" aria-label="Default select example" name="date_posted">
                            <option selected disabled>วันที่โพส</option>
                            <option value="1">วันนี้</option>
                            <option value="2">สัปดาห์นี้</option>
                            <option value="3">เดือนนี้</option>
                            <option value="4">1-6 เดือน</option>
                            <option value="5">6 เดือนขึ้นไป</option>
                        </select>
                        <button type="submit" class="btn btn-primary col-12 mt-4 mb-3"> <span> <img
                                    class="icon-search-box"
                                    src="{{ URL::asset('/assets/image/welcome/search-box.png') }}"></span>คันหา</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        <img class="icon-filterData" loading="lazy"
                            src="{{ URL::asset('/assets/image/welcome/filter.png') }}">

                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('search-data') }}">
                    @csrf

                    <div class="modal-body">




                        <div class="row-box mb-4">
                            <div class="form-check-search">
                                <input class="form-check-input" type="radio" name="too_little" value="price_min_max"
                                    id="filter1" style="display: none">
                                <label class="form-check-label4" for="filter1">
                                    ราคาจากน้อยไปมาก
                                </label>
                            </div>

                            <div class="form-check-search">
                                <input class="form-check-input" type="radio" name="too_little" value="price_max_min"
                                    id="filter2" style="display: none">
                                <label class="form-check-label4" for="filter2">
                                    ราคาจากมากไปน้อย
                                </label>
                            </div>

                        </div>

                        <p style="margin-top: 12px">พื้นที่ใช้สอย</p>
                        <div class="row-box mb-4">
                            <div class="form-check-search">
                                <input class="form-check-input" type="radio" name="too_little" value="area_max_min"
                                    id="filter3" style="display: none">
                                <label class="form-check-label4" for="filter3">
                                    จากมาก ไป น้อย
                                </label>
                            </div>

                            <div class="form-check-search">
                                <input class="form-check-input" type="radio" name="too_little" value="area_min_max"
                                    id="filter4" style="display: none">
                                <label class="form-check-label4" for="filter4">
                                    จากน้อย ไป มาก
                                </label>
                            </div>
                        </div>
                        <p style="margin-top: 12px">จํานวนชั้น / ชั้น</p>
                        <div class="row-box mb-4">
                            <div class="form-check-search">
                                <input class="form-check-input" type="radio" name="too_little" value="floors_max_min"
                                    id="filter5" style="display: none">
                                <label class="form-check-label4" for="filter5">
                                    จากมาก ไป น้อย
                                </label>
                            </div>

                            <div class="form-check-search">
                                <input class="form-check-input" type="radio" name="too_little" value="floors_min_max"
                                    id="filter6" style="display: none">
                                <label class="form-check-label4" for="filter6">
                                    จากน้อย ไป มาก
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary col-12 mt-4 mb-3"> <span> <img
                                    class="icon-search-box"
                                    src="{{ URL::asset('/assets/image/welcome/search-box.png') }}"></span>คันหา</button>
                </form>
            </div>
        </div>
    </div>

    @include('jsHome')
@endsection
