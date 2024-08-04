@extends('layouts.app')

@section('content')
    <div class="login-box">
        <p class="p-login">เข้าสู่ระบบ</p>
        @if (session('message'))
            <p class="text-center mt-4" style="color: green"> {{ session('message') }}</p>
        @endif

        <div class="form-login">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-12 input_box">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">
                        <label>อีเมล</label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12 input_box">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" value="{{ old('password') }}" required autocomplete="password">
                        <label>รหัสผ่าน</label>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="submit-box">
                    <button type="submit" class="btn btn-register">
                        เข้าสู่ระบบ
                    </button>
                </div>
            </form>
            <div class="submit-box">
                <a class="btn btn-link" href="{{ url('/') }}">
                    {{ __('go back home') }}
                </a>
                <p class="btn-forgot" id="forgotPasswordBtn" href="javascript:void(0);">
                    {{ __('ลืมรหัสผ่าน') }}
                </p>
                <a href="https://line.me/R/ti/p/@347zwznd?oat_content=url" target="_blank" id="forgotLineImage"
                    rel="noopener noreferrer" style="display: none;">
                    <img class="forgotLine" src="{{ URL::asset('/assets/image/welcome/forgotLine.png') }}">
                </a>

            </div>
        </div>
    </div>
@endsection
