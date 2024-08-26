<p class="text-label-co">ประเภทสัญญา <span class="span-label-co">*</span></p>
<div class="mb-3">
    <div class="box-btn-type">
        ขาย
    </div>
    <div class="box-btn-type active">
        เช่าซื้อ/ขายผ่อน
    </div>
    <div class="box-btn-type">
        เช่า
    </div>
    <input type="text" id="type-name" name="type_name" value="เช่าซื้อ/ขายผ่อน" style="display: none">
</div>
<div class="mb-3 input_box3">
    <label>ประเภททรัพย์ <span style="color: red;margin-left: 6px;"> *</span> </label>
    <select class="form-select" name="property_type" aria-label="Default select example">
        <option selected value="บ้านเดี่ยว">บ้านเดี่ยว</option>
        <option value="คอนโด">คอนโด </option>
        <option value="ทาวน์เฮ้าส์">ทาวน์เฮ้าส์</option>
        <option value="ที่ดิน">ที่ดิน</option>
        <option value="พาณิชย์">พาณิชย์</option>
    </select>
    @error('id_card_number')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="mb-3 deed-include">
    <label style="display: flex; align-items: center;">โฉนดมีภาระหนี้หรือไม่
        <span style="color: red; margin-left: 6px;"> *</span>
    </label>

    <div style="display: flex; align-items: center;">
        <div class="box-btn-have" style="margin-right: 10px;">
            ไม่มี
        </div>
        <div class="box-btn-have active" style="margin-right: 10px;">
            มี
        </div>

        <div class="input_box2" id="have-no">
            <label style="margin-right: 10px;">มีภาระหนี้กับ <span style="color: red; margin-left: 6px;">
                    *</span></label>
            <input id="text" type="text" name="name_"
                class="form-control @error('phone') is-invalid @enderror" autocomplete="phone" maxlength="50">
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>


<div class="mb-3">
    <select class="form-select" name="property_type" aria-label="Default select example">
        <option selected disabled>เช่าขั้นต่ำ*</option>
        <option value="1">1 เดือน </option>
        <option value="2">2 เดือน</option>
        <option value="3">3 เดือน</option>
        <option value="6">6 เดือน</option>
        <option value="12">12 เดือน</option>
    </select>
    @error('id_card_number')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="box-datepicker-co mb-3">
    {{-- <label style="margin-right: 10px;">เริ่มให้เช่าได้ตั้งแต่</label> --}}
    <img class="img-datepicker" src="{{ URL::asset('/assets/image/welcome/calendar_month.png') }}">
    <div class="datepicker-line"></div>
    <p class="placeholder-co">เริ่มให้เช่าได้ตั้งแต่</p>
    <input id="datepicker-co" class="datepicker-co" />
</div>

<p class="head-name-co">ที่ตั้ง</p>
<div class="mb-3 house-number">
    <div class="row">
        <div class="col-md-12 mb-3 input_box">
            <input id="phone" type="text" class="form-control  @error('phone') is-invalid @enderror"
                name="phone" value="{{ old('phone') }}" required autocomplete="phone">
            <label>บ้านเลขที่</label>
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
<div class="mb-3 house-name">
    <div class="row ">
        <div class="col-md-12 mb-3 input_box">
            <input id="phone" type="text" class="form-control  @error('phone') is-invalid @enderror"
                name="phone" value="{{ old('phone') }}" required autocomplete="phone">
            <label>โครงการ เช่น ชื่อหมู่บ้าน</label>
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
<div class="mb-3">
    @include('layouts.address')
</div>
<div class="mb-3">
    <div class="row">
        <div class="col-md-12 mb-3 input_box">
            <input id="phone" type="text" class="form-control  @error('phone') is-invalid @enderror"
                name="phone" value="{{ old('phone') }}" required autocomplete="phone">
            <label>ถนน*</label>
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
<div class="mb-3">
    <div class="row">
        <div class="col-md-12 mb-3 input_box">
            <input id="phone" type="text" class="form-control  @error('phone') is-invalid @enderror"
                name="phone" value="{{ old('phone') }}" required autocomplete="phone">
            <label>ซอย</label>
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

</div>
<div class="mb-3">
    @include('assetsCustomer.trainStation')
</div>

<p class="head-name-co">ลักษณะ</p>
<div class="house-frame mb-3">
    <div class="box-screenshot-frame">
        <img class="image-screenshot_frame" src="{{ URL::asset('/assets/image/welcome/bed.png') }}">
        <div class="row">
            <div class="input_box">
                <input id="phone" type="text"
                    class="form-control col-12  @error('phone') is-invalid @enderror" name="phone"
                    value="{{ old('phone') }}" required autocomplete="phone">
                <label>จำนวนห้องนอน *</label>
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="house-frame mb-3">
    <div class="box-screenshot-frame">
        <img class="image-screenshot_frame" src="{{ URL::asset('/assets/image/welcome/shower.png') }}">
        <div class="row">
            <div class="input_box">
                <input id="phone" type="text"
                    class="form-control col-12  @error('phone') is-invalid @enderror" name="phone"
                    value="{{ old('phone') }}" required autocomplete="phone">
                <label>จำนวนห้องน้ำ*</label>
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="house-frame mb-3">
    <div class="box-screenshot-frame">
        <img class="image-screenshot_frame" src="{{ URL::asset('/assets/image/welcome/floor.png') }}">
        <div class="row">
            <div class="input_box">
                <input id="phone" type="text"
                    class="form-control col-12  @error('phone') is-invalid @enderror" name="phone"
                    value="{{ old('phone') }}" required autocomplete="phone">
                <label>จำนวนชั้น*</label>
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="house-frame mb-3">
    <div class="box-screenshot-frame">
        <img class="image-screenshot_frame" src="{{ URL::asset('/assets/image/welcome/directions_car.png') }}">
        <div class="row">
            <div class="input_box">
                <input id="phone" type="text"
                    class="form-control col-12  @error('phone') is-invalid @enderror" name="phone"
                    value="{{ old('phone') }}" required autocomplete="phone">
                <label>จำนวนที่จอดรถ*</label>
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="box-screenshot-frame mb-3 ">
    <img class="image-screenshot_frame" src="{{ URL::asset('/assets/image/welcome/screenshot_frame.png') }}">

    <div class="row" style="width: 350px">
        <div class="input_box">
            <input id="phone" type="text" class="form-control col-12  @error('phone') is-invalid @enderror"
                name="phone" value="{{ old('phone') }}" required autocomplete="phone">
            <label>ขนาด* (ตร.ว.)</label>
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

<p class="head-name-co">ราคาเช่า</p>
<div class="row mb-3">
    <div class="col-md-12 mb-3 input_box">
        <input id="phone" type="text" class="form-control  @error('phone') is-invalid @enderror"
            name="phone" value="{{ old('phone') }}" required autocomplete="phone">
        <label>ค่าเช่า* (บาท/เดือน)</label>
        @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<p class="text-label-co">ให้มีการชำระค่าใช้จ่ายใดต่อไปนี้ <span class="span-label-co">*</span></p>

<div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
    <label class="form-check-label" for="flexCheckDefault">
        ค่าเช่าล่วงหน้า 1 เดือน
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
    <label class="form-check-label" for="flexCheckChecked">
        เงินมัดจำ
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
    <label class="form-check-label" for="flexCheckChecked">
        เงินจอง
    </label>
</div>

<script>
    const buttons = document.querySelectorAll('.box-btn-type');
    const typeNameInput = document.getElementById('type-name');

    buttons.forEach(button => {
        button.addEventListener('click', function() {
            // ลบ active class จากทุกปุ่ม
            buttons.forEach(btn => btn.classList.remove('active'));

            // เพิ่ม active class ไปยังปุ่มที่ถูกกด
            this.classList.add('active');

            // อัปเดตค่าใน input ที่ซ่อนอยู่
            typeNameInput.value = this.textContent.trim();
        });
    });

    const buttonshave = document.querySelectorAll('.box-btn-have');

    buttonshave.forEach(buttonhave => {
        buttonhave.addEventListener('click', function() {
            // ลบ active class จากทุกปุ่ม
            buttonshave.forEach(btn => btn.classList.remove('active'));

            // เพิ่ม active class ไปยังปุ่มที่ถูกกด
            this.classList.add('active');

            // อัปเดตค่าใน input ที่ซ่อนอยู่
            const typeNameInput = document.getElementById('have-no');
            if (this.textContent.trim() == "มี") {
                typeNameInput.style.display = 'inline';
            } else {
                typeNameInput.style.display = 'none';
            }


        });
    });


    $(function() {
        $.datepicker.setDefaults($.datepicker.regional['th']); // ใช้การตั้งค่าภาษาไทย
        $("#datepicker-co").datepicker({
            dateFormat: 'dd MM yy', // รูปแบบวันที่ที่เราต้องการ
            onSelect: function(dateText, inst) {
                // แปลงวันที่เป็นพุทธศักราช
                var date = $(this).datepicker('getDate');
                var buddhistYear = date.getFullYear() + 543;
                var thaiMonth = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
                    "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
                ];
                var formattedDate = date.getDate() + " " + thaiMonth[date.getMonth()] + " " +
                    buddhistYear;
                $(this).val(formattedDate);
            }
        });
    });
</script>
