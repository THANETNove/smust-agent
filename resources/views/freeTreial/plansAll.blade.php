@extends('layouts.app')

@section('content')
    <div class="box-free-trial">
        <div @if (Auth::user()->plans > 0) class="free-trial-box-nav" @endif>
            <a href="javascript:void(0);" onclick="goBack()">
                <img class="free-go-back" src="{{ URL::asset('/assets/image/welcome/go-back.png') }}">
            </a>
            <p class="free-trial">
                @if (Auth::user()->plans == 0)
                    แพลนทั้งหมด
                @else
                    อัปเกรดแพลน
                @endif

            </p>
        </div>
        @if (Auth::user()->plans == 0)
            <div class="container-box-free">
                <img class="head-plans" src="{{ URL::asset('/assets/image/welcome/head-plans.png') }}">
            </div>
            <p class="upgrade-now">อัปเกรดเลย!</p>
        @elseif (Auth::user()->plans == 1)
            <p class="upgreade-plan-pro">อัปเกรดเป็นพรีเมียม</p>
        @elseif (Auth::user()->plans == 2)
            <p class="upgrade-dow">เปลี่ยนแพลน</p>
        @endif



        <div class="container-pro-premium">
            <a {{-- href="#" target="_blank" --}} rel="noopener noreferrer">

                @if (Auth::user()->plans == 0)
                    <img class="plans-pro-premium-img" src="{{ URL::asset('/assets/image/welcome/plans-pro.png') }}">
                @elseif (Auth::user()->plans == 1)
                    <img class="plans-pro-premium-img" src="{{ URL::asset('/assets/image/welcome/plans-pro_user.png') }}">
                @elseif (Auth::user()->plans == 2)
                    <img class="plans-pro-premium-img" src="{{ URL::asset('/assets/image/welcome/plans-pro-dow.png') }}">
                @endif

            </a>
            <a {{-- href="#" target="_blank" --}} rel="noopener noreferrer">
                @if (Auth::user()->plans == 2)
                    <img class="plans-pro-premium-img"
                        src="{{ URL::asset('/assets/image/welcome/plans-premium_user.png') }}">
                @else
                    <img class="plans-pro-premium-img" src="{{ URL::asset('/assets/image/welcome/plans-premium.png') }}">
                @endif
            </a>
        </div>

        @if (Auth::user()->plans == 1)
            <div class="container-pro-premium">
                <img class="frame-pro" src="{{ URL::asset('/assets/image/welcome/Frame-pro.png') }}">
            </div>
        @endif

        <p class="compare-plans">เปรียบเทียบแพลน</p>
        <div class="container-box-free">
            <img class="compare-plans-img" src="{{ URL::asset('/assets/image/welcome/compare-plans.png') }}">
        </div>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
