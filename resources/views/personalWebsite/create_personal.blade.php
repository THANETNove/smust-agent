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
                แก้ไขเว็บไซต์ส่วนตัว
            </p>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>

    <form action="">
        <div class="box-rectangle">
            <img class="rectangle123" id="rectangle123" src="{{ URL::asset('/assets/image/welcome/Rectangle123.png') }}">
            <img class="frame7" id="frame7" src="{{ URL::asset('/assets/image/welcome/Frame7.png') }}"
                onclick="triggerFileInput()">
            <input type="file" id="fileInput" class="frame7" name="image" accept="image/*"
                onchange="previewImage(event)" style="display: none;">

        </div>
        <div class="box-history-profile">
            <div>
                @if (Auth::user()->image)
                    <img class="userProfile" src="{{ URL::asset(Auth::user()->image) }}">
                @else
                    <img class="img-history-profile" src="{{ URL::asset('/assets/image/welcome/profile.png') }}">
                @endif
            </div>
            <div class="name-history-profile">

                <p class="name-history-profile-p">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                <div class="col-md-12 input_box">
                    <input type="numner" name="id_card_number"
                        class="form-control @error('id_card_number') is-invalid @enderror"
                        value="{{ Auth::user()->provinces }}" required autocomplete="id_card_number">
                    <label>เขตพื้นที่ที่สะดวกทำงาน <samp style="color: red;margin-left: 6px;"> *</samp> </label>

                </div>

            </div>


        </div>
        <div class="history-box">
            <div class="col-12 input_box2">
                <label>เขตพื้นที่ที่สะดวกทำงาน <samp style="color: red;margin-left: 6px;"> *</samp> </label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>


            </div>

            <button type="submit" class="btn btn-attention">
                บันทึกการแก้ไข
            </button>
        </div>

    </form>

di

    <script>
        function triggerFileInput() {
            document.getElementById('fileInput').click(); // ทำการคลิกปุ่ม input file โดยอัตโนมัติ
        }

        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                const rectangle123 = document.getElementById('rectangle123');
                rectangle123.src = reader.result; // แสดงภาพที่ถูกเลือกใน Rectangle123
            };

            if (file) {
                reader.readAsDataURL(file); // อ่านไฟล์ภาพเป็น Data URL
            }
        }
    </script>
@endsection
