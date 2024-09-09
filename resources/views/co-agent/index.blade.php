@extends('layouts.app')

@section('content')
    <div class="box-free-trial">
        <div @if (Auth::user()->plans > 0) class="free-trial-box-nav" @endif>
            <a href="javascript:void(0);" onclick="goBack()">
                <img class="free-go-back" src="{{ URL::asset('/assets/image/welcome/go-back.png') }}">
            </a>
            <p class="free-trial">หา co-agent ช่วยขาย</p>

        </div>
        <div class="box-announced">
            <p class="announced-property mb-3">ทรัพย์ที่ลงประกาศ</p>
            @foreach ($dataHomeQuery as $home)
                @php
                    $imgUrl = json_decode(htmlspecialchars_decode($home->image));
                @endphp
                <a href="{{ url('get-detall', $home->id) }}">
                    <div class="card-new">
                        {{--   @if (Carbon\Carbon::parse($home->created_at)->diffInDays(Carbon\Carbon::now()) < 4)
                            <div class="box-new">NEW</div>
                        @endif --}}
                        <div class="box-img-new">
                            <img class="img-0831 lazy" src="{{ URL::asset('/img/product/' . $imgUrl[0]) }}">
                        </div>
                        <div class="box-name-new">
                            <p class="name-content">{{ $home->building_name }}</p>
                            <p class="name-details">
                                <img class="img-icon " src="{{ URL::asset('/assets/image/home/location_on.png') }}">
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
                                    <img class="img-icon img-icon-ri" src="{{ URL::asset('/assets/image/home/bed.png') }}">
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
                                <span class="rent-sell-primary absolute-rent-sell">{{ $home->rent_sell }}</span>
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
            <a href="{{ url('co-create') }}">
                <img class="add-co" id="rectangle123" src="{{ URL::asset('/assets/image/welcome/add.png') }}">
            </a>
        </div>

    </div>
@endsection
