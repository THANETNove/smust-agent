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
                                <input type="radio" id="rent" name="sale_rent" value="เช่า"
                                    {{ $sale_rent == 'เช่า' ? 'checked' : '' }}>
                                <label for="rent" class="search-text-head">เช่า</label>
                            </div>

                            <div>
                                <input type="radio" id="buy" name="sale_rent" value="ขาย"
                                    {{ $sale_rent == 'ขาย' ? 'checked' : '' }}>
                                <label for="buy" class="search-text-head">ซื้อ</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-12 col-sm-3">
                                <select class="form-select" aria-label="Default select example" name="property_type">
                                    <option selected disabled>ประเภททรัพย์</option>
                                    <option value="บ้านเดี่ยว" {{ $property_type == 'บ้านเดี่ยว' ? 'selected' : '' }}>
                                        บ้านเดี่ยว</option>
                                    <option value="คอนโด" {{ $property_type == 'คอนโด' ? 'selected' : '' }}>คอนโด</option>
                                    <option value="ทาวน์เฮ้าส์" {{ $property_type == 'ทาวน์เฮ้าส์' ? 'selected' : '' }}>
                                        ทาวน์เฮ้าส์</option>
                                    <option value="ที่ดิน" {{ $property_type == 'ที่ดิน' ? 'selected' : '' }}>ที่ดิน
                                    </option>
                                    <option value="พาณิชย์" {{ $property_type == 'พาณิชย์' ? 'selected' : '' }}>พาณิชย์
                                    </option>
                                </select>

                            </div>
                            <div class="mb-3  col-12 col-sm-3">
                                <select class="form-select" aria-label="Default select example" name="province">
                                    <option selected disabled>จังหวัด</option>
                                    @foreach ($provincesQuery as $proQue)
                                        <option value="{{ $proQue->name_th }}"
                                            {{ $province == $proQue->name_th ? 'selected' : '' }}>{{ $proQue->name_th }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3  col-12 col-sm-3">
                                <select class="form-select" aria-label="Default select example" name="characteristics">
                                    <option selected disabled>ลักษณะพิเศษ</option>
                                    <option value="ผ่อนตรง" {{ $characteristics == 'ผ่อนตรง' ? 'selected' : '' }}>ผ่อนตรง
                                    </option>
                                    <option value="เช่าออม" {{ $characteristics == 'เช่าออม' ? 'selected' : '' }}>เช่าออม
                                    </option>
                                    <option value="เช่าระยะสั้นได้ (น้อยกว่า 6 เดือน)"
                                        {{ $characteristics == 'เช่าระยะสั้นได้ (น้อยกว่า 6 เดือน)' ? 'selected' : '' }}>
                                        เช่าระยะสั้นได้ (น้อยกว่า 6 เดือน)</option>
                                    <option value="ห้องเปล่า" {{ $characteristics == 'ห้องเปล่า' ? 'selected' : '' }}>
                                        ห้องเปล่า</option>
                                    <option value="ทรัพย์มือหนึ่ง"
                                        {{ $characteristics == 'ทรัพย์มือหนึ่ง' ? 'selected' : '' }}>ทรัพย์มือหนึ่ง
                                    </option>
                                    <option value="ตกแต่งสวย" {{ $characteristics == 'ตกแต่งสวย' ? 'selected' : '' }}>
                                        ตกแต่งสวย</option>
                                    <option value="ใกล้มหาวิทยาลัย"
                                        {{ $characteristics == 'ใกล้มหาวิทยาลัย' ? 'selected' : '' }}>ใกล้มหาวิทยาลัย
                                    </option>
                                    <option value="ขายขาดทุน" {{ $characteristics == 'ขายขาดทุน' ? 'selected' : '' }}>
                                        ขายขาดทุน</option>
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
            <p class="text-premium-conten">หาผู้.. <span>{{ $sale_rent }}</span> .. ทรัพย์ประเภท..
                <span>{{ $property_type }}</span> ..
                ใน.. <span>{{ $province }}</span> ..
                ที่มีลักษณะ.. <span>{{ $characteristics }}</span> ..
            </p>
        </div>
    @endif

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


                                <div style="padding-left: 32px;padding-right: 32px;">
                                    <p class="text-content-dark_000 ">
                                        ผู้เชี่ยวชาญให้คำปรึกษาเรื่อง {{ $fav->property_type }}
                                        เชี่ยวชาญในย่าน {{ $fav->provinces }}
                                    </p>
                                    <p style="display: flex; align-items: flex-start;"> <img class="contract"
                                            src="{{ URL::asset('/assets/image/welcome/contract.png') }}">
                                        ประเภทสัญญา:
                                        {{ $fav->contract_type }}
                                    </p>
                                    <p style="display: flex; align-items: flex-start;"> <img class="contract"
                                            src="{{ URL::asset('/assets/image/welcome/domain.png') }}">
                                        ประเภททรัพย์: {{ $fav->property_type }}
                                    </p>
                                    <p style="display: flex; align-items: flex-start;"> <img class="contract"
                                            src="{{ URL::asset('/assets/image/welcome/domain.png') }}">
                                        ลักษณะเฉพาะ: {{ $fav->characteristics }}
                                    </p>

                                    <div style="margin-top: 16px;">
                                        @php
                                            $lineIsUrl = filter_var($fav->line_id, FILTER_VALIDATE_URL);
                                            $facebookIsUrl = filter_var($fav->facebook_id, FILTER_VALIDATE_URL);
                                        @endphp
                                        @if ($fav->line_id)
                                            <a
                                                @if ($lineIsUrl) href="{{ $fav->line_id }}"  target="_blank" @else onclick="copyLineID()" @endif>
                                                <img class="btn-box-profile-icon-line-2"
                                                    src="{{ URL::asset('/assets/image/home/line.png') }}">
                                            </a>


                                            <script>
                                                function copyLineID() {
                                                    var lineName = "{{ $fav->line_id }}";
                                                    Swal.fire({
                                                        title: lineName,
                                                        text: "Line ID" + "\n\nถูกคัดลอกแล้ว!",
                                                        icon: 'success',
                                                        /*   showConfirmButton: false,
                                                          timer: 2000 */
                                                        showConfirmButton: true, // ปุ่มยืนยันจะไม่หายไปเอง
                                                        confirmButtonText: 'ปิด', // ข้อความบนปุ่มยืนยัน
                                                        customClass: {
                                                            confirmButton: 'swal-btn-down' // ตั้งชื่อคลาสสำหรับปุ่มยืนยัน
                                                        }
                                                    });
                                                    navigator.clipboard.writeText(lineName).then(function() {
                                                        console.log('Line ID ถูกคัดลอกไปยัง clipboard แล้ว');
                                                    }, function(err) {
                                                        console.error('ไม่สามารถคัดลอกข้อความได้:', err);
                                                    });
                                                }
                                            </script>
                                        @endif

                                        @if ($fav->facebook_id)
                                            <a
                                                @if ($facebookIsUrl) href="{{ $fav->facebook_id }}" target="_blank" @else onclick="copyFacebookID()" @endif>
                                                <img class="btn-box-profile-icon-line-2"
                                                    src="{{ URL::asset('/assets/image/home/facbook.png') }}">
                                            </a>

                                            <script>
                                                function copyFacebookID() {
                                                    var fbName = "{{ $fav->facebook_id }}";
                                                    Swal.fire({
                                                        title: fbName,
                                                        text: "Facebook ID" + "\n\nถูกคัดลอกแล้ว!",
                                                        icon: 'success',
                                                        showConfirmButton: true, // ปุ่มยืนยันจะไม่หายไปเอง
                                                        confirmButtonText: 'ปิด', // ข้อความบนปุ่มยืนยัน
                                                        customClass: {
                                                            confirmButton: 'swal-btn-down' // ตั้งชื่อคลาสสำหรับปุ่มยืนยัน
                                                        }
                                                    });
                                                    navigator.clipboard.writeText(fbName).then(function() {
                                                        console.log('Facebook ID ถูกคัดลอกไปยัง clipboard แล้ว');
                                                    }, function(err) {
                                                        console.error('ไม่สามารถคัดลอกข้อความได้:', err);
                                                    });
                                                }
                                            </script>
                                        @endif

                                        @if ($fav->phone)
                                            <a href="tel:{{ $fav->phone }}" target="_blank" rel="noopener noreferrer">

                                                <img class="btn-box-profile-icon-line-2"
                                                    src="{{ URL::asset('/assets/image/home/call2.png') }}">
                                                <span style="margin-left: -8px">Tel: {{ $fav->phone }}</span>

                                            </a>
                                        @endif
                                    </div>
                                </div>
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
