@extends('layouts.app')

@section('content')
    <div class="box-free-trial">
        <div @if (Auth::user()->plans > 0) class="free-trial-box-nav" @endif>
            <a href="javascript:void(0);" onclick="goBack()">
                <img class="free-go-back" src="{{ URL::asset('/assets/image/welcome/go-back.png') }}">
            </a>
            <p class="free-trial">หา co-agent ช่วยขาย</p>

        </div>
        <div class="announced-background">
            <p class="announced-property text-announced2">ทั้งหมด</p>

            <div class="box-co-uses">
                <div class="box-profile-co">
                    <img class="profile-co" id="rectangle123" src="{{ URL::asset('/assets/image/welcome/profile.png') }}">
                    <img class="icon-co-user" id="rectangle123" src="{{ URL::asset('/assets/image/welcome/profile.png') }}">
                </div>
            </div>

        </div>

    </div>
@endsection
