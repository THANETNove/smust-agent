@extends('layouts.app')

@section('content')
    <div class="login-box">
        <p class="p-login">รีเซ็ทรหัสผ่านใหม่</p>

        <div class="form-login">
            <form method="POST" action="{{ route('reset-check-password') }}">
                @csrf


                <div class="row mb-3">
                    <div class="col-md-12 input_box">
                        <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror"
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
                        <input id="password" type="password" class="form-control  @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">
                        <label>รหัสผ่าน</label>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-md-12 input_box">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">
                        <label>ยืนยันรหัสผ่าน</label>
                    </div>
                </div>


                <div class="submit-box">
                    <button type="submit" id="submitBtn" class="btn btn-register " disabled
                        style="background-color: gray;">
                        เข้าสู่ระบบ
                    </button>
                </div>
            </form>
            <div class="submit-box">
                <a class="btn btn-link" href="{{ url('/') }}">
                    {{ __('go back home') }}
                </a>

            </div>
        </div>
    </div>


    @include('auth.js')
@endsection
