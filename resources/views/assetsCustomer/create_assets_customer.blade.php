@extends('layouts.app')

@section('content')
    <div>
        <div>
            <a href="javascript:void(0);" onclick="goBack()">
                <img class="free-go-back" src="{{ URL::asset('/assets/image/welcome/go-back.png') }}">
            </a>
            <p class="free-trial">
                สร้างประกาศ
            </p>

        </div>
        <div class="box-free-customer">
            <p class="co-agent">สร้างโพสประกาศหา co-agent ที่มีทรัพย์</p>
            <p class="contract-type">ประเภทสัญญา <span style="color: red">*</span></p>
            <div class="row-box">
                <div class="filter-box-input2 form-check" data-type="sell">
                    <input class="form-check-input" type="radio" name="filterOptions" id="filterStation"
                        onclick="toggleSelectionBox(this)">
                    <label class="form-check-label" for="filterStation">

                        ขาย
                    </label>
                </div>
                <div class="filter-box-input2 form-check" data-type="area">
                    <input class="form-check-input" type="radio" name="filterOptions" id="filterArea"
                        onclick="toggleSelectionBox(this)">
                    <label class="form-check-label" for="filterArea">

                        เช่า
                    </label>
                </div>
            </div>
            <div class="row mb-3 mt-4">
                <div class="col-md-12 ">
                    <label>เลขบัตรประจำตัวประชาชน <span style="color: red;margin-left: 6px;"> *</span> </label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected value="บ้านเดี่ยว">บ้านเดี่ยว</option>
                        <option value="คอนโด">คอนโด </option>
                        <option value="ทาวน์เฮ้าส์ (ADD)">ทาวน์เฮ้าส์ (ADD)</option>
                        <option value="ที่ดิน (ADD)">ที่ดิน (ADD)</option>
                        <option value="พาณิชย์ (ADD)">พาณิชย์ (ADD)</option>
                    </select>
                    @error('id_card_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <p class="price-range">ช่วงราคา</p>
            <div class="row-box mt-3">
                <div> <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="ราคา (บาท)">
                </div>
                <span style="margin-top: 8px">ถึง</span>
                <div> <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="ราคา* (บาท)">
                </div>
            </div>
            <p class="price-range mt-3">ทำเล</p>
            <select class="form-select" aria-label="Default select example">
                <option selected value="บ้านเดี่ยว">บ้านเดี่ยว</option>
                <option value="คอนโด">คอนโด </option>
                <option value="ทาวน์เฮ้าส์ (ADD)">ทาวน์เฮ้าส์ (ADD)</option>
                <option value="ที่ดิน (ADD)">ที่ดิน (ADD)</option>
                <option value="พาณิชย์ (ADD)">พาณิชย์ (ADD)</option>
            </select>
            <p class="price-range mt-3">สถานีรถไฟฟ้า</p>
            <select class="form-select" aria-label="Default select example">
                <option selected value="บ้านเดี่ยว">บ้านเดี่ยว</option>
                <option value="คอนโด">คอนโด </option>
                <option value="ทาวน์เฮ้าส์ (ADD)">ทาวน์เฮ้าส์ (ADD)</option>
                <option value="ที่ดิน (ADD)">ที่ดิน (ADD)</option>
                <option value="พาณิชย์ (ADD)">พาณิชย์ (ADD)</option>
            </select>
            <p class="price-range mt-3">ลักษณะพิเศษ</p>
            <div class="row-box" style="margin-top: 12px">
                <div class="col-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            ผ่อนตรง </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            เช่าออม
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            เช่าระยะสั้นได้ (น้อยกว่า 6 เดือน)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            ขายขาดทุน
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            ใกล้มหาวิทยาลัยดัง
                        </label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            ห้องเปล่า
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            ทรัพย์มือหนึ่ง
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            ตกแต่งสวยเว่อร์
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            คนต่างชาติ
                        </label>
                    </div>
                </div>
            </div>
            <p class="price-range mt-3">ข้อความจากลูกค้า</p>
            <textarea class="form-control mt-3" id="exampleFormControlTextarea1" rows="3"
                placeholder="ลูกค้าต่างชาติตามหาคอนโด อยู่ 1 สิงหา - 31 ธันวาคม"></textarea>
            <button type="button" class="btn btn-primary col-12 mt-5 mb-5"> </span>ลงประกาศ</button>
        </div>

    </div>

    <script>
        function toggleSelectionBox(element) {
            // Remove 'selected' class from all filter-boxes
            document.querySelectorAll('.filter-box-input2').forEach(box => box.classList.remove('selected'));

            // Add 'selected' class to the clicked element's parent
            element.closest('.filter-box-input2').classList.add('selected');
        }
    </script>
@endsection
