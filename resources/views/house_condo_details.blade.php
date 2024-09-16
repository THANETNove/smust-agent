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
                @foreach ($dataHome as $home)
                    @php

                        $imgUrl = json_decode(htmlspecialchars_decode($home->image));
                        $count = count($imgUrl);

                    @endphp
                    <div id="container" style="margin-top: 22px">
                        <div class="wel-image-box">
                            <div class="mr-4">
                                <img class="popup-trigger wel-image-detall-1"
                                    src="{{ URL::asset('img/product/' . $imgUrl[0]) }}" data-index="0">
                            </div>
                            @if ($count > 1)
                                <div class="flex-direction-column">
                                    <img class="popup-trigger wel-image-detall-2"
                                        src="{{ URL::asset('img/product/' . $imgUrl[1]) }}" data-index="1">
                                    @if ($count > 2)
                                        <div class="wel-image-opacity">
                                            <img class="popup-trigger wel-image-detall-2"
                                                src="{{ URL::asset('img/product/' . $imgUrl[2]) }}" data-index="2">
                                            @if ($count > 3)
                                                <p class="number-image">+{{ $count - 3 }}</p>
                                            @endif

                                        </div>
                                    @endif
                                </div>
                            @endif

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
                @endforeach
            </div>
            <div class="col-sm-12 col-md-4">
                Column
            </div>


        </div>
    </div>

    <div class="popup" id="imagePopup">
        <div class="popup-content">

            <div id="popupMediaContainer">
            </div>

            <span class="close-btn" onclick="closePopup()">&times;</span>
            <span class="save-image-btn" id="save-image-btn">
                <img class="icon-save" src="{{ URL::asset('/assets/image/home/save_icon_152542.png') }}">
            </span>
            {{--   <span class="save-image-btn-all" id="save-all-images-btn">
                <img class="icon-save" src="{{ URL::asset('/assets/image/home/save_icon_152542.png') }}"> --}}

            </span>
            <button class="prev-btn" id="prev-btn" onclick="changeMedia(-1)">&#10094;</button>
            <button class="next-btn" id="next-btn" onclick="changeMedia(1)">&#10095;</button>
        </div>
    </div>
    <div class="popup" id="imagePopup">
        <div class="popup-content">
            <img id="popupImage" src="" alt="Popup Image">
            <span class="close-btn" onclick="closePopup()">&times;</span>
        </div>
    </div>
    @include('detall.javascript_popupImage')




    @include('layouts.footer_welocome')
@endsection
