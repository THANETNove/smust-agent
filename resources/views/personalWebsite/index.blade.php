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



    <div class="toggle-container">
        <div class="toggle-button" onclick="toggleContent(this)">
            <img class="Frame584" src="{{ URL::asset('/assets/image/welcome/VectorI1.png') }}"> <span
                style="margin-left: 16px">เว็บส่วนตัว
                ดีอย่างไร?</span>
        </div>
        <div class="toggle-content">
            การขายอสังหาริมทรัพย์ จำเป็นต้องใช้ความน่าเชื่อถือสูง การ มีเว็บส่วนตัวก็จะทำให้เราดูน่าเชื่อถือมากขึ้น
            ดูมีตัวตนจริง ดู ทำงานจริง แถมยังเพิ่มช่องทางการขายด้วยการบอกจุดเด่น ให้ลูกค้าทราบได้อย่างรวดเร็ว พร้อมภาพประกอบ
            นอกจากนี้ ทรัพย์ที่เราอยากทำการตลาดก็สามารถเอามาลงได้ และยิ่ง เป็นทรัพย์ใน SMUST Agent เพียงคุณกด ♥ เพียงครั้ง
            เดียว ทรัพย์ก็จะขึ้นเว็บให้ทันที ทำให้ทำงานง่ายขึ้นมากๆ

            <a href="http://" target="_blank" rel="noopener noreferrer">
                <p class="read-benefits">อ่านประโยชน์เพิ่มเติม</p>
            </a>
        </div>
    </div>

    <div class="content-image">
        <a href="http://" target="_blank" rel="noopener noreferrer" class="no-underline">
            <img class="frame660" src="{{ URL::asset('/assets/image/welcome/frame660.png') }}">
        </a>
        <p class="steps-3">แก้ไขเว็บของคุณง่าย ๆ 3 ขั้นตอน</p>
        <a href="http://" target="_blank" rel="noopener noreferrer" class="no-underline">
            <img class="parttoedit" src="{{ URL::asset('/assets/image/welcome/parttoedit.png') }}">
        </a>
        <a href="{{ url('home') }}" rel="noopener noreferrer" class="no-underline">
            <img class="parttoedit" src="{{ URL::asset('/assets/image/welcome/parttohome.png') }}">
        </a>
        <a href="http://" target="_blank" rel="noopener noreferrer" class="no-underline">
            <img class="parttoedit" src="{{ URL::asset('/assets/image/welcome/parttopost.png') }}">
        </a>

    </div>



    <script>
        function goBack() {
            window.history.back();
        }

        function toggleContent(element) {
            const content = element.nextElementSibling;
            element.classList.toggle('active');
            content.classList.toggle('active');
        }
    </script>
@endsection
