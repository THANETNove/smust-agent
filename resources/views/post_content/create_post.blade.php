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
    <div class="box-post-justify-content pb-post-19">
        <img class="pick_highlight_post" id="rectangle123"
            src="{{ URL::asset('/assets/image/welcome/pick_highlight_post.png') }}">
        <img class="create_new_post" id="rectangle123" data-bs-toggle="modal" data-bs-target="#exampleModal"
            src="{{ URL::asset('/assets/image/welcome/create_new_post.png') }}">

        <p class="post">Posts</p>
    </div>



    <!-- Modal -->
    <div class="modal fade " id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title-post fs-5" id="exampleModalLabel">สร้างโพส</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body-post">
                    @if (!true)
                        <form method="POST" action="{{ route('edit-post-update', $personal->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                        @else
                            <form method="POST" action="{{ route('new-post-store') }}" enctype="multipart/form-data">
                                @csrf
                    @endif
                    <div class="mb-3">
                        <input type="text" class="form-control" name="name" id="exampleFormControlInput1"
                            placeholder="ชื่อโพส">
                    </div>
                    <div class="text-center mb-3"> <!-- ใช้ class นี้เพื่อตรงกลาง -->

                        <img class="add-frame7-2" id="add-frame7-2" style="display: none">
                        <img class="add-frame7" id="add-frame7"
                            src="{{ URL::asset('/assets/image/welcome/add-frame7.png') }}">
                        <input type="file" id="fileInput-image" class="frame7" name="image" accept="image/*"
                            style="display: none;">

                    </div>
                    <div>
                        <textarea class="form-control history-areas" name="details_post" style="min-height: 100px"></textarea>
                    </div>
                    <div class="btn-box-post">
                        <button type="submit" class="btn btn-register">โพส</button>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }

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

        document.addEventListener('DOMContentLoaded', adjustTextareaHeight); // เรียกใช้เมื่อเอกสารโหลดเสร็จ
    </script>
@endsection
