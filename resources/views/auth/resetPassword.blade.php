@extends('layouts.app')

@section('content')
    <div class="login-box">
        <p class="p-login">รีเซ็ทรหัสผ่านใหม่</p>

        <div class="form-login">
            <form method="POST" action="{{ route('reset-check-password') }}">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-12 input_box">
                        <select class="form-select @error('prefix') is-invalid @enderror" name="prefix"
                            aria-label="Default select example" required>
                            <option disabled selected>คำนำหน้าชื่อ</option>
                            <option value="นาย">นาย</option>
                            <option value="นาง">นาง</option>
                        </select>
                        @error('prefix')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col input_box">
                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                            name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name">
                        <label>ชื่อ</label>
                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col input_box">
                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                            name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">
                        <label>นามสกุล</label>
                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col input_box">
                        <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror"
                            name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                        <label>เบอร์ติดต่อ</label>
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col input_box">
                        <input id="id_card_number" type="number"
                            class="form-control @error('id_card_number') is-invalid @enderror" name="id_card_number"
                            value="{{ old('id_card_number') }}" required autocomplete="id_card_number">
                        <label>เลขบัตรประจำตัวประชาชน</label>
                        @error('id_card_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
                @if ($errors->any())
                    <img class="forgotLine" src="{{ URL::asset('/assets/image/welcome/forgotLine.png') }}">
                @endif

            </div>
        </div>
    </div>


    @include('auth.js')
@endsection
