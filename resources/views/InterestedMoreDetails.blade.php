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
    @include('layouts.footer_welocome')
@endsection
