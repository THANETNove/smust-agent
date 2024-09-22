@extends('layouts.app')

@section('content')
    @include('layouts.navbar_welcome')
    <div class="box-us-agent-info-head">
        <p class="us-agent-inf-text">ไม่ต้องหาทรัพย์เอง </p>
        <p class="us-info-text">เราจัดสต็อกไว้ให้คุณ บริหารทรัพย์ในที่เดียว </p>
        <p class="us-commission-text">ค่านายหน้าได้เต็ม 100%</p>
        <p class="property-favorite-location">ตามประเภททรัพย์ ทำเลที่คุณชอบ</p>
        <a href="{{ url('home-login') }}">
            <img src="{{ URL::asset('/assets/image/welcome/Frame149.png') }}" class="frame-149" alt="user">
        </a>
        <img src="{{ URL::asset('/assets/image/welcome/Frame235.png') }}" class="frame-235" alt="user">
    </div>
    <div class="box-supported-by row">
        <div class="col-sm-12 col-md-6">
            <p class="who-are-we">Who are we?</p>
            <p class="can-agent"><span>สามารถเอเจนท์ (SMUST Agent)</span> เกิดจากคนที่เคยทำนายหน้า อสังหาฯ​จนเข้าใจในปัญหา
                และต้องการแก้ไข</p>
            <li class="text-li">จะมาทำให้การทำงานนายหน้า <span>ง่ายที่สุดในโลก</span></li>
            <li class="text-li">ที่เดียวที่รวมทั้งทรัพย์​ ลูกค้า เครื่องมือสร้างความมืออาชีพ และ ความรู้</li>
        </div>
        <div class="col-sm-12
                col-md-6">
            <img src="{{ URL::asset('/assets/image/welcome/supported-by.png') }}" class="supported-by" alt="user">
        </div>
    </div>
    <div class="box-supported-by-1130 row">
        <div class="col-sm-12 col-md-6">
            <p class="who-are-we-1130">ทำงานนายหน้าอิสระกับเรา ง่ายที่สุดในโลก</p>
            <p class="who-are-we-text-1130">ให้เราช่วยคุณได้ทำงานนายหน้าอย่างเป็นมืออาชีพ</p>

        </div>
        <div class="col-sm-12
                col-md-6">
            <img src="{{ URL::asset('/assets/image/welcome/Rectangle1130.png') }}" class="rectangle1130" alt="user">
        </div>
    </div>
    <div class="box-these-problems">
        <p class="text-36171-head">ปัญหาเหล่านี้ของคุณ เราจะช่วยแก้ให้หมดไป</p>
        <img src="{{ URL::asset('/assets/image/welcome/Problems.png') }}" class="problems" alt="user">
    </div>
    <div class="box-what-we-have">
        <p class="text-what-we-have">What we have ?</p>
        <p class="text-what-we-have-2">สามารถเอเจนท์ มีอะไรบ้าง ?</p>

        <div class="box-pills-as">
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
        </div>
        <div class="box-tab-content-we">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                    tabindex="0">
                    <div class="row">
                        <div class="col-sm-12 col-md-8">
                            <img src="{{ URL::asset('/assets/image/welcome/Mockup.png') }}" class="mockup" alt="user">
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <p class="no-need-to-find">ไม่ต้องหาทรัพย์เอง</p>
                            <p class="no-need-to-find-text">เก็บทรัพย์เหนื่อยใช่ไหม? เรามีทรัพย์แยกให้ทั้งฝั่งของเจ้าของตรง
                                หรือ co-agent ด้วยกัน
                                ที่พร้อมให้คุณนำไปเสนอลูกค้าในมือ</p>
                            <li class="no-need-to-find-text">กรองได้สะดวก</li>
                            <li class="no-need-to-find-text">ติดต่อเจ้าของตรงได้เลย</li>
                            <a href="{{ url('home-login') }}">
                                <div class="want-receive-wealth">
                                    ฉันอยากรับทรัพย์ และเริ่มทำงานนายหน้า
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                    tabindex="0">

                    <div class="row">
                        <div class="col-sm-12 col-md-8">
                            <img src="{{ URL::asset('/assets/image/welcome/Mockup_2.png') }}" class="mockup" alt="user">
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <p class="no-need-to-find">ลูกค้ามาหาคุณเอง</p>
                            <p class="no-need-to-find-text">“หาลูกค้ายากใช่หรือไม่?” เรามีลูกค้าที่มีความต้องการ
                                มาแสดงถึงมือคุณแล้ว แยกออกมาให้ทั้งจากลูกค้า ตรง และ agent ที่มาถามหา</p>
                            <a href="{{ url('home-login') }}">
                                <div class="want-receive-wealth">
                                    ฉันอยากติดต่อลูกค้า
                                </div>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="box-commission-wi-as">
        <p class="ready-receive">พร้อมรับ</p>
        <p class="ready-receive-1">ค่าคอมมิชชัน 100%</p>
        <p class="ready-receive-2">ไม่ต้องแบ่ง ไม่ต้องแชร์</p>
        <p class="ready-receive-3">เหมือนมีผู้ช่วยส่วนตัวช่วยทำงาน แบบไม่ต้องจ้าง 20,000+</p>
    </div>

    @include('layouts.footer_welocome')
@endsection
