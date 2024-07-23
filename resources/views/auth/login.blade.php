@extends('layouts.app')

@section('content')
    <div class="login-box">
        <p class="p-login">เข้าสู่ระบบ</p>

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
                    <a class="btn btn-link" href="{{ url('/') }}">
                        {{ __('go back home') }}
                    </a>

                </div>

            </form>
        </div>
    </div>
@endsection
