@extends('layouts.app')

@section('content')
    <div class="smust-agent">
        <img class="smust-agent-logo" src="{{ URL::asset('/assets/image/home/SMUSTAgentlogo.png') }}">
        <a href="{{ route('register-broker', 'OWNER-d1i6HMR37x') }}" class="btn btn-register">
            ลงทะเบียน
        </a>
        <p class="already-registered">หากลงทะเบียนแล้ว...</p>
        <a href="{{ route('login') }}" class="btn btn-login">
            เข้าสู่ระบบ
        </a>
    </div>
@endsection
