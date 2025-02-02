<p class="head-name-co">ข้อมูลของฉัน</p>
<div class="row mt-3 mb-3">
    <div class="col-md-12 mb-3 input_box">
        <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name"
            value="{{ old('user_name') }}" autocomplete="user_name">
        <label>ชื่อ*</label>
        @error('user_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row mt-3 mb-3">
    <div class="col-md-12 mb-3 input_box">
        <input id="user_surname" type="text" class="form-control @error('user_surname') is-invalid @enderror"
            name="user_surname" value="{{ old('user_surname') }}" autocomplete="user_surname">
        <label>นามสกุล*</label>
        @error('user_surname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row mt-3 mb-3">
    <div class="col-md-12 mb-3 input_box">
        <input id="user_phone" type="number" class="form-control @error('user_phone') is-invalid @enderror"
            name="user_phone" value="{{ old('user_phone') }}" autocomplete="user_phone">
        <label>เบอร์ติดต่อ*</label>
        @error('user_phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row mt-3 mb-3">
    <div class="col-md-12 mb-3 input_box">
        <input id="user_link_id" type="text" class="form-control @error('user_link_id') is-invalid @enderror"
            name="user_link_id" value="{{ old('user_link_id') }}" autocomplete="link_id">
        <label>LINE ID*</label>
        @error('user_link_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row mt-3 mb-3">
    <div class="col-md-12 mb-3 input_box">
        <input id="user_facebook" type="text" class="form-control @error('user_facebook') is-invalid @enderror"
            name="user_facebook" value="{{ old('user_facebook') }}" autocomplete="facebook">
        <label>Facebook*</label>
        @error('user_facebook')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="box-btn-block-center">
    <button type="button" class="btn btn-have-broker-back" onclick="previousStep()">
        กลับ
    </button>
    <button type="submit" class="btn btn-have-broker">
        ถัดไป
    </button>
</div>
