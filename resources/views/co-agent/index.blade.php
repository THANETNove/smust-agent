@extends('layouts.app')

@section('content')
    <div class="box-free-trial">
        <div @if (Auth::user()->plans > 0) class="free-trial-box-nav" @endif>
            <a href="javascript:void(0);" onclick="goBack()">
                <img class="free-go-back" src="{{ URL::asset('/assets/image/welcome/go-back.png') }}">
            </a>
            <p class="free-trial">หา co-agent ช่วยขาย</p>
            @if (session('message'))
                <p class="text-center" style="color: green"> {{ session('message') }}</p>
            @endif


        </div>
        <div class="box-announced announced-background">
            <p class="announced-property mb-3">ทรัพย์ที่ลงประกาศ</p>
            @foreach ($dataHomeQuery as $home)
                @php
                    $imgUrl = json_decode(htmlspecialchars_decode($home->image));
                @endphp

                <div class="card-new2">
                    <div style="display: flex">
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
                        <div class="box-img-new2">
                            <img class="img-0831 lazy mb-2" src="{{ URL::asset('/img/product/' . $imgUrl[0]) }}">
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
                        </div>
                        <div class="box-name-new2">
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
                    </div>
                    <div>
                        <hr>
                        <a href="{{ url('co-users') }}">
                            <p class="co-agent-user"> <img class="co-agent-use-img"
                                    src="{{ URL::asset('/assets/image/welcome/diversity_3.png') }}">ดู
                                co-agent ที่ช่วยคุณขาย <img class="arrow_forward_ios"
                                    src="{{ URL::asset('/assets/image/welcome/arrow_forward_ios.png') }}"></p>
                        </a>

                        <hr>
                        <p class="remove-announcement" data-bs-toggle="modal" data-id="{{ $home->id }}"
                            data-bs-target="#exampleModalDe">
                            ลบออกจากประกาศ
                        </p>
                    </div>
                </div>
            @endforeach
            <a href="{{ url('co-create') }}">
                <img class="add-co" id="rectangle123" src="{{ URL::asset('/assets/image/welcome/add.png') }}">
            </a>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalDe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body">
                    <p class="remove-text-announcement">ลบออกจากประกาศ?</p>
                    <p class="you-have-deleted">หากคุณลบแล้ว ประกาศของคุณจะถูกนำออกจากหน้าประกาศ
                        และ co-agent ของคุณจะไม่เห็นประกาศของคุณแล้ว</p>

                    <div style="display: flex;justify-content: center;">
                        <button type="button" class="btn btn-close-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                        <a href="#" id="delete-link" type="button" class="btn btn-remove-announcement">
                            ลบออกจากประกาศ
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script>
        // เมื่อคลิกที่ปุ่ม "ลบออกจากประกาศ"
        document.querySelectorAll('.remove-announcement').forEach(function(button) {
            button.addEventListener('click', function() {
                // ดึง id จาก data-id ของปุ่มที่คลิก
                var announcementId = this.getAttribute('data-id');
                // อัปเดตลิงก์ใน modal
                var deleteLink = document.getElementById('delete-link');
                deleteLink.href = '/destroy-announcement/' + announcementId;
            });
        });
    </script>
@endsection
