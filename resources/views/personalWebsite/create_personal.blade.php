@extends('layouts.app')

@section('content')
    <?php
    $data = DB::table('provinces')->orderBy('name_th', 'ASC')->get();
    ?>

    <div class="free-trial-box-nav-web">
        <div class="offcanvasManu-web">
            @include('layouts.offcanvasManu')
        </div>
        <div class="box-nav-web">
            <a href="{{ session('success') ? url('/home') : 'javascript:void(0);' }}"
                onclick="{{ session('success') ? '' : 'goBack()' }}">
                <img class="free-go-back" src="{{ URL::asset('/assets/image/welcome/go-back.png') }}">
            </a>
            <p class="free-trial">แก้ไขเว็บไซต์ส่วนตัว</p>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        </div>
    </div>

    <form action="">
        <div class="box-rectangle">
            <img class="rectangle123" id="rectangle123" src="{{ URL::asset('/assets/image/welcome/Rectangle123.png') }}">
            <img class="frame7" id="frame7" src="{{ URL::asset('/assets/image/welcome/Frame7.png') }}"
                onclick="triggerFileInput('head')">
            <input type="file" id="fileInput-head" class="frame7" name="image" accept="image/*"
                onchange="previewImage(event, 'head')" style="display: none;">
        </div>

        <div class="box-history-profile">
            <div>
                <img class="userProfile"
                    src="{{ Auth::user()->image ? URL::asset(Auth::user()->image) : URL::asset('/assets/image/welcome/profile.png') }}">
            </div>
            <div class="name-history-profile">
                <p class="name-history-profile-p">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                <div class="col-md-12 input_box">
                    <input type="number" name="id_card_number"
                        class="form-control @error('id_card_number') is-invalid @enderror"
                        value="{{ Auth::user()->provinces }}" required autocomplete="id_card_number">
                    <label>เขตพื้นที่ที่สะดวกทำงาน <samp style="color: red;margin-left: 6px;"> *</samp></label>
                </div>
            </div>
        </div>

        <div class="history-box">
            <div class="col-12 input_box2">
                <label>เขตพื้นที่ที่สะดวกทำงาน <samp style="color: red;margin-left: 6px;"> *</samp></label>
                <textarea class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-attention">บันทึกการแก้ไข</button>
        </div>
    </form>

    <div class="box-type">
        @foreach (['contract2.png' => 'ประเภทสัญญา: เช่า ซื้อ', 'domain2.png' => 'ประเภททรัพย์: บ้าน คอนโด', 'domain2.png' => 'ลักษณะเฉพาะ: คอนโดตามแนวรถไฟฟ้า คอนโดมือหนึ่ง'] as $icon => $text)
            <p><img class="img-contract2" src="{{ URL::asset("/assets/image/welcome/$icon") }}">{{ $text }}</p>
        @endforeach
    </div>

    <div class="box-link-fb-tel">
        @foreach ([['imageLine.png', 'LINE ID: ovaljen'], ['imageFb.png', 'FB: Kornkanok Klin'], ['imagecall.png', 'Tel: 0325687464']] as [$icon, $text])
            <p><img class="img-imageLine" src="{{ URL::asset("/assets/image/welcome/$icon") }}">{{ $text }}</p>
        @endforeach
    </div>

    <div class="footer-name">
        <p>ชื่อ นามสกุล ทรัพย์ที่ทำ และช่องทางการติดต่อ ต้องแก้ไขที่ แก้ไขข้อมูลส่วนตัว</p>
    </div>

    <div class="services-such-as">
        <p class="services-name">บริการ อาทิ</p>
        <p>สามารถใส่บริการจุดเด่นของคุณได้สูงสุด 3 อย่างพร้อมรูปประกอบ หากไม่ใส่เลย จะไม่ถูกแสดงบนหน้าเว็บ จะใส่น้อยกว่า 3
            อย่างก็ได้</p>
    </div>

    <div class="box-justify-content pt-services-32 mb-32-services">
        @foreach (range(1, 3) as $i)
            <div class="box-services-user">
                <img class="img-rectangle136" id="rectangle136-{{ $i }}"
                    src="{{ URL::asset('/assets/image/welcome/rectangle136.png') }}">
                <img class="frame7-2" id="frame7-{{ $i }}"
                    src="{{ URL::asset('/assets/image/welcome/Frame7.png') }}"
                    onclick="triggerFileInput({{ $i }})">
                <input type="file" id="fileInput-{{ $i }}" class="frame7" name="image_{{ $i }}"
                    accept="image/*" onchange="previewImage(event, {{ $i }})" style="display: none;">
                <div class="col-md-12 mt-services-24">
                    <label>ชื่อจุดเด่นของคุณ (ไม่เกิน 50 คำ)</label>
                    <input id="text" type="text" name="name_{{ $i }}"
                        class="form-control @error('phone') is-invalid @enderror" required autocomplete="phone"
                        maxlength="50">
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="col-12 mt-4">
                        <label>รายละเอียด {{ $i }} (ไม่เกิน 100 คำ)</label>
                        <textarea class="form-control" rows="3" name="details_{{ $id }}" maxlength="100"></textarea>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="btn-box">
            <button type="submit" class="btn btn-attention">บันทึกการแก้ไข</button>
        </div>
    </div>

    <script>
        function triggerFileInput(index) {
            document.getElementById('fileInput-' + index).click();
        }

        function previewImage(event, index) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                const imageElement = index === 'head' ? document.getElementById('rectangle123') : document
                    .getElementById('rectangle136-' + index);
                imageElement.src = reader.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
