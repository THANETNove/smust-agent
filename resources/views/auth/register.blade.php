@extends('layouts.app')

@section('content')
    <div class="login-box">
        <p class="p-login">ลงทะเบียน</p>
        <?php
        $data = DB::table('provinces')
            ->orderBy('name_th', 'ASC')
            ->get();
        ?>

        <div class="form-login">
            <form method="POST" action="{{ route('register') }}">
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
                <p class="information">ข้อมูลของฉัน</p>

                <div class="row mb-3">
                    <div class="col-md-12 mb-3 input_box">
                        <select class="form-select" name="prefix" aria-label="Default select example">
                            <option value="นาย">นาย</option>
                            <option value="นาง">นาง</option>
                            <option value="นางสาว">นางสาว</option>
                        </select>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 mb-3 input_box">
                        <input id="text" type="text" class="form-control  @error('first_name') is-invalid @enderror"
                            name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name">
                        <label>ชื่อ <span class="label-span">*</span></label>
                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3 input_box">
                        <input id="last_name" type="text" class="form-control  @error('last_name') is-invalid @enderror"
                            name="last_name" value="{{ old('last_name') }}" required autocomplete="email">
                        <label>นามสกุล <span class="label-span">*</span></label>
                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12 mb-3 input_box">
                        <input id="phone" type="text" class="form-control  @error('phone') is-invalid @enderror"
                            name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                        <label>เบอร์ติดต่อ <span class="label-span">*</span></label>
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12 mb-3 input_box">
                        <input id="id_card_number" type="text"
                            class="form-control  @error('id_card_number') is-invalid @enderror" name="id_card_number"
                            value="{{ old('id_card_number') }}" required autocomplete="id_card_number">
                        <label>เลขบัตรประจำตัวประชาชน <span class="label-span">*</span></label>
                        @error('id_card_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12 mb-3 input_box">
                        <select class="form-select" name="provinces" aria-label="Default select example">
                            @foreach ($data as $provinces)
                                <option value="{{ $provinces->name_th }}">{{ $provinces->name_th }}</option>
                            @endforeach
                        </select>

                        @error('provinces')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                {{-- <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div> --}}
                <div class="submit-box">
                    <button type="submit" class="btn btn-register">
                        ลงทะเบียน
                    </button>
                    <a class="btn btn-link mb-5" href="{{ url('/') }}">
                        {{ __('go back home') }}
                    </a>

                </div>
            </form>
        </div>
    </div>
@endsection
