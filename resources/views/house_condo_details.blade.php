@extends('layouts.app')

@section('content')
    @include('layouts.navbar_welcome')
    <div class="box-all-details-wel">
        <a href="javascript:void(0);" onclick="goBack()">
            <p class="return-search"><span> <img class="east-img" id="link-url"
                        src="{{ URL::asset('/assets/image/welcome/east.png') }}"></span>กลับสู่หน้าค้นหา</p>
        </a>

        @php
            $count = 0;
        @endphp

        <div class="row">
            <div class="col-sm-12 col-md-8">
                <div id="container" style="margin-top: 22px">
                    <div class="wel-image-box">
                        <div class="mr-4">
                            <img class="popup-trigger wel-image-detall-1"
                                src="{{ URL::asset('img/product/' . '0AQvJSQ2CXLZi1.jpg') }}" data-index="0">
                        </div>

                        <div class="flex-direction-column">
                            <img class="popup-trigger wel-image-detall-2"
                                src="{{ URL::asset('img/product/' . 'zjF4KZaNCAFTkey9.jpg') }}" data-index="1">

                            <div class="wel-image-opacity">
                                <img class="popup-trigger wel-image-detall-2"
                                    src="{{ URL::asset('img/product/' . 'zjF4KZaNCAFTkey9.jpg') }}" data-index="2">
                                <p class="number-image">+{{ $count - 2 }}</p>
                            </div>

                        </div>


                    </div>
                </div>
                <div class="wel-box-name-details row">
                    <div class="col-sm-12 col-md-3 rent-sell-wel">
                        <div class="flex-direction-column">
                            <div class="flex-direction-row ">
                                <span class="rent-sell-primary width-rent-sell mb-8">
                                    เช่า
                                </span>
                            </div>
                        </div>
                        <div class="flex-direction-row">
                            <span class="rent-sell-yellow width-rent-sell">
                                ขาย
                            </span>
                        </div>
                        <div class="flex-direction-row">
                            <span class="rent-sell-green width-rent-sell">
                                เช่า/ขาย
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-9">
                        รีเจ้นท์ โฮม สุขมวิท 81 พร้อมอยู่ ห้องแต่งสวย เฟอร์ครบ
                    </div>
                </div>
                <p class="rent-sell-wel-price"> $ 1000 บาท</p>
                <p class="name-details">
                    <img class="img-icon " src="{{ URL::asset('/assets/image/home/location_on.png') }}">
                    asdasdadasdadasdasd
                </p>
                <div class="flex-direction-row mb-2">
                    <img class="icon-content" src="{{ URL::asset('/assets/image/home/map.png') }}">
                    <a target="_blank" rel="noopener noreferrer"{{--  href="{{ $home->url_gps }}" --}}
                        class="text-content-dark_100  text-ellipsis">
                        asdasdasd
                    </a>
                </div>
                <p class="text-content-dark_100 margin-bottom-8  text-ellipsis">

                    <img class="icon-content-2" src="{{ URL::asset('/assets/image/home/directions_subway.png') }}">
                    555 mins to <span class="text-decoration"> adadasd
                    </span>
                </p>
                <div class="real-estate-information"> </div>
            </div>
            <div class="col-sm-12 col-md-4">
                Column
            </div>


        </div>
    </div>







    @include('layouts.footer_welocome')
@endsection
