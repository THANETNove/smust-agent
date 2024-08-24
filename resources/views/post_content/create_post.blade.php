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

            <p class="free-trial">แก้ไขเว็บไซต์ส่วนตัว
                <br>

            </p>

        </div>


    </div>

    <div class="success-box">
        @if (session('success'))
            <span>{{ session('success') }}</span>
        @endif

    </div>
    @php
        // กำหนดเงื่อนไขว่าฟอร์มจะใช้เพื่อแก้ไขหรือสร้างใหม่
        $isEditing = !true; // แทนที่ `!true` ด้วยเงื่อนไขจริงของคุณ
    @endphp


    <div>
        <form method="POST" action="{{ $isEditing ? route('edit-post-update', $personal->id) : route('new-post-store') }}"
            enctype="multipart/form-data" id="postForm">
            @csrf
            @if ($isEditing)
                @method('PUT')
            @endif

            <div class="mb-3">
                <input type="text" class="form-control" name="name" id="postName" placeholder="ชื่อโพส">
            </div>
            <div class="text-center mb-3">
                <img class="add-frame7-2" id="add-frame7-2" style="display: none">
                <img class="add-frame7" id="add-frame7" src="{{ URL::asset('/assets/image/welcome/add-frame7.png') }}">
                <input type="file" id="fileInput-image" class="frame7" name="image" accept="image/*"
                    style="display: none;">
            </div>
            <div>
                <textarea class="form-control history-areas" name="details_post" id="postDetails" style="min-height: 100px"></textarea>
            </div>
            <div class="btn-box-post">
                <button type="submit" id="submitButton" class="btn btn-register" disabled>โพส</button>
            </div>
        </form>
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

        document.getElementById('add-frame7').addEventListener('click', function() {
            document.getElementById('fileInput-image').click();
        });

        document.getElementById('fileInput-image').addEventListener('change', function(event) {
            const fileInput = event.target;
            const file = fileInput.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    // อัปเดตภาพที่เลือกให้แสดงใน add-frame7-2
                    const addFrame7_2 = document.getElementById('add-frame7-2');
                    addFrame7_2.src = e.target.result;
                    addFrame7_2.style.display = 'inline';
                };

                // อ่านไฟล์เป็น Data URL
                reader.readAsDataURL(file);
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const postName = document.getElementById('postName');
            const postDetails = document.getElementById('postDetails');
            const submitButton = document.getElementById('submitButton');

            function validateForm() {
                if (postName.value.trim() === '' || postDetails.value.trim() === '') {
                    submitButton.disabled = true;
                    submitButton.style.backgroundColor = '#9E9E9E'; // สีเทา
                } else {
                    submitButton.disabled = false;
                    submitButton.style.backgroundColor = ''; // สีเดิม
                }
            }

            postName.addEventListener('input', validateForm);
            postDetails.addEventListener('input', validateForm);
        });

        document.addEventListener('DOMContentLoaded', adjustTextareaHeight); // เรียกใช้เมื่อเอกสารโหลดเสร็จ
    </script>
@endsection
