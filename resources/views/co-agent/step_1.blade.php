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

        <div class="input_box2">
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

    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="บ้านเลขที่">
</div>
<div class="mb-3 house-name">

    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="โครงการ เช่น ชื่อหมู่บ้าน">
</div>
<div class="mb-3">
    @include('layouts.address')
</div>
<div class="mb-3">

    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="ถนน*">
</div>
<div class="mb-3">
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="ซอย">
</div>
<div class="mb-3">
    @include('assetsCustomer.trainStation')
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
