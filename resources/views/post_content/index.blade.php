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
                <a href="{{ url('personal-website') }}">
                    <img class="free-go-back" src="{{ URL::asset('/assets/image/welcome/go-back.png') }}">
                </a>
            @else
                <a href="javascript:void(0);" onclick="goBack()">
                    <img class="free-go-back" src="{{ URL::asset('/assets/image/welcome/go-back.png') }}">
                </a>
            @endif
            <p class="free-trial">แก้ไขเว็บไซต์ส่วนตัว</p>

        </div>


    </div>

    <div class="success-box">
        @if (session('success'))
            <span>{{ session('success') }}</span>
        @endif

    </div>
    {{--   <div class="box-post-justify-content pb-post-19">
        <img class="pick_highlight_post" id="rectangle123"
            src="{{ URL::asset('/assets/image/welcome/pick_highlight_post.png') }}">
        <a href="{{ url('post-create') }}">
            <img class="create_new_post" id="rectangle123"
                src="{{ URL::asset('/assets/image/welcome/create_new_post.png') }}">
        </a>
        <p class="post">Posts</p>
        @foreach ($dataPost as $index => $daPo)
            <div class="posts-view" @if ($index <= 2) style="background-color: #007ba71a" @endif>
                <div class="box-radio-name">
                    <p class="post-head-name">{{ $daPo->name }}</p>
                    <input class="form-check-input" type="radio" name="exampleRadios{{ $index }}"
                        id="exampleRadios{{ $index }}" value="option{{ $index }}"
                        @if ($index <= 2) checked @endif style="display: none">
                </div>
                <img class="add-frame7-2" id="rectangle123" src="{{ URL::asset($daPo->image) }}">
                <div class="text-post-view">
                    <p class="text-content" id="text-content-{{ $index }}">
                        {{ $daPo->details_post }}
                    </p>
                    <span class="see-more" id="see-more-{{ $index }}"
                        onclick="toggleText({{ $index }})">..see more..</span>
                </div>

                <div class="box-delete-post">
                    <a href="{{ url('destroy-post', $daPo->id) }}" class="no-underline">
                        <p class="delete-text">ลบ</p>
                    </a>
                    <a href="{{ url('edit-post', $daPo->id) }}" class="no-underline">
                        <div class="edit-btn-post">
                            <img class="edit-post" id="rectangle123"
                                src="{{ URL::asset('/assets/image/welcome/edit.png') }}">
                            แก้ไข
                        </div>
                    </a>
                </div>
            </div>
        @endforeach


    </div>
 --}}
    <div class="box-post-justify-content pb-post-19">
        <img class="pick_highlight_post" id="rectangle123"
            src="{{ URL::asset('/assets/image/welcome/pick_highlight_post.png') }}" onclick="toggleHighlight()">
        <a href="{{ url('post-create') }}">
            <img class="create_new_post" id="rectangle123"
                src="{{ URL::asset('/assets/image/welcome/create_new_post.png') }}">
        </a>
        <p class="post">Posts</p>
        @foreach ($dataPost as $index => $daPo)
            <div class="posts-view" id="post-{{ $index }}">
                <div class="box-radio-name">
                    <p class="post-head-name">{{ $daPo->name }}</p>
                    <a href="" class="check-input-radio" style="display: none;">
                        <input class="form-check-input" type="radio" name="exampleRadios{{ $index }}"
                            id="exampleRadios{{ $index }}" value="option{{ $index }}"
                            @if ($index <= 2) checked @endif>
                    </a>

                </div>
                <img class="add-frame7-2" id="rectangle123" src="{{ URL::asset($daPo->image) }}">
                <div class="text-post-view">
                    <p class="text-content" id="text-content-{{ $index }}">
                        {{ $daPo->details_post }}
                    </p>
                    <span class="see-more" id="see-more-{{ $index }}"
                        onclick="toggleText({{ $index }})">..see more..</span>
                </div>

                <div class="box-delete-post">
                    <a href="{{ url('destroy-post', $daPo->id) }}" class="no-underline">
                        <p class="delete-text">ลบ</p>
                    </a>
                    <a href="{{ url('edit-post', $daPo->id) }}" class="no-underline">
                        <div class="edit-btn-post">
                            <img class="edit-post" id="rectangle123"
                                src="{{ URL::asset('/assets/image/welcome/edit.png') }}">
                            แก้ไข
                        </div>
                    </a>
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

        function toggleHighlight() {
            const posts = document.querySelectorAll('.posts-view');
            posts.forEach((post, index) => {

                const radio = post.querySelector('.check-input-radio');
                const isVisible = radio.style.display === 'none';

                // Toggle visibility of the radio button
                radio.style.display = isVisible ? 'block' : 'none';

                // Toggle background color
                if (index <= 2) {
                    post.style.backgroundColor = isVisible ? '#007ba71a' : '#FFFFFF';
                } else {
                    post.style.backgroundColor = '#FFFFFF';
                }


            });
        }



        document.addEventListener('DOMContentLoaded', adjustTextareaHeight); // เรียกใช้เมื่อเอกสารโหลดเสร็จ
    </script>
@endsection
