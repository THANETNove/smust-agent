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
        @foreach ($dataPost as $index => $daPo)
            <div class="posts-view">
                <p class="post-head-name">{{ $daPo->name }}</p>
                <img class="add-frame7-2" id="rectangle123"
                    src="{{ URL::asset('/assets/img/card_image/09_09_08_2024_1723180146.jpg') }}">
                <div class="text-post-view">
                    <p class="text-content" id="text-content-{{ $index }}">
                        {{ $daPo->details_post }}
                    </p>
                    <span class="see-more" id="see-more-{{ $index }}"
                        onclick="toggleText({{ $index }})">..see more..</span>
                </div>

                <div class="box-delete-post">
                    <p class="delete-text">ลบ</p>
                    <div class="edit-btn-post">
                        <img class="edit-post" id="rectangle123" src="{{ URL::asset('/assets/image/welcome/edit.png') }}">
                        แก้ไข
                    </div>
                </div>
            </div>
        @endforeach


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



        document.addEventListener('DOMContentLoaded', function() {
            const textContents = document.querySelectorAll('.text-content');
            const seeMoreButtons = document.querySelectorAll('.see-more');

            function checkTextOverflow(index) {
                const textContent = textContents[index];
                const seeMoreButton = seeMoreButtons[index];

                if (textContent.scrollHeight > textContent.clientHeight) {
                    seeMoreButton.style.display = 'inline-block'; // แสดงปุ่มถ้าข้อความยาวเกิน
                } else {
                    seeMoreButton.style.display = 'none'; // ซ่อนปุ่มถ้าข้อความไม่ยาวเกิน
                }
            }

            textContents.forEach((_, index) => checkTextOverflow(index));

            window.toggleText = function(index) {
                const textContent = textContents[index];
                const seeMoreButton = seeMoreButtons[index];

                if (textContent.classList.contains('expanded')) {
                    textContent.classList.remove('expanded');
                    seeMoreButton.textContent = '..see more..';
                } else {
                    textContent.classList.add('expanded');
                    seeMoreButton.textContent = 'see less';
                }
            };
        });





        document.addEventListener('DOMContentLoaded', adjustTextareaHeight); // เรียกใช้เมื่อเอกสารโหลดเสร็จ
    </script>
@endsection
