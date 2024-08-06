@extends('layouts.app')

@section('content')
    <div class="box-free-trial">
        <div>
            <p class="free-trial">สิทธิทดลองใช้งานฟรี</p>
        </div>
        <div class="container-box-free">
            <div class="box-free-image"> <img class="free-image" src="{{ URL::asset('/assets/image/welcome/free.png') }}">
                <span class="free-text">Free Trial Account</span>
            </div>

        </div>
        <div class="container-box-step">

            <img class="free-step" src="{{ URL::asset('/assets/image/welcome/free-step.png') }}">


        </div>
        <p class="day-free">ทดลองใช้งานฟรี 3 วัน </p>
        <p class="month-free">หลังจากนั้น <span class="month-299"> 299 บาทต่อเดือน</span></p>

        <div class="container-box-free">
            <a href="/home" class="get-started">เริ่มต้นใช้งาน </a>
        </div>
        <div class="container-box-free">
            <a class="plans-all" href="{{ url('/plans-all') }}">ดูแพลนทั้งหมด</a>
        </div>
    </div>
@endsection
