@extends('layouts.app')

@section('content')
    <div class="box-announced-co">
        <div class="smust-co-head-box ">
            <img class="img-ellipse" src="{{ URL::asset('/assets/image/welcome/Ellipse.png ') }} ">

            <div class="back-co">
                {{-- <a href="javascript:void(0);" onclick="goBack()">
                    <img class="co-go-back" src="{{ URL::asset('/assets/image/welcome/go-back.png') }}">
                </a> --}}
                <p class="co-trial">เสร็จเรียบร้อย!</p>
            </div>


            <a href="{{ url('/') }}">
                <img class="img-smust" src="{{ URL::asset('/assets/image/welcome/SMUSTLogo.png') }}">
            </a>
        </div>
        <div class="box-announced">
            {{--  <p class="wealth-now">ทรัพย์ของท่านถึงมือนายหน้าทุกคนแล้ว</p> --}}
            <div class="card-shadow-center">
                <div class="card-shadow">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                            tabindex="0">
                            <div class="row">
                                @php
                                    $imgUrl = json_decode(htmlspecialchars_decode($member->image));

                                @endphp

                                <div class="card-new">
                                    @if (Carbon\Carbon::parse($member->created_at)->diffInDays(Carbon\Carbon::now()) < 4)
                                        <div class="box-new">NEW</div>
                                    @endif
                                    <div class="box-img-new">
                                        <img class="img-0831 lazyload" src="{{ URL::asset('/img/product/' . $imgUrl[0]) }}">
                                    </div>
                                    <div class="box-name-new">
                                        <p class="name-content">{{ $member->building_name }}</p>
                                        <p class="name-details">
                                            <img class="img-icon "
                                                src="{{ URL::asset('/assets/image/home/location_on.png') }}">
                                            {{ $member->districts_name_th }} {{ $member->amphures_name_th }}
                                            {{ $member->provinces_name_th }}
                                        </p>
                                        @if ($member->train_name != 'ไม่มี' && $member->train_name)
                                            @if ($member->time_arrive < '61')
                                                <p class="name-details">
                                                    <img class="img-icon" loading="lazy"
                                                        src="{{ URL::asset('/assets/image/home/directions_subway.png') }}">
                                                    {{ $member->train_name }}
                                                </p>
                                            @endif
                                        @endif

                                        <p class="number-rooms text-ellipsis">
                                            <span class="img-icon-ri2">
                                                <img class="img-icon img-icon-ri" loading="lazy"
                                                    src="{{ URL::asset('/assets/image/home/bed.png') }}">
                                                {{ $member->bedroom }} ห้องนอน
                                            </span>
                                            <span>
                                                <img class="img-icon img-icon-ri" loading="lazy"
                                                    src="{{ URL::asset('/assets/image/home/screenshot_frame.png') }}">
                                                {{ $member->room_width }} ตร.ม.
                                            </span>
                                        </p>
                                        @if ($member->number_floors)
                                            <p class="number-rooms text-ellipsis">
                                                <span class="img-icon-ri2">
                                                    <img class="img-icon img-icon-ri" loading="lazy"
                                                        src="{{ URL::asset('/assets/image/home/floor.png') }}">
                                                    {{ $member->number_floors }} ชั้น
                                                </span>
                                            </p>
                                        @endif

                                    </div>

                                    @php
                                        $price = $member->sell_price;
                                        $priceString = (string) $price;
                                        if (strlen($priceString) > 6) {
                                            $priceString = str_replace(',', '', $priceString);
                                            $formattedPrice = number_format($priceString / 1000000, 1) . ' ล้าน';
                                            $price_sell = $formattedPrice;
                                        } else {
                                            $price_sell = number_format($member->sell_price) . ' บาท';
                                        }
                                        $rental_ = $member->rental_price;
                                        $rental_String = (string) $rental_;
                                        if (strlen($rental_String) > 6) {
                                            $rental_String = str_replace(',', '', $rental_String);
                                            $formatted_rental = number_format($rental_String / 1000000, 1) . ' ล้าน';
                                            $rental_price = $formatted_rental;
                                        } else {
                                            $rental_price = number_format($member->rental_price) . ' บาท';
                                        }
                                    @endphp


                                    <div class="box-width-rent-sell">
                                        @if ($member->rent_sell == 'เช่า')
                                            <span
                                                class="rent-sell-primary absolute-rent-sell">{{ $member->rent_sell }}</span>
                                        @elseif ($member->rent_sell == 'ขาย')
                                            <span
                                                class="rent-sell-yellow absolute-rent-sell">{{ $member->rent_sell }}</span>
                                        @elseif ($member->rent_sell == 'เช่า/ขาย' || $member->rent_sell == 'เช่าซื้อ/ขายผ่อน')
                                            <span
                                                class="rent-sell-green absolute-rent-sell">{{ $member->rent_sell }}</span>
                                        @endif

                                        @if ($member->rent == 'เช่า')
                                            <span class="rent-sell-primary absolute-rent-sell">{{ $member->rent }}</span>
                                        @endif

                                        @if ($member->sell == 'ขาย')
                                            <span class="rent-sell-yellow absolute-rent-sell">{{ $member->sell }}</span>
                                        @endif

                                        <div class="box-price-new">

                                            @if (($member->sell_price && $member->rent_sell == 'เช่า/ขาย') || $member->rent_sell == 'เช่าซื้อ/ขายผ่อน')
                                                <p class="price-new">฿
                                                    {{ number_format($member->rental_price) }}/m
                                                </p>
                                                <p class="price-new price-top-sell2">฿ {{ $price_sell }}</p>
                                            @else
                                                @if (($member->rental_price && $member->rent_sell == 'เช่า') || $member->rent == 'เช่า')
                                                    <p class="price-new">฿ {{ number_format($member->rental_price) }}/m
                                                    </p>
                                                @endif
                                                @if (($member->sell_price && $member->rent_sell == 'ขาย') || $member->sell == 'ขาย')
                                                    <p class="price-new">฿{{ $price_sell }}</p>
                                                @endif
                                            @endif


                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <p class="system-successfully">ระบบได้บันทึกทรัพย์ของคุณเรียบร้อย! <br>
                เเละได้นำส่งให้หนายหน้า {{ number_format($countUser) }} คน</p>

            <div class="submit-box mb-3">
                <a href="{{ Auth::check() ? '/home' : '/' }}" class="btn btn-register">
                    กลับหน้าหลัก
                </a>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: "เสร็จเรียบร้อย!",
                icon: 'success',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
@endsection
