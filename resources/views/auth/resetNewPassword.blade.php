@extends('layouts.app')

@section('content')
    <div class="login-box">
        <p class="p-login">รีเซ็ทรหัสผ่านใหม่</p>

        <div class="form-login">
            <form method="POST" action="{{ route('reset-new-password', $query[0]->id) }}">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-12 input_box">
                        <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror"
                            name="email" value="{{ $query[0]->email }}" required autocomplete="email" readonly>
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
                            name="password" required autocomplete="new-password" value="{{ old('password') }}">
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
                        <input id="password-confirm" type="password"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation" required autocomplete="new-password"
                            value="{{ old('password_confirmation') }}">
                        <label>ยืนยันรหัสผ่าน</label>
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="submit-box">
                    <button type="submit" id="submitBtn" class="btn btn-register" disabled style="background-color: gray;">
                        บันทึก
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
