@extends('layouts.app')

@section('content')
    <div class="box-post-store">
        <div class="box-post-head">
            <h1 class="modal-title-post fs-5" id="exampleModalLabel">สร้างโพส</h1>

            <a href="javascript:void(0);" onclick="goBack()">
                <button type="button" class="btn-close"></button>
            </a>



        </div>
        <form method="POST" action="{{ route('new-post-store') }}" enctype="multipart/form-data" id="postForm">
            @csrf
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
                <textarea class="form-control history-areas" name="details_post" id="postDetails" style="min-height: 183px"></textarea>
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
            const postImage = document.getElementById('fileInput-image');
            const submitButton = document.getElementById('submitButton');

            function validateForm() {
                // ตรวจสอบว่ามีค่าใน input text, textarea และ input file
                const isPostNameEmpty = postName.value.trim() === '';
                const isPostDetailsEmpty = postDetails.value.trim() === '';
                const isPostImageEmpty = postImage.files.length === 0;

                if (isPostNameEmpty || isPostDetailsEmpty || isPostImageEmpty) {
                    submitButton.disabled = true;
                    submitButton.style.backgroundColor = '#9E9E9E'; // สีเทา
                    submitButton.style.color = '#ffffff'; // สีเทา
                } else {
                    submitButton.disabled = false;
                    submitButton.style.backgroundColor = ''; // สีเดิมหรือสีอื่นที่ต้องการ
                }
            }

            // ตรวจสอบเมื่อมีการเปลี่ยนแปลงใน input text, textarea และ input file
            postName.addEventListener('input', validateForm);
            postDetails.addEventListener('input', validateForm);
            postImage.addEventListener('change', validateForm); // เพิ่มการตรวจสอบเมื่อเลือกไฟล์

            // เรียกใช้ validateForm() เพื่อให้แน่ใจว่าสถานะปุ่มถูกต้องเมื่อโหลด
            validateForm();
        });

        document.addEventListener('DOMContentLoaded', adjustTextareaHeight); // เรียกใช้เมื่อเอกสารโหลดเสร็จ
    </script>
@endsection
