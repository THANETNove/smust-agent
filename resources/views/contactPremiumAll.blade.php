@extends('layouts.app')

@section('content')
    @include('layouts.navbar_welcome')
    <div class="box-premium-all">
        <div class="row">
            <div class="col-md-12 col-lg-4">
                <p class="looking-broker">ตามหานายหน้าตรงใจ</p>
                <p class="looking-broker-sub">ขายไม่ได้ซักทีใช่ไหม? ลองส่งให้นายหน้าที่เชี่ยวชาญในประเภท
                    สัญญา ประเภททรัพย์ จังหวัด หรือลักษณะพิเศษของทรัพย์คุณสิ</p>
            </div>
            <div class="col-md-12 col-lg-8">
                <div class="search-welcome" style="margin-top: 16px">
                    <form method="POST" action="{{ route('contact-premium') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="search-welcome-box mb-3">
                            <div>
                                <input type="radio" id="rent" name="sale_rent" value="เช่า" checked>
                                <label for="rent" class="search-text-head">เช่า</label>
                            </div>

                            <div>
                                <input type="radio" id="buy" name="sale_rent" value="ขาย">
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
                                <select class="form-select" aria-label="Default select example" name="characteristics">
                                    <option selected disabled>ลักษณะพิเศษ</option>
                                    <option value="ผ่อนตรง">ผ่อนตรง</option>
                                    <option value="เช่าออม">เช่าออม</option>
                                    <option value="เช่าระยะสั้นได้ (น้อยกว่า 6 เดือน)">เช่าระยะสั้นได้ (น้อยกว่า 6 เดือน)
                                    </option>
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
        </div>
    </div>
    @if ($statusShow)
        <div class="box-premium-head-conten">
            <p class="text-36171-head">นายหน้าที่ถนัด...</p>
            <p class="text-premium-conten">หาผู้.. <span>เช่า</span> .. ทรัพย์ประเภท.. <span>คอนโด</span> .. ใน.. <span>กทม.
                    และปริมณฑล</span> ..
                ที่มีลักษณะ.. <span>คอนโดแนวรถไฟฟ้า</span> ..</p>
        </div>
    @endif

    <div class="box-premium-broker">
        @foreach ($userQuery1 as $fav)
            @if ($fav->plans == 2)
                <div class="interested-contact-premium-carousel-broker">
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
                            <a href="">
                                <div class="btn-box-profile">ดูโปรไฟล์</div>
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="interested-contact-pro" style="margin-right: 40px">
                    <img class="icon-user-contact-pro"
                        @if ($fav->image) src="{{ URL::asset($fav->image) }}" @else  src="{{ URL::asset('/assets/image/welcome/usercontact.jpg') }}" @endif>
                    <div class="box-user-pro"> <img class="icon-user-pro"
                            src="{{ URL::asset('/assets/image/welcome/icon-pro-agent.png') }}"> Pro Agent</div>

                    <div>
                        <p class="post-head-name text-center">{{ $fav->first_name }} {{ $fav->last_name }}</p>
                        <p class="premium-address text-center">
                            <img class="icon-explore_nearby-premium"
                                src="{{ URL::asset('/assets/image/welcome/explore_nearby-pro.png') }}">
                            {{ $fav->provinces }}
                        </p>
                        <p class="text-content-dark_000 text-center">ผู้เชี่ยวชาญ
                            ให้คำปรึกษาเรื่อง{{ $fav->property_type }}
                            เชี่ยวชาญในย่าน {{ $fav->provinces }}...</p>
                        <div class="btn-box-profile-center">
                            <div class="btn-box-profile-pro" data-bs-toggle="modal"
                                data-bs-target="#exampleModal-pro-{{ $fav->id }}">ติดต่อ</div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal-pro-{{ $fav->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body modal-body-center">
                                <div class="btn-box-profile-center">
                                    <img class="icon-user-contact-pro-modal"
                                        @if ($fav->image) src="{{ URL::asset($fav->image) }}" @else  src="{{ URL::asset('/assets/image/welcome/usercontact.jpg') }}" @endif>
                                </div>
                                <div class="box-user-pro">
                                    <img class="icon-user-pro"
                                        src="{{ URL::asset('/assets/image/welcome/icon-pro-agent.png') }}">
                                    Pro Agent
                                </div>
                                <p class="post-head-name text-center">{{ $fav->first_name }}
                                    {{ $fav->last_name }}</p>
                                <p class="premium-address text-center">
                                    <img class="icon-explore_nearby-premium"
                                        src="{{ URL::asset('/assets/image/welcome/explore_nearby-pro.png') }}">
                                    {{ $fav->provinces }}
                                </p>
                                <p class="text-content-dark_000 text-center">
                                    ผู้เชี่ยวชาญให้คำปรึกษาเรื่อง {{ $fav->property_type }}
                                    เชี่ยวชาญในย่าน {{ $fav->provinces }}
                                </p>
                                <!-- โค้ดเพิ่มเติมสำหรับข้อมูลของ Modal -->
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div class="box-premium-head-conten">
        <p class="text-36171-head">นายหน้าที่ถนัด...</p>
        <p class="text-premium-conten">หาผู้.. <span>เช่า</span> .. ทรัพย์ประเภท.. <span>คอนโด</span> .. ใน.. <span>กทม.
                และปริมณฑล</span> ..
        </p>
    </div>
    <div class="box-premium-broker">
        @foreach ($userQuery as $fav)
            @if ($fav->plans == 2)
                <div class="interested-contact-premium-carousel-broker">
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
            @else
                <div class="interested-contact-pro" style="margin-right: 40px">
                    <img class="icon-user-contact-pro"
                        @if ($fav->image) src="{{ URL::asset($fav->image) }}" @else  src="{{ URL::asset('/assets/image/welcome/usercontact.jpg') }}" @endif>
                    <div class="box-user-pro"> <img class="icon-user-pro"
                            src="{{ URL::asset('/assets/image/welcome/icon-pro-agent.png') }}"> Pro Agent</div>

                    <div>
                        <p class="post-head-name text-center">{{ $fav->first_name }} {{ $fav->last_name }}</p>
                        <p class="premium-address text-center">
                            <img class="icon-explore_nearby-premium"
                                src="{{ URL::asset('/assets/image/welcome/explore_nearby-pro.png') }}">
                            {{ $fav->provinces }}
                        </p>
                        <p class="text-content-dark_000 text-center">ผู้เชี่ยวชาญ
                            ให้คำปรึกษาเรื่อง{{ $fav->property_type }}
                            เชี่ยวชาญในย่าน {{ $fav->provinces }}...</p>
                        <div class="btn-box-profile-center">
                            <div class="btn-box-profile-pro" data-bs-toggle="modal"
                                data-bs-target="#exampleModal-pro-{{ $fav->id }}">ติดต่อ</div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal-pro-{{ $fav->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body modal-body-center">
                                <div class="btn-box-profile-center">
                                    <img class="icon-user-contact-pro-modal"
                                        @if ($fav->image) src="{{ URL::asset($fav->image) }}" @else  src="{{ URL::asset('/assets/image/welcome/usercontact.jpg') }}" @endif>
                                </div>
                                <div class="box-user-pro">
                                    <img class="icon-user-pro"
                                        src="{{ URL::asset('/assets/image/welcome/icon-pro-agent.png') }}">
                                    Pro Agent
                                </div>
                                <p class="post-head-name text-center">{{ $fav->first_name }}
                                    {{ $fav->last_name }}</p>
                                <p class="premium-address text-center">
                                    <img class="icon-explore_nearby-premium"
                                        src="{{ URL::asset('/assets/image/welcome/explore_nearby-pro.png') }}">
                                    {{ $fav->provinces }}
                                </p>
                                <p class="text-content-dark_000 text-center">
                                    ผู้เชี่ยวชาญให้คำปรึกษาเรื่อง {{ $fav->property_type }}
                                    เชี่ยวชาญในย่าน {{ $fav->provinces }}
                                </p>
                                <!-- โค้ดเพิ่มเติมสำหรับข้อมูลของ Modal -->
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    @include('layouts.footer_welocome')
@endsection
