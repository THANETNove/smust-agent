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
            <a href="javascript:void(0);" onclick="goBack()">
                <img class="free-go-back" src="{{ URL::asset('/assets/image/welcome/go-back.png') }}">
            </a>
            <p class="free-trial">แก้ไขเว็บไซต์ส่วนตัว</p>

        </div>


    </div>

    <div class="success-box">
        @if (session('success'))
            <span>{{ session('success') }}</span>
        @endif

    </div>
    <div class="box-post-justify-content pb-post-19">
        <img class="pick_highlight_post" id="rectangle123"
            src="{{ URL::asset('/assets/image/welcome/pick_highlight_post.png') }}">
        <a href="{{ url('post-create') }}">
            <img class="create_new_post" id="rectangle123"
                src="{{ URL::asset('/assets/image/welcome/create_new_post.png') }}">
        </a>
        <p class="post">Posts</p>
        <div class="posts-view">
            <p class="post-head-name">พาลูกค้าไปโอนที่กรมที่ดินอีกแล้วค่า</p>
            <img class="add-frame7-2" id="rectangle123"
                src="{{ URL::asset('/assets/img/card_image/09_09_08_2024_1723180146.jpg') }}">
            <p class="text-post-view">เป็นเคสที่มายด์ไม่ได้ใช้เวลานานเลย เพียงแค่ 40 วันก็ขายได้แล้ว
                มายด์ดูแลสินเชื่อให้ลูกค้าด้วยทุก เคสค่ะ</p>

            <div class="box-delete-post">
                <p class="delete-text">ลบ</p>
                <div class="edit-btn-post">
                    <img class="edit-post" id="rectangle123" src="{{ URL::asset('/assets/image/welcome/edit.png') }}">
                    แก้ไข
                </div>
            </div>
        </div>
        {{--      <div class="posts-view">
            <p class="post-head-name">พาลูกค้าไปโอนที่กรมที่ดินอีกแล้วค่า</p>
            <img class="add-frame7-2" id="rectangle123"
                src="{{ URL::asset('/assets/img/card_image/09_09_08_2024_1723180146.jpg') }}">
            <p class="text-post-view">เป็นเคสที่มายด์ไม่ได้ใช้เวลานานเลย เพียงแค่ 40 วันก็ขายได้แล้ว
                มายด์ดูแลสินเชื่อให้ลูกค้าด้วยทุก เคสค่ะ</p>
        </div> --}}

    </div>



    <script>
        function adjustTextareaHeight() {
            var textareas = document.querySelectorAll('.history-areas');

            // การทำงานกับแต่ละ textarea
            textareas.forEach(function(textarea) {
                // ตัวอย่าง: ตั้งค่า rows ให้ตรงกับขนาดของข้อความ
                textarea.style.height = 'auto'; // คืนค่า auto เพื่อให้ได้ขนาดที่พอดี
                textarea.style.height = (textarea.scrollHeight) + 'px'; // ปรับความสูงให้พอดีกับขนาดของข้อความ
            });
        }





        document.addEventListener('DOMContentLoaded', adjustTextareaHeight); // เรียกใช้เมื่อเอกสารโหลดเสร็จ
    </script>
@endsection
