@extends('layouts.app')

@section('content')
    @include('layouts.navbar_welcome')
    <div class="row">
        <div class="col-ms-12 col-md-6">
            <div class="box-skilled-head">
                <p class="text-36171-head">ขายอสังหาฯ ยากใช่ไหม?
                    ให้นายหน้าที่เชี่ยวชาญช่วยสิ</p>
                <p class="text-skilled-head">เว็บไซต์นี้จะช่วยให้ท่านตามหานายหน้าได้ทั่วประเทศ
                    ตามความเชี่ยวชาญที่คุณต้องการ</p>
                <p class="brokers-search">นายหน้าให้ค้นหา <br><span class="brokers-search-number">{{ $userQuery }}</span>
                    <span class="brokers-search-text">คน</span>
                </p>
            </div>
        </div>
        <div class="col-ms-12 col-md-6">
            <img class="image-17" src="{{ URL::asset('/assets/image/home/image-17.png') }}">
        </div>
    </div>


    <div class="box-brokers-search">
        <p class="find-broker">หรือตามหานายหน้าที่ตรงใจเลย</p>
        <div class="search-welcome">
            <form method="POST" action="{{ route('contact-premium') }}" enctype="multipart/form-data">
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
                </div>
                <div class="row">
                    <div class="mb-3 col-12 col-sm-3">
                        <select class="form-select" aria-label="Default select example" name="property_type">
                            <option selected disabled>ประเภททรัพย์</option>
                            <option value="บ้านเดี่ยว">บ้านเดี่ยว</option>
                            <option value="คอนโด">คอนโด </option>
                            <option value="ทาวน์เฮ้าส์">ทาวน์เฮ้าส์</option>
                            <option value="ที่ดิน">ที่ดิน</option>
                            <option value="พาณิชย์">พาณิชย์</option>
                        </select>
                    </div>
                    <div class="mb-3  col-12 col-sm-3">
                        <select class="form-select" aria-label="Default select example" name="province">
                            <option selected disabled>จังหวัด</option>
                            @foreach ($provincesQuery as $proQue)
                                <option value="{{ $proQue->name_th }}">{{ $proQue->name_th }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3  col-12 col-sm-3">
                        <select class="form-select" aria-label="Default select example" name="province">
                            <option selected disabled>ลักษณะพิเศษ</option>
                            <option value="ผ่อนตรง">ผ่อนตรง</option>
                            <option value="เช่าออม">เช่าออม</option>
                            <option value="เช่าระยะสั้นได้ (น้อยกว่า 6 เดือน)">เช่าระยะสั้นได้ (น้อยกว่า 6 เดือน)</option>
                            <option value="ห้องเปล่า">ห้องเปล่า</option>
                            <option value="ผ่อนตรง">ทรัพย์มือหนึ่ง</option>
                            <option value="ผ่อนตรง">ตกแต่งสวย</option>
                            <option value="ผ่อนตรง">ใกล้มหาวิทยาลัย</option>
                            <option value="ผ่อนตรง">ขายขาดทุน</option>
                        </select>
                    </div>



                    <div class="mb-3  col-12 col-sm-3">
                        <button type="submit" class="btn-find-out-now">ค้นหาเลย!</button>

                    </div>
                </div>
                @include('layouts.model_welcome')

            </form>
        </div>
    </div>

    <p class="contact-a-broker">ติดต่อนายหน้า<br>
        ระดับ <span>premium</span></p>
    <div class="favorites-query">
        <div class="carousel carousel-mb-64" data-flickity='{ "cellAlign": "center", "contain": true }'>
            @foreach ($favoritesQuery as $fav)
                {{-- <div class="carousel-cell"> --}}
                <div class="interested-contact-premium-carousel">
                    <img class="icon-user-contact"
                        @if ($fav->image) src="{{ URL::asset($fav->image) }}" @else  src="{{ URL::asset('/assets/image/welcome/usercontact.jpg') }}" @endif>
                    <div class="box-user-premium"> <img class="icon-user-premium"
                            src="{{ URL::asset('/assets/image/welcome/iconPremium.png') }}"> Premium Agent</div>

                    <div>
                        <p class="post-head-name text-center">{{ $fav->first_name }} {{ $fav->last_name }}</p>
                        <p class="premium-address text-center">
                            <img class="icon-explore_nearby-premium"
                                src="{{ URL::asset('/assets/image/welcome/explore_nearby.png') }}">
                            {{ $fav->provinces }}
                        </p>
                        <p class="text-content-dark_000 text-center">{{ $fav->history_work }}</p>
                        <div class="btn-box-profile-center">
                            <a href="{{ url('premium-agent-home', $fav->id) }}">
                                <div class="btn-box-profile">ดูโปรไฟล์</div>
                            </a>
                        </div>
                    </div>
                </div>
                {{--  </div> --}}
            @endforeach
        </div>
    </div>
    <div class="favorites-query">
        <div class="container-box-free">
            <a href="{{ url('contact-premium') }}">
                <div class="interested-contact-premium-all">ดูทั้งหมด</div>
            </a>
        </div>
    </div>
    <div class="container-box-free">
        <img class="image-square_1" src="{{ URL::asset('/assets/image/home/inagenthub1.webp') }}">
    </div>
    <div class="container-box-free">
        <img class="image-square_2" src="{{ URL::asset('/assets/image/home/inagenthub2.webp') }}">
    </div>
    @include('layouts.footer_welocome')
@endsection
