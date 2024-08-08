@extends('layouts.app')

@section('content')
    <div class="box-free-trial">
        <div class="free-trial-box-nav">
            <a href="javascript:void(0);" onclick="goBack()">
                <img class="free-go-back" src="{{ URL::asset('/assets/image/welcome/go-back.png') }}">
            </a>
            <p class="free-trial">
                ตั้งค่าโปรไฟล์
            </p>
        </div>

        <div class="box-setup-profile">

            <div class="boxUserProfile" id="profileButton">
                <img id="userProfileImg" class="userProfile" src="{{ URL::asset('/assets/image/welcome/profile.png') }}">

                <div class="box-edit-profile">
                    <img id="userProfileImg" class="Frame584" src="{{ URL::asset('/assets/image/welcome/Frame584.png') }}">
                </div>

                <input type="file" id="profileInput" name="image" accept="image/*" style="display: none;">
            </div>

            <div class="box-profile-setup "></div>
        </div>


    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    @include('auth.profileButton')
@endsection
