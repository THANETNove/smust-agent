@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-10">
            <div>
                <a href="javascript:void(0);" onclick="goBack()">
                    <img class="free-go-back" src="{{ URL::asset('/assets/image/welcome/go-back.png') }}">
                </a>
                <p class="free-trial">
                    สร้างประกาศ
                </p>

            </div>
            <form method="POST" action="{{ route('assets-customer-store') }}">
                @csrf

                <div class="box-free-customer">

                    <p class="co-agent">
                        @if (Auth::check())
                            สร้างโพสประกาศหา co-agent ที่มีทรัพย์
                        @else
                            บอกลักษณะทรัพย์ที่คุณต้องการ แล้วเราจะติดต่อกลับไป
                        @endif
                    </p>

                    <p class="contract-type">ประเภทสัญญา <span style="color: red">*</span></p>
                    <div class="row-box">
                        <div class="filter-box-input2 form-check selected" data-type="sell"
                            onclick="toggleSelectionBox(this)">
                            <input {{-- class="form-check-input" --}} type="radio" name="sale_rent" value="sale" id="filterStation">
                            <label class="form-check-label" for="filterStation">
                                ขาย
                            </label>
                        </div>
                        <div class="filter-box-input2 form-check" data-type="area" onclick="toggleSelectionBox(this)">
                            <input {{-- class="form-check-input" --}} type="radio" name="sale_rent" value="rent" id="filterArea">
                            <label class="form-check-label" for="filterArea">

                                เช่า
                            </label>
                        </div>
                    </div>
                    <div class="row mb-3 mt-4">
                        <div class="col-md-12 ">
                            <label>ประเภททรัพย์ <span style="color: red;margin-left: 6px;"> *</span> </label>
                            <select class="form-select select-color" name="property_type"
                                aria-label="Default select example">
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

                    @php
                        // Group the train data by line_code
                        $groupedTrain = $train->groupBy('line_code');

                        // Define background colors and text colors for each line_code

                    @endphp

                    <div {{-- id="station-select" style="display: none;" --}}>
                        {{--  @include('assetsCustomer.trainStation') --}}
                        {{--  <select class="form-select mt-3" name="station" id="station">
              
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
                        </select> --}}
                        @php
                            // Group the train data by line_code
                            $groupedTrain = $train->groupBy('line_code');

                            // Define background colors and text colors for each line_code
                            $lineStyles = [
                                'ARL' => ['bgColor' => '#C41230', 'textColor' => '#696969'],
                                'Blue' => ['bgColor' => '#0000FF', 'textColor' => '#696969'],
                                'Brown' => ['bgColor' => '#874514', 'textColor' => '#696969'],
                                'Dark green' => ['bgColor' => '#06402B', 'textColor' => '#696969'],
                                'Light green' => ['bgColor' => '#90EE90', 'textColor' => '#696969'],
                                'Gold' => ['bgColor' => '#FFD700', 'textColor' => '#696969'],
                                'Grey' => ['bgColor' => '#D3D3D3', 'textColor' => '#696969'],
                                'Pink' => ['bgColor' => '#FFC0CB', 'textColor' => '#696969'],
                                'Orange' => ['bgColor' => '#FFA500', 'textColor' => '#696969'],
                                'Purple' => ['bgColor' => '#800080', 'textColor' => '#696969'],
                                'Red east' => ['bgColor' => '#FF4500', 'textColor' => '#696969'],
                                'Red north' => ['bgColor' => '#DC143C', 'textColor' => '#696969'],
                                'Red south' => ['bgColor' => '#B22222', 'textColor' => '#696969'],
                                'Red west' => ['bgColor' => '#FF6347', 'textColor' => '#696969'],
                                'Red west south' => ['bgColor' => '#CD5C5C', 'textColor' => '#696969'],
                                'Yellow' => ['bgColor' => '#FFFF00', 'textColor' => '#696969'],
                            ];
                        @endphp
                        <!-- ปุ่ม input ที่จะเปิด modal -->
                        <div id="station-select" style="display: none;">
                            <p class="price-range mt-3">สถานีรถไฟฟ้า</p>
                            <div class="input-group">
                                <input type="text" id="train_station_input" class="form-control col-12"
                                    data-bs-toggle="modal" data-bs-target="#stationModal" placeholder="เลือกสถานีรถไฟฟ้า"
                                    readonly>
                            </div>

                            <input type="text" id="train_station_input_id" name="station" class="form-control col-12"
                                style="display: none">
                        </div>




                        <!-- Bootstrap modal -->
                        <div class="modal fade" id="stationModal" tabindex="-1" aria-labelledby="stationModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="stationModalLabel">เลือกสถานี</h5>
                                        <button type="button" class="btn-close" id="btn-close-train"
                                            data-bs-dismiss="modal" aria-label="Close"></button>

                                    </div>
                                    <p style="margin-left: 16px" id="station_name_select"></p>

                                    <div class="modal-body">

                                        @php
                                            $groupedTrain = $train->groupBy('line_code');

                                            // Define background colors and text colors for each line_code
                                            $lineStyles = [
                                                'ARL' => ['bgColor' => '#C41230', 'textColor' => '#696969'],
                                                'Blue' => ['bgColor' => '#0000FF', 'textColor' => '#696969'],
                                                'Brown' => ['bgColor' => '#874514', 'textColor' => '#696969'],
                                                'Dark green' => ['bgColor' => '#06402B', 'textColor' => '#696969'],
                                                'Light green' => ['bgColor' => '#90EE90', 'textColor' => '#696969'],
                                                'Gold' => ['bgColor' => '#FFD700', 'textColor' => '#696969'],
                                                'Grey' => ['bgColor' => '#D3D3D3', 'textColor' => '#696969'],
                                                'Pink' => ['bgColor' => '#FFC0CB', 'textColor' => '#696969'],
                                                'Orange' => ['bgColor' => '#FFA500', 'textColor' => '#696969'],
                                                'Purple' => ['bgColor' => '#800080', 'textColor' => '#696969'],
                                                'Red east' => ['bgColor' => '#FF4500', 'textColor' => '#696969'],
                                                'Red north' => ['bgColor' => '#DC143C', 'textColor' => '#696969'],
                                                'Red south' => ['bgColor' => '#B22222', 'textColor' => '#696969'],
                                                'Red west' => ['bgColor' => '#FF6347', 'textColor' => '#696969'],
                                                'Red west south' => ['bgColor' => '#CD5C5C', 'textColor' => '#696969'],
                                                'Yellow' => ['bgColor' => '#FFFF00', 'textColor' => '#696969'],
                                            ];
                                        @endphp
                                        @foreach ($groupedTrain as $lineCode => $stations)
                                            <div class="row-station">

                                                <div class="input-group-icon" for="">
                                                    <i class="fa-solid fa-train-subway"
                                                        style="color: {{ $lineStyles[$lineCode]['bgColor'] ?? '#FFFFFF' }};"></i>
                                                </div>
                                                <select class="form-select  station-select"
                                                    aria-label="Small select example">

                                                    <!-- แสดงชื่อสายใน option ที่ถูกเลือก -->
                                                    <option selected disabled>
                                                        {{ $stations[0]->line_name }}</option>
                                                    <!-- เพิ่ม option นี้ -->
                                                    @foreach ($stations as $station)
                                                        @php
                                                            $prefix = '';
                                                            if (in_array($lineCode, ['Light green', 'Dark green'])) {
                                                                $prefix = 'BTS';
                                                            } elseif (in_array($lineCode, ['Blue', 'Purple'])) {
                                                                $prefix = 'MRT';
                                                            } elseif (in_array($lineCode, ['ARL'])) {
                                                                $prefix = 'ARL';
                                                            }
                                                        @endphp
                                                        <option value="{{ $station->id }}/{{ $station->station_name_th }}">
                                                            {{ $prefix }} {{ $station->station_name_th }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>


                        </div>


                        <p class="price-range mt-3">ลักษณะพิเศษ</p>
                        @include('assetsCustomer.optionsJs')
                        <p class="price-range mt-3">ข้อความจากลูกค้า</p>
                        <textarea class="form-control mt-3" id="exampleFormControlTextarea1" rows="5" name="message_customer"
                            placeholder="ลูกค้าต่างชาติตามหาคอนโด อยู่ 1 สิงหา - 31 ธันวาคม"></textarea>

                        @if (!Auth::check())
                            <p class="card_number-setup">ช่องทางติดต่อ</p>
                            <p class="contact-setup">สำหรับการเสนอทรัพย์ (Facebook จะใส่หรือไม่ก็ได้)</p>
                            <div class="row mb-3 mt-4">
                                <div class="col-md-12 input_box">
                                    <input type="text" name="webName"
                                        class="form-control @error('webName') is-invalid @enderror" autocomplete="ชื่อ *"
                                        required>
                                    <label>ชื่อ * </label>
                                    @error('webName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3 mt-4">
                                <div class="col-md-12 input_box">
                                    <input type="text" name="webPhone"
                                        class="form-control @error('webPhone') is-invalid @enderror"
                                        autocomplete="เบอร์ติดต่อ *" required>
                                    <label>เบอร์ติดต่อ * </label>
                                    @error('webPhone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3 mt-4">
                                <div class="col-md-12 input_box">
                                    <input type="text" name="webLine"
                                        class="form-control @error('webLine') is-invalid @enderror"
                                        autocomplete="Line ID">
                                    <label>Line ID </label>
                                    @error('webLine')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 input_box">
                                    <input type="text" name="webFacebook"
                                        class="form-control @error('webFacebook') is-invalid @enderror"
                                        autocomplete="Facebook">

                                    <label>Facebook </label>
                                    @error('webFacebook')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endif
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

            document.querySelectorAll('.station-select').forEach(select => {
                select.addEventListener('change', function() {
                    // ดึงค่าที่เลือกจาก dropdown ปัจจุบัน
                    const selectedValue = this.value;

                    // แสดงค่า selectedValue ใน console เพื่อการตรวจสอบ
                    console.log("Selected Value:", selectedValue);

                    // แยกค่า station_id และ station_name_th ด้วยการ split
                    const [stationId, stationName] = selectedValue.split('/');

                    // ตรวจสอบว่ามีค่าที่เลือกใหม่
                    if (stationId && stationName) { // ตรวจสอบว่าไม่ใช่ค่าว่าง
                        // ลบค่าที่อยู่ใน input field (ลบค่าเก่าทิ้ง)
                        document.getElementById('train_station_input').value = '';
                        document.getElementById('station_name_select').innerText = '';

                        // รีเซ็ต dropdown อื่น ๆ ให้เป็นค่าเริ่มต้น ยกเว้นอันที่ถูกเลือก
                        document.querySelectorAll('.station-select').forEach(otherSelect => {
                            if (otherSelect !== select) { // ตรวจสอบว่าไม่ใช่ dropdown ที่เพิ่งเลือก
                                otherSelect.selectedIndex = 0; // คืนค่า dropdown อื่นเป็นค่าเริ่มต้น
                            }
                        });


                        const button = document.getElementById('btn-close-train');

                        // Trigger a click event on the button
                        button.click();
                        // ใส่ค่า stationId และ stationName ที่แยกแล้วลงใน input field
                        document.getElementById('train_station_input').value = stationName;
                        document.getElementById('train_station_input_id').value = stationId;
                        document.getElementById('station_name_select').innerText = "เลือกสถานี " + stationName;


                    }
                });
            });
        </script>
    </div>
@endsection
