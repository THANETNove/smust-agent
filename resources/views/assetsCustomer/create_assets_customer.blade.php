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
        <form method="POST" action="{{ route('co-agent-store') }}">
            @csrf

            <div class="box-free-customer">
                <p class="co-agent">สร้างโพสประกาศหา co-agent ที่มีทรัพย์</p>
                <p class="contract-type">ประเภทสัญญา <span style="color: red">*</span></p>
                <div class="row-box">
                    <div class="filter-box-input2 form-check selected" data-type="sell">
                        <input class="form-check-input" type="radio" name="sale_rent" value="sale" id="filterStation"
                            onclick="toggleSelectionBox(this)" checked>
                        <label class="form-check-label" for="filterStation">
                            ขาย
                        </label>
                    </div>
                    <div class="filter-box-input2 form-check" data-type="area">
                        <input class="form-check-input" type="radio" name="sale_rent" value="rent" id="filterArea"
                            onclick="toggleSelectionBox(this)">
                        <label class="form-check-label" for="filterArea">

                            เช่า
                        </label>
                    </div>
                </div>
                <div class="row mb-3 mt-4">
                    <div class="col-md-12 ">
                        <label>ประเภททรัพย์ <span style="color: red;margin-left: 6px;"> *</span> </label>
                        <select class="form-select select-color" name="property_type" aria-label="Default select example">
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
                </div>
                <p class="price-range">ช่วงราคา</p>
                <div class="row-box mt-3">
                    <div> <input type="number" class="form-control" name="price_start" id="exampleFormControlInput1"
                            placeholder="ราคา (บาท)">
                    </div>
                    <span style="margin-top: 8px">ถึง</span>
                    <div> <input type="number" class="form-control" name="price_end" id="exampleFormControlInput1"
                            placeholder="ราคา* (บาท)">
                    </div>
                </div>
                <p class="price-range mt-3 mb-3">ทำเล</p>
                @include('layouts.address')
                <p class="price-range mt-3">สถานีรถไฟฟ้า</p>
                @php
                    // Group the train data by line_code
                    $groupedTrain = $train->groupBy('line_code');

                    // Define background colors and text colors for each line_code

                @endphp

                <div id="station-select" style="display: none;">
                    <select class="form-select mt-3" name="station" id="station">
                        <option selected disabled>Select Station</option>
                        @foreach ($train as $station)
                            @php
                                // ตรวจสอบสีเพื่อตรวจว่าเป็น BTS, MRT หรือ ARL
                                $prefix = '';
                                if (in_array($station->line_code, ['Light green', 'Dark green'])) {
                                    $prefix = 'BTS';
                                } elseif (in_array($station->line_code, ['Blue', 'Purple'])) {
                                    $prefix = 'MRT';
                                } elseif (in_array($station->line_code, ['ARL'])) {
                                    $prefix = 'ARL';
                                }
                            @endphp
                            <option value="{{ $station->id }}">
                                {{ $prefix }} {{ $station->station_name_th }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <p class="price-range mt-3">ลักษณะพิเศษ</p>
                <div class="row-box" style="margin-top: 12px">
                    <div class="col-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="options[]" value="ผ่อนตรง"
                                id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">ผ่อนตรง</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="options[]" value="เช่าออม"
                                id="flexCheckChecked1">
                            <label class="form-check-label" for="flexCheckChecked1">เช่าออม</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="options[]"
                                value="เช่าระยะสั้นได้ (น้อยกว่า 6 เดือน)" id="flexCheckChecked2">
                            <label class="form-check-label" for="flexCheckChecked2">เช่าระยะสั้นได้ (น้อยกว่า 6
                                เดือน)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="options[]" value="ขายขาดทุน"
                                id="flexCheckChecked3">
                            <label class="form-check-label" for="flexCheckChecked3">ขายขาดทุน</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="options[]" value="ใกล้มหาวิทยาลัยดัง"
                                id="flexCheckChecked4">
                            <label class="form-check-label" for="flexCheckChecked4">ใกล้มหาวิทยาลัยดัง</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="options[]" value="ห้องเปล่า"
                                id="flexCheckDefault2">
                            <label class="form-check-label" for="flexCheckDefault2">ห้องเปล่า</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="options[]" value="ทรัพย์มือหนึ่ง"
                                id="flexCheckChecked5">
                            <label class="form-check-label" for="flexCheckChecked5">ทรัพย์มือหนึ่ง</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="options[]" value="ตกแต่งสวยเว่อร์"
                                id="flexCheckChecked6">
                            <label class="form-check-label" for="flexCheckChecked6">ตกแต่งสวยเว่อร์</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="options[]" value="คนต่างชาติ"
                                id="flexCheckChecked7">
                            <label class="form-check-label" for="flexCheckChecked7">คนต่างชาติ</label>
                        </div>
                    </div>
                </div>

                <p class="price-range mt-3">ข้อความจากลูกค้า</p>
                <textarea class="form-control mt-3" id="exampleFormControlTextarea1" rows="5" name="message_customer"
                    placeholder="ลูกค้าต่างชาติตามหาคอนโด อยู่ 1 สิงหา - 31 ธันวาคม"></textarea>
                <button type="submit" class="btn btn-primary col-12 mt-5 mb-5"> </span>ลงประกาศ</button>
            </div>
        </form>
    </div>


    <script>
        function toggleSelectionBox(element) {
            // Remove 'selected' class from all filter-boxes
            document.querySelectorAll('.filter-box-input2').forEach(box => box.classList.remove('selected'));

            // Add 'selected' class to the clicked element's parent
            element.closest('.filter-box-input2').classList.add('selected');
        }
        document.addEventListener('DOMContentLoaded', function() {
            const provinceSelect = document.getElementById('provinces-id');

        });

        function goBack() {
            window.history.back();
        }
    </script>
@endsection
