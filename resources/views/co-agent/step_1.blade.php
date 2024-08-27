<p class="text-label-co">ประเภทสัญญา <span class="span-label-co">*</span></p>
<div class="mb-3">
    <div class="box-btn-type" id="btn-sell" data-input="type-name-sell" data-value="ขาย">
        ขาย
    </div>
    <div class="box-btn-type" id="btn-hire_sell" data-input="type-name-hire_sell" data-value="เช่าซื้อ/ขายผ่อน">
        เช่าซื้อ/ขายผ่อน
    </div>
    <div class="box-btn-type" id="btn-hire" data-input="type-name-hire" data-value="เช่า">
        เช่า
    </div>
    <input type="text" id="type-name-sell" name="type_name" value="null" style="display: none">
    <input type="text" id="type-name-hire_sell" name="type_name" value="null" style="display: none">
    <input type="text" id="type-name-hire" name="type_name" value="null" style="display: none">
</div>
<div class="mb-3 input_box3">
    <label>ประเภททรัพย์ <span style="color: red;margin-left: 6px;"> *</span> </label>
    <select class="form-select" name="property_type" id="property_type-co" aria-label="Default select example">
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
            <div style="display: flex">
                <input id="text" type="text" name="name_"
                    class="form-control @error('phone') is-invalid @enderror" autocomplete="phone" maxlength="50">
                <span>
                    <img class="img-info" src="{{ URL::asset('/assets/image/welcome/info.png') }}"
                        style="margin-top: 8px">
                </span>
            </div>
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>


<div class="mb-3" id="minimum-rental" style="display: none">
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
<div id="nature-co">
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
    <div class="house-frame mb-3" id="number-parking">
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
    <div class="house-frame mb-3" id="not-studio" style="display: none">
        <div class="box-screenshot-frame">
            <img class="image-screenshot_frame" src="{{ URL::asset('/assets/image/welcome/countertops.png') }}">
            <div class="row">
                <div class="input_box">
                    <select class="form-select" aria-label="Default select example">
                        <option value="สตูดิโอ" selected>สตูดิโอ</option>
                        <option value="ไม่สตูดิโอ">ไม่สตูดิโอ</option>
                    </select>
                </div>
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
<div id="rental-price" style="display:none">
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
            ค่าเช่าล่วงหน้า 1 เดือน <span>
                <img class="img-info" src="{{ URL::asset('/assets/image/welcome/info.png') }}">
            </span>
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="month-advance-rent">
        <label class="form-check-label" for="flexCheckDeposit">
            เงินมัดจำ <span>
                <img class="img-info" src="{{ URL::asset('/assets/image/welcome/info.png') }}">
            </span>
        </label>
        <input type="text" class="form-control" id="month-advance-rent-input" placeholder="เงินมัดจำ (เดือน)*"
            style="display: none">
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="reservation-money">
        <label class="form-check-label" for="flexCheckBooking">
            เงินจอง <span>
                <img class="img-info" src="{{ URL::asset('/assets/image/welcome/info.png') }}">
            </span>
        </label>
        <input type="text" class="form-control" id="reservation-money-input" placeholder="เงินจอง *"
            style="display: none">
    </div>
    <p class="text-reservation-money">เงินมัดจำ ค่าเช่าล่วงหน้า และเงินประกัน กฎหมายกำหนดว่ารวม กันต้องไม่เกิน 3
        เดือนของค่าเช่า</p>

</div>
<div id="selling-price" style="display: none">
    <p class="head-name-co">ราคาขาย</p>
    <div class="row mb-3">
        <div class="input_box">
            <input id="phone" type="text" class="form-control col-12  @error('phone') is-invalid @enderror"
                name="phone" value="{{ old('phone') }}" required autocomplete="phone">
            <label>ราคาขาย* (บาท)</label>
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <div class="input_box">

            <input id="phone" type="text" class="form-control col-12  @error('phone') is-invalid @enderror"
                name="phone" value="{{ old('phone') }}" required autocomplete="phone">


            <label>จำนวนเงินจอง* (บาท)</label>
            <span>
                <img class="img-info2" src="{{ URL::asset('/assets/image/welcome/info.png') }}">
            </span>
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <div class="input_box">
            <input id="phone" type="text" class="form-control col-12  @error('phone') is-invalid @enderror"
                name="phone" value="{{ old('phone') }}" required autocomplete="phone">
            <label>จำนวนดาวน์* (%)</label>
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <p class="text-label-co">ให้ผ่อนดาวน์ได้ไหม <span class="span-label-co">*</span></p>
    <div class="mb-3 deed-include">
        <div style="display: flex; align-items: center;">
            <div class="box-btn-down" style="margin-right: 10px;">
                ไม่ได้
            </div>
            <div class="box-btn-down  active" style="margin-right: 10px;">
                ผ่อนดาวน์ได้
            </div>
        </div>
        <div id="input-down">
            <div class="house-frame mb-3">
                <div class="box-screenshot-frame">
                    <div class="row">
                        <div class="input_box">
                            <input id="phone" type="text"
                                class="form-control col-12  @error('phone') is-invalid @enderror" name="phone"
                                value="{{ old('phone') }}" required autocomplete="phone">
                            <label>ผ่อนได้กี่งวด* (เดือน)</label>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="house-frame">
                <div class="box-screenshot-frame">
                    <div class="row">
                        <div class="input_box">
                            <input id="phone" type="text"
                                class="form-control col-12  @error('phone') is-invalid @enderror" name="phone"
                                value="{{ old('phone') }}" required autocomplete="phone">
                            <label>งวดละ* (บาท)</label>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="submit-box mb-3">
    <button type="button" class="btn btn-register" onclick="nextStep()">
        ถัดไป
    </button>

</div>
<script>
    const buttons = document.querySelectorAll('.box-btn-type');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const inputId = this.getAttribute('data-input');
            const inputElement = document.getElementById(inputId);
            const typeInputhire = document.getElementById('rental-price');
            const typeSellingprice = document.getElementById('selling-price');
            const minimumRental = document.getElementById('minimum-rental');

            if (inputElement) { // ตรวจสอบว่า inputElement ไม่ใช่ null
                if (this.classList.contains('active')) {
                    this.classList.remove('active');
                    inputElement.value = 'null';
                } else {
                    this.classList.add('active');
                    inputElement.value = this.getAttribute('data-value');
                }
            } else {
                console.error('Element with id ' + inputId + ' not found.');
            }

            // ตรวจสอบค่าของ inputElement.value ทั้งสองปุ่ม
            const hireSell = document.getElementById('type-name-sell').value;

            const hireSellValue = document.getElementById('type-name-hire_sell').value;
            const hireValue = document.getElementById('type-name-hire').value;

            if (hireValue !== 'null' || hireSellValue !== 'null') {
                typeInputhire.style.display = 'block';
            } else {
                typeInputhire.style.display = 'none';
            }
            if (hireSell !== 'null' || hireSellValue !== 'null') {
                typeSellingprice.style.display = 'block';
            } else {
                typeSellingprice.style.display = 'none';
            }
            if (hireValue !== 'null') {
                minimumRental.style.display = 'block';
            } else {
                minimumRental.style.display = 'none';
            }
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

    const buttonsdown = document.querySelectorAll('.box-btn-down');

    buttonsdown.forEach(buttondown => {
        buttondown.addEventListener('click', function() {
            // ลบ active class จากทุกปุ่ม
            buttonsdown.forEach(btn => btn.classList.remove('active'));

            // เพิ่ม active class ไปยังปุ่มที่ถูกกด
            this.classList.add('active');

            // อัปเดตค่าใน input ที่ซ่อนอยู่
            const typeNamedown = document.getElementById('input-down');
            if (this.textContent.trim() == "ผ่อนดาวน์ได้") {
                typeNamedown.style.display = 'block';
            } else {
                typeNamedown.style.display = 'none';
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

    document.getElementById('reservation-money').addEventListener('change', function() {
        const depositInput = document.getElementById('reservation-money-input');
        depositInput.style.display = this.checked ? 'block' : 'none';
    });

    document.getElementById('month-advance-rent').addEventListener('change', function() {
        const bookingInput = document.getElementById('month-advance-rent-input');
        bookingInput.style.display = this.checked ? 'block' : 'none';
    });

    document.getElementById('property_type-co').addEventListener('change', function() {
        const selectedValue = this.value;
        console.log("Selected property type:", selectedValue);
        const natureCoInput = document.getElementById('nature-co');
        natureCoInput.style.display = selectedValue == "ที่ดิน" ? 'none' : 'block';


        const numberParking = document.getElementById('number-parking');
        const notStudio = document.getElementById('not-studio');

        if (selectedValue == 'คอนโด') {
            notStudio.style.display = 'inline-block';
            numberParking.style.display = 'none';
        } else {
            notStudio.style.display = 'none';
            numberParking.style.display = 'inline-block';
        }

        // คุณสามารถเพิ่มโค้ดอื่น ๆ ที่คุณต้องการใช้กับค่า selectedValue ที่นี่
    });
</script>
