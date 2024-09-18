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
                    <span class="brokers-search-text">คน</span></p>
            </div>
        </div>
        <div class="col-ms-12 col-md-6">
            <img class="image-17" src="{{ URL::asset('/assets/image/home/image-17.png') }}">
        </div>
    </div>
    @include('layouts.footer_welocome')
@endsection
