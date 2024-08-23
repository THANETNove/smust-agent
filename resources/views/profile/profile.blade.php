@extends('layouts.app')

@section('content')
    <?php
    $data = DB::table('provinces')->orderBy('name_th', 'ASC')->get();
    ?>

    <div class="box-free-trial">
        <div class="free-trial-box-nav">

            @if (session('success'))
                <a href="{{ url('/home') }}">
                    <img class="free-go-back" src="{{ URL::asset('/assets/image/welcome/go-back.png') }}">
                </a>
            @else
                <a href="javascript:void(0);" onclick="goBack()">
                    <img class="free-go-back" src="{{ URL::asset('/assets/image/welcome/go-back.png') }}">
                </a>
            @endif

            <p class="free-trial">
                ตั้งค่าโปรไฟล์
            </p>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <form method="POST" action="{{ route('new-setup-profile', Auth::user()->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="box-setup-profile">

                <div class="boxUserProfile" id="profileButton">
                    @if (Auth::user()->image)
                        <img id="userProfileImg" class="userProfile" src="{{ URL::asset(Auth::user()->image) }}">
                    @else
                        <img id="userProfileImg" class="userProfile"
                            src="{{ URL::asset('/assets/image/welcome/profile.png') }}">
                    @endif


                    <div class="box-edit-profile">
                        <img id="userProfileImg" class="Frame584"
                            src="{{ URL::asset('/assets/image/welcome/Frame584.png') }}">
                    </div>

                    <input type="file" id="profileInput" name="image" accept="image/*" style="display: none;">
                </div>

                <div class="box-profile-setup">

                    <p class="auto-name text-center">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                    <p class="auto-email text-center">{{ Auth::user()->email }} </p>

                    @if (Auth::user()->plans == 0)
                        <p class="auto-account text-center">
                            <img class="icon-account" src="{{ URL::asset('/assets/image/welcome/iconFree.jpg') }}">
                            Free Trial Account
                        </p>
                    @elseif (Auth::user()->plans == 1)
                        <p class="auto-account text-center">
                            <img class="icon-account" src="{{ URL::asset('/assets/image/welcome/iconPro.jpg') }}">
                            Pro Account
                        </p>
                    @elseif (Auth::user()->plans == 2)
                        <p class="auto-account text-center">
                            <img class="icon-account" src="{{ URL::asset('/assets/image/welcome/iconPremium.png') }}">
                            Premium Account
                        </p>
                    @endif
                    <p class="information-setup">ข้อมูลของฉัน</p>

                    <div class="row mb-3">
                        <div class="col-md-12 input_box">
                            <input id="number" type="number" name="phone"
                                class="form-control  @error('phone') is-invalid @enderror"
                                value="{{ Auth::user()->phone }}" required autocomplete="phone">
                            <label>เบอร์ติดต่อ <samp style="color: red;margin-left: 6px;"> *</samp></label>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 input_box">
                            <input type="numner" name="id_card_number"
                                class="form-control @error('id_card_number') is-invalid @enderror"
                                value="{{ Auth::user()->email }}" required autocomplete="id_card_number">
                            <label>เลขบัตรประจำตัวประชาชน <span style="color: red;margin-left: 6px;"> *</span> </label>
                            @error('id_card_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <p class="card_number-setup">อัปโหลดรูปบัตรประชาชน <span style="color: red;"> *</span> </p>
                    <div class="card_image" id="card_imageButton">
                        @if (Auth::user()->card_image)
                            <img id="card_numberImg" class="card_image" height="100%" width="100%"
                                src="{{ URL::asset(Auth::user()->card_image) }}">
                        @else
                            <img id="card_numberImg" class="card_image">
                        @endif

                        <img class="group78" src="{{ URL::asset('/assets/image/welcome/Group78.png') }}">

                    </div>

                    <input type="file" id="card_numberInput" class="@error('card_image') is-invalid @enderror"
                        name="card_image" accept="image/*" style="display: none;">

                    @error('card_image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <p class="card_number-setup">ช่องทางติดต่อ</p>
                    <p class="contact-setup">จะปรากฎบนเว็บไซต์สำหรับการติดต่อกลับจากลูกค้า</p>
                    <div class="row mb-3 mt-4">
                        <div class="col-md-12 input_box">
                            <input type="text" name="line_id" class="form-control @error('line_id') is-invalid @enderror"
                                name="line_id" value="{{ Auth::user()->line_id }}" autocomplete="Line id">
                            <label>Line ID </label>
                            @error('line_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 input_box">
                            <input type="url" name="facebook"
                                class="form-control @error('facebook') is-invalid @enderror" name="facebook"
                                value="{{ Auth::user()->facebook_id }}" autocomplete="Facebook">

                            <label>Facebook </label>
                            @error('facebook')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <p class="brokerage-work">งานนายหน้าที่คุณสะดวกทำงาน</p>
                    <p class="details-word">ตรงนี้จะเป็นข้อมูลที่จะโชว์ขึ้นบนเว็บไซต์สาธารณะของเราใน “นามบัตรออนไลน์”</p>
                    <div class="row mb-3">
                        <div class="col-md-12 mb-3 input_box">
                            <select class="form-select" name="provinces" aria-label="Default select example">
                                @foreach ($data as $provinces)
                                    <option value="{{ $provinces->name_th }}"
                                        @if (Auth::user()->provinces == $provinces->name_th) selected @endif>
                                        {{ $provinces->name_th }}
                                    </option>
                                @endforeach
                            </select>

                            @error('provinces')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <p class="font-size-12-black mt-21">
                        <img class="contract" src="{{ URL::asset('/assets/image/welcome/contract.png') }}">
                        ประเภทสัญญา
                    </p>
                    <div class="flex-direction-row mb-3">
                        <select class="form-select" aria-label="Default select example" name="contract_type">
                            <option value="เช่า" @if (Auth::user()->contract_type == 'เช่า') selected @endif>เช่า</option>
                            <option value="ขาย" @if (Auth::user()->contract_type == 'ขาย') selected @endif>ขาย</option>
                            <option value="เช่า/ขาย" @if (Auth::user()->contract_type == 'เช่า/ขาย') selected @endif>เช่า/ขาย</option>
                        </select>


                    </div>


                    <p class="font-size-12-black">
                        <img class="contract" src="{{ URL::asset('/assets/image/welcome/domain.png') }}">
                        ประเภททรัพย์
                    </p>
                    <div class="flex-direction-row mb-3">
                        <select class="form-select" aria-label="Default select example" name="property_type">
                            <option value="บ้านเดี่ยว" @if (Auth::user()->property_type == 'บ้านเดี่ยว') selected @endif>บ้านเดี่ยว
                            </option>
                            <option value="คอนโด" @if (Auth::user()->property_type == 'คอนโด') selected @endif>คอนโด</option>
                            <option value="ทาวน์เฮ้าส์" @if (Auth::user()->property_type == 'ทาวน์เฮ้าส์') selected @endif>ทาวน์เฮ้าส์
                            </option>
                            <option value="ที่ดิน" @if (Auth::user()->property_type == 'ที่ดิน') selected @endif>ที่ดิน</option>
                            <option value="พาณิชย์" @if (Auth::user()->property_type == 'พาณิชย์') selected @endif>พาณิชย์</option>

                        </select>
                    </div>
                    <p class="font-size-12-black">
                        <img class="contract" src="{{ URL::asset('/assets/image/welcome/domain.png') }}">
                        ลักษณะเฉพาะ
                    </p>
                    <div class="flex-direction-row">
                        <select class="form-select" name="characteristics" aria-label="Default select example">
                            <option value="ผ่อนตรง" @if (Auth::user()->characteristics == 'ผ่อนตรง') selected @endif>ผ่อนตรง</option>
                            <option value="ทรัพย์มือหนึ่ง" @if (Auth::user()->characteristics == 'ทรัพย์มือหนึ่ง') selected @endif>
                                ทรัพย์มือหนึ่ง
                            </option>
                            <option value="เช่าออม" @if (Auth::user()->characteristics == 'เช่าออม') selected @endif>เช่าออม</option>
                            <option value="ตกแต่งสวยเว่อร์" @if (Auth::user()->characteristics == 'ตกแต่งสวยเว่อร์') selected @endif>
                                ตกแต่งสวยเว่อร์
                            </option>
                            <option value="เช่าระยะสั้นได้ (น้อยกว่า 6 เดือน)"
                                @if (Auth::user()->characteristics == 'เช่าระยะสั้นได้ (น้อยกว่า 6 เดือน)') selected @endif>เช่าระยะสั้นได้ (น้อยกว่า 6 เดือน)
                            </option>
                            <option value="ใกล้มหาวิทยาลัยดัง" @if (Auth::user()->characteristics == 'ใกล้มหาวิทยาลัยดัง') selected @endif>
                                ใกล้มหาวิทยาลัยดัง</option>
                            <option value="ห้องเปล่า" @if (Auth::user()->characteristics == 'ห้องเปล่า') selected @endif>ห้องเปล่า
                            </option>
                            <option value="ขายขาดทุน" @if (Auth::user()->characteristics == 'ขายขาดทุน') selected @endif>ขายขาดทุน
                            </option>


                        </select>
                    </div>
                    <div class="submit-box">
                        <button type="submit" class="btn btn-register">
                            บันทึกการแก้ไข
                        </button>

                    </div>


                </div>

            </div>
        </form>
    </div>


    </div>
    <script>
        function goBack() {
            window.history.back();
        }
        document.getElementById('card_imageButton').addEventListener('click', function() {
            document.getElementById('card_numberInput').click();
        });

        document.getElementById('card_numberInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('card_numberImg').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
    @include('auth.profileButton')
@endsection
