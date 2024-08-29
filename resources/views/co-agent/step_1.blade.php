<p class="skip-steps-co">กรอกรายละเอียดทีละข้อหรือ <span>
        <a class="next-step-cross" onclick="nextStepCross()"> แปะข้อมูลรวดเดียว</a>
    </span></p>
<p class="text-label-co">ประเภทสัญญา <span class="span-label-co">*</span></p>
<div class="mb-3">
    <div class="box-btn-type  {{ old('type_name_sell') == 'ขาย' ? 'active' : '' }}" id="btn-sell"
        data-input="type-name-sell" data-value="ขาย">
        ขาย
    </div>
    <div class="box-btn-type {{ old('type_name_hire_sell') == 'เช่าซื้อ/ขายผ่อน' ? 'active' : '' }}" id="btn-hire_sell"
        data-input="type-name-hire_sell" data-value="เช่าซื้อ/ขายผ่อน">
        เช่าซื้อ/ขายผ่อน
    </div>
    <div class="box-btn-type {{ old('type_name_hire') == 'เช่า' ? 'active' : '' }}" id="btn-hire"
        data-input="type-name-hire" data-value="เช่า">
        เช่า
    </div>
    <input type="text" id="type-name-sell" name="type_name_sell"
        value="{{ old('type_name_sell') == 'ขาย' ? 'ขาย' : 'null' }}" style="display: none">
    <input type="text" id="type-name-hire_sell" name="type_name_hire_sell"
        value="{{ old('type_name_hire_sell') == 'เช่าซื้อ/ขายผ่อน' ? 'เช่าซื้อ/ขายผ่อน' : 'null' }}"
        style="display: none">
    <input type="text" id="type-name-hire" name="type_name_hire"
        value="{{ old('name_have') == 'เช่า' ? 'เช่า' : 'null' }}" style="display: none">

</div>
<div class="mb-3 input_box3">
    <label>ประเภททรัพย์ <span style="color: red;margin-left: 6px;"> *</span> </label>
    <select class="form-select" name="property_type" id="property_type-co" aria-label="Default select example">
        <option selected value="บ้านเดี่ยว">บ้านเดี่ยว</option>
        <option value="คอนโด" {{ old('property_type') == 'คอนโด' ? 'selected' : '' }}>คอนโด </option>
        <option value="ทาวน์เฮ้าส์" {{ old('property_type') == 'ทาวน์เฮ้าส์' ? 'selected' : '' }}>ทาวน์เฮ้าส์</option>
        <option value="ที่ดิน" {{ old('property_type') == 'ที่ดิน' ? 'selected' : '' }}>ที่ดิน</option>
        <option value="พาณิชย์" {{ old('property_type') == 'พาณิชย์' ? 'selected' : '' }}>พาณิชย์</option>
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
        <div class="box-btn-have {{ old('name_have') == 'ไม่มี' ? 'active' : '' }}" style="margin-right: 10px;">
            ไม่มี
        </div>
        <div class="box-btn-have {{ old('name_have') == 'มี' ? 'active' : 'active' }}" style="margin-right: 10px;">
            มี
        </div>

        <div class="input_box2" id="have-no">
            <label style="margin-right: 10px;">มีภาระหนี้กับ <span style="color: red; margin-left: 6px;">
                    *</span></label>
            <div style="display: flex">
                <input id="name-have" type="text" name="name_have"
                    class="form-control @error('phone') is-invalid @enderror" autocomplete="phone" maxlength="50"
                    value="{{ old('name_have') }}">
                <span>
                    <img class="img-info" src="{{ URL::asset('/assets/image/welcome/info.png') }}"
                        onclick="messageID('สถาบันการเงิน เช่น ชื่อธนาคารที่ทรัพย์จด จำนองไว้')"
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
    <select class="form-select" name="minimum_rent" aria-label="Default select example">
        <option value="" disabled selected>เช่าขั้นต่ำ*</option>
        <option value="1" {{ old('minimum_rent') == '1' ? 'selected' : '' }}>1 เดือน</option>
        <option value="2" {{ old('minimum_rent') == '2' ? 'selected' : '' }}>2 เดือน</option>
        <option value="3" {{ old('minimum_rent') == '3' ? 'selected' : '' }}>3 เดือน</option>
        <option value="6" {{ old('minimum_rent') == '6' ? 'selected' : '' }}>6 เดือน</option>
        <option value="12" {{ old('minimum_rent') == '12' ? 'selected' : '' }}>12 เดือน</option>
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
    <input id="datepicker-co" class="datepicker-co" name="start_renting" value="{{ old('start_renting') }}" />
</div>

<p class="head-name-co">ที่ตั้ง</p>
<div class="mb-3 house-number">
    <div class="row">
        <div class="col-md-12 mb-3 input_box">
            <input id="house_number" type="text" class="form-control  @error('house_number') is-invalid @enderror"
                name="house_number" value="{{ old('house_number') }}" autocomplete="house_number">
            <label>บ้านเลขที่</label>
            @error('house_number')
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
            <input id="house_name" type="text" class="form-control  @error('house_name') is-invalid @enderror"
                name="house_name" value="{{ old('house_name') }}" autocomplete="house_name">
            <label>โครงการ เช่น ชื่อหมู่บ้าน</label>
            @error('house_name')
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
            <input id="road" type="text" class="form-control  @error('road') is-invalid @enderror"
                name="road" value="{{ old('road') }}" autocomplete="road">
            <label>ถนน*</label>
            @error('road')
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
            <input id="alley" type="text" class="form-control  @error('alley') is-invalid @enderror"
                name="alley" value="{{ old('alley') }}" autocomplete="alley">
            <label>ซอย</label>
            @error('alley')
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
                    <input id="number_bedrooms" type="text"
                        class="form-control col-12  @error('number_bedrooms') is-invalid @enderror"
                        name="number_bedrooms" value="{{ old('number_bedrooms') }}" autocomplete="number_bedrooms">
                    <label>จำนวนห้องนอน *</label>
                    @error('number_bedrooms')
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
                    <input id="number_bathrooms" type="text"
                        class="form-control col-12  @error('number_bathrooms') is-invalid @enderror"
                        name="number_bathrooms" value="{{ old('number_bathrooms') }}"
                        autocomplete="number_bathrooms">
                    <label>จำนวนห้องน้ำ*</label>
                    @error('number_bathrooms')
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
                    <input id="number_floors" type="text"
                        class="form-control col-12  @error('number_floors') is-invalid @enderror" name="number_floors"
                        value="{{ old('number_floors') }}" autocomplete="number_floors">
                    <label>จำนวนชั้น*</label>
                    @error('number_floors')
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
                    <input id="number_parking" type="text"
                        class="form-control col-12  @error('number_parking') is-invalid @enderror"
                        name="number_parking" value="{{ old('number_parking') }}" autocomplete="number_parking">
                    <label>จำนวนที่จอดรถ*</label>
                    @error('number_parking')
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
                    <select class="form-select" aria-label="Default select example" name="studio_name"
                        id="studio_name">
                        <option value="สตูดิโอ" {{ old('studio_name') == 'สตูดิโอ' ? 'selected' : '' }}>สตูดิโอ
                        </option>
                        <option value="ไม่สตูดิโอ" {{ old('studio_name') == 'ไม่สตูดิโอ' ? 'selected' : '' }}>
                            ไม่สตูดิโอ
                        </option>
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
            <input id="size_sq_m" type="text"
                class="form-control col-12  @error('size_sq_m') is-invalid @enderror" name="size_sq_m"
                value="{{ old('size_sq_m') }}" autocomplete="size_sq_m">
            <label>ขนาด* (ตร.ว.)</label>
            @error('size_sq_m')
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
            <input id="rent_baht_month" type="text"
                class="form-control  @error('rent_baht_month') is-invalid @enderror" name="rent_baht_month"
                value="{{ old('rent_baht_month') }}" autocomplete="rent_baht_month">
            <label>ค่าเช่า* (บาท/เดือน)</label>
            @error('rent_baht_month')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <p class="text-label-co">ให้มีการชำระค่าใช้จ่ายใดต่อไปนี้ <span class="span-label-co">*</span></p>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="month_advance_rent"
            value="1" {{ old('month_advance_rent') ? 'checked' : '' }}>
        <label class="form-check-label" for="flexCheckDefault">
            ค่าเช่าล่วงหน้า 1 เดือน <span>
                <img class="img-info" src="{{ URL::asset('/assets/image/welcome/info.png') }}"
                    onclick="messageID('ค่าเช่าล่วงหน้า คือ ค่าเช่าในเดือน แรกที่ต้องการให้ ผู้เช่าจ่ายก่อนอยู่ ส่วนในเดือนต่อ ๆ ไปจะเป็นรูปแบบ อยู่จนครบเดือนแล้วจึงจ่าย  กฎหมายกำหนดให้เก็บได้ไม่เกิน 1 เดือน')">
            </span>
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" id="month-advance-rent"
            {{ old('deposit_month_checkbox') ? 'checked' : '' }}>
        <label class="form-check-label" for="flexCheckDeposit">
            เงินมัดจำ <span>
                <img class="img-info" src="{{ URL::asset('/assets/image/welcome/info.png') }}"
                    onclick="messageID('เงินมัดจำ หรือ เงินประกัน คือ ประกันความเสีย หายของทรัพย์ที่ เช่า โดยหากมีความเสียหายในวัน สิ้นสุดสัญญา เงินส่วนนี้จะถูกนำมา ชดใช้ความเสียหาย แต่หากไม่มี ความเสียหาย หรือมีแต่ความเสีย หายตาม ปกติธรรมดาของการใช้ ทรัพย์ตามปกติ เจ้าของต้องคืนเงิน ประกันนี้ ภายใน 7 วันนับแต่วันสิ้น สุดสัญญา โดยหากมีการเก็บเงิน จองไปแล้ว จะต้องจ่าย เพียงเท่าที่ ไม่ได้จ่ายไปตอนจอง เช่น หากจ่าย เงินจองแล้ว 5,000 บาท เงินมัดจำ ก็จะลดลง 5,000 บาทในภายหลัง')">
            </span>
        </label>
        <input type="text" class="form-control" id="month-advance-rent-input" name="deposit_month"
            value="" placeholder="เงินมัดจำ (เดือน)*" style="display: none">
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="reservation-money"
            {{ old('reservation_money_checkbox') ? 'checked' : '' }}>
        <label class="form-check-label" for="flexCheckBooking">
            เงินจอง <span>
                <img class="img-info" src="{{ URL::asset('/assets/image/welcome/info.png') }}"
                    onclick="messageID('เงินจอง คือ หลักประกันว่าผู้เช่าจะ มาเช่าจริงตามที่สัญญาไว้ โดยสา- มารถริบได้ หากไม่ได้มาเช่าจริง เพื่อ เป็นค่าเสียโอกาสให้เจ้าของ  โดยทั่วไปเก็บไม่เกิน 5,000 บาท')">
            </span>
        </label>
        <input type="text" class="form-control" id="reservation-money-input" placeholder="เงินจอง *"
            value=" {{ old('reservation_money_checkbox') }}" name="reservation_money" style="display: none">
    </div>
    <p class="text-reservation-money">เงินมัดจำ ค่าเช่าล่วงหน้า และเงินประกัน กฎหมายกำหนดว่ารวม กันต้องไม่เกิน 3
        เดือนของค่าเช่า</p>

</div>
<div id="selling-price" style="display: none">
    <p class="head-name-co">ราคาขาย</p>
    <div class="row mb-3">
        <div class="input_box">
            <input id="selling_price_baht" type="text"
                class="form-control col-12  @error('selling_price_baht') is-invalid @enderror"
                name="selling_price_baht)" value="{{ old('selling_price_baht') }}"
                autocomplete="selling_price_baht">
            <label>ราคาขาย* (บาท)</label>
            @error('selling_price_baht')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <div class="input_box">

            <input id="reservation_amount_baht" type="text"
                class="form-control col-12  @error('reservation_amount_baht') is-invalid @enderror"
                name="reservation_amount_baht" value="{{ old('reservation_amount_baht') }}"
                autocomplete="reservation_amount_baht">


            <label>จำนวนเงินจอง* (บาท)</label>
            <span>
                <img class="img-info2" src="{{ URL::asset('/assets/image/welcome/info.png') }}"
                    onclick="messageID('เป็นเสมือนเงินมัดจำของสัญญาซื้อขาย เป็นหลักประกันว่าเขากำลังจะมาซื้อทรัพย์กับคุณ โดยทั่วไปกำหนดอยู่ที่ 5,000-10,000 บาท ขึ้นอยู่กับมูลค่าของทรัพย์นั้น')">
            </span>
            @error('reservation_amount_baht')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <div class="input_box">
            <input id="down_payment_amount" type="text"
                class="form-control col-12  @error('down_payment_amount') is-invalid @enderror"
                name="down_payment_amount" value="{{ old('down_payment_amount') }}"
                autocomplete="down_payment_amount">
            <label>จำนวนดาวน์* (%)</label>
            @error('down_payment_amount')
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
                            <input id="many_installments" type="text"
                                class="form-control col-12  @error('many_installments') is-invalid @enderror"
                                name="many_installments" value="{{ old('many_installments') }}"
                                autocomplete="many_installments">
                            <label>ผ่อนได้กี่งวด* (เดือน)</label>
                            @error('many_installments')
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
                            <input id="each_installment_baht" type="text"
                                class="form-control col-12  @error('each_installment_baht') is-invalid @enderror"
                                name="each_installment_baht" value="{{ old('each_installment_baht') }}"
                                autocomplete="each_installment_baht">
                            <label>งวดละ* (บาท)</label>
                            @error('each_installment_baht')
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
    function messageID(evn) {

        Swal.fire({
            text: evn,
            /* icon: 'success', */
            showConfirmButton: true, // ปุ่มยืนยันจะไม่หายไปเอง
            confirmButtonText: 'ปิด', // ข้อความบนปุ่มยืนยัน
            customClass: {
                confirmButton: 'swal-btn-down' // ตั้งชื่อคลาสสำหรับปุ่มยืนยัน
            }
        });

    }
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
                    inputElement.value = null;
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
                const idNameHave = document.getElementById('name-have');
                typeNameInput.style.display = 'none';
                idNameHave.value = null;
                //name-have
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
            const ideach_installment_baht = document.getElementById('each_installment_baht');
            const idmany_installments = document.getElementById('many_installments');
            if (this.textContent.trim() == "ผ่อนดาวน์ได้") {
                typeNamedown.style.display = 'block';
            } else {
                typeNamedown.style.display = 'none';

                ideach_installment_baht.value = null;
                idmany_installments.value = null;
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
        const idNumberParking = document.getElementById('number_parking');
        const idStudioName = document.getElementById('studio_name');
        //studio_name number_parking
        if (selectedValue == 'คอนโด') {
            idNumberParking.value = null
            notStudio.style.display = 'inline-block';
            numberParking.style.display = 'none';
        } else {
            notStudio.style.display = 'none';
            numberParking.style.display = 'inline-block';
            idStudioName.value = null
        }

        // คุณสามารถเพิ่มโค้ดอื่น ๆ ที่คุณต้องการใช้กับค่า selectedValue ที่นี่
    });
</script>
