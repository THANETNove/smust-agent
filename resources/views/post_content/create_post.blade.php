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
    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title-post fs-5" id="exampleModalLabel">สร้างโพส</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body-post">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="name" id="exampleFormControlInput1"
                            placeholder="ชื่อโพส">
                    </div>
                    <div class="text-center"> <!-- ใช้ class นี้เพื่อตรงกลาง -->
                        <img class="add-frame7" id="rectangle123" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            src="{{ URL::asset('/assets/image/welcome/add-frame7.png') }}">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
