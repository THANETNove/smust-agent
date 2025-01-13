<div class="modal fade" id="exampleModalWelocome" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <p>เลือกทำเลจาก</p>

                <div class="row-box">
                    <div class="filter-box selected" data-type="area" onclick="toggleSelection2(this)" id="area2">
                        <img class="icon-location" src="{{ URL::asset('/assets/image/welcome/location_on.png') }}">
                        <p>ย่าน</p>
                    </div>
                    <div class="filter-box" data-type="station" onclick="toggleSelection2(this)" id="station2">
                        <img class="icon-location" src="{{ URL::asset('/assets/image/welcome/train.png') }}">
                        <p>สถานีรถไฟฟ้า</p>
                    </div>
                </div>

                <div class="mt-4">
                    <input type="text" id="area-station" name="area_station" value="area" style="display: none">
                    <div class="id-address">
                        @include('layouts.address')
                    </div>

                    <div class="id-trainStation" style="display: none">
                        @include('assetsCustomer.trainStation3')
                    </div>

                </div>
                <button type="button" class="btn btn-primary  col-12 mt-4 mb-3" data-bs-dismiss="modal"
                    aria-label="Close"> <span> <img class="icon-search-box"
                            src="{{ URL::asset('/assets/image/welcome/search-box.png') }}"></span>คันหา</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModalWelocomeFilter" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            @php

                $usableArea = $request['usable_area'] ?? null;
                $priceRange = $request['price_range'] ?? null;
                $datePosted = $request['date_posted'] ?? null;
            @endphp
            <form method="POST" action="{{ route('search-data') }}">
                @csrf


                <div class="modal-body">
                    <p>กรอง</p>
                    <select class="form-select mb-3" aria-label="Default select example" name="usable_area"
                        id="usable_area">
                        <option disabled {{ is_null($usableArea) ? 'selected' : '' }}>พื้นที่ใช้สอย</option>
                        <option value="29" {{ $usableArea == '29' ? 'selected' : '' }}>น้อยกว่า 30 ตร.ม.</option>
                        <option value="30-50" {{ $usableArea == '30-50' ? 'selected' : '' }}>30-50 ตร.ม.</option>
                        <option value="50-100" {{ $usableArea == '50-100' ? 'selected' : '' }}>50-100 ตร.ม.</option>
                        <option value="100-1000" {{ $usableArea == '100-1000' ? 'selected' : '' }}>100-1,000 ตร.ม.
                        </option>
                        <option value="1000-5000" {{ $usableArea == '1000-5000' ? 'selected' : '' }}>1,000-5,000
                            ตร.ม.</option>
                        <option value="5001" {{ $usableArea == '5001' ? 'selected' : '' }}>มากกว่า 5,000 ตร.ม.
                        </option>
                    </select>

                    <select class="form-select mb-3" aria-label="Default select example" name="price_range"
                        id="price_range">
                        <option disabled {{ is_null($priceRange) ? 'selected' : '' }}>ช่วงราคา</option>
                        <option value="9999" {{ $priceRange == '9999' ? 'selected' : '' }}>น้อยกว่า 10,000 บาท
                        </option>
                        <option value="10000-15000" {{ $priceRange == '10000-15000' ? 'selected' : '' }}>
                            10,000-15,000 บาท</option>
                        <option value="15000-20000" {{ $priceRange == '15000-20000' ? 'selected' : '' }}>
                            15,000-20,000 บาท</option>
                        <option value="20000-30000" {{ $priceRange == '20000-30000' ? 'selected' : '' }}>
                            20,000-30,000 บาท</option>
                        <option value="30000-50000" {{ $priceRange == '30000-50000' ? 'selected' : '' }}>
                            30,000-50,000 บาท</option>
                        <option value="50000-100000" {{ $priceRange == '50000-100000' ? 'selected' : '' }}>
                            50,000-100,000 บาท</option>
                        <option value="100000-500000" {{ $priceRange == '100000-500000' ? 'selected' : '' }}>
                            100,000-500,000 บาท</option>
                        <option value="500000-1000000" {{ $priceRange == '500000-1000000' ? 'selected' : '' }}>
                            500,000-1,000,000 บาท</option>
                        <option value="1000000-2000000" {{ $priceRange == '1000000-2000000' ? 'selected' : '' }}>1-2
                            ล้าน</option>
                        <option value="2000000-3000000" {{ $priceRange == '2000000-3000000' ? 'selected' : '' }}>2-3
                            ล้าน</option>
                        <option value="3000000-5000000" {{ $priceRange == '3000000-5000000' ? 'selected' : '' }}>3-5
                            ล้าน</option>
                        <option value="5000000-10000000" {{ $priceRange == '5000000-10000000' ? 'selected' : '' }}>
                            5-10 ล้าน</option>
                        <option value="10000001" {{ $priceRange == '10000001' ? 'selected' : '' }}>มากกว่า 10 ล้าน
                        </option>
                    </select>

                    <select class="form-select" aria-label="Default select example" name="date_posted" id="date_posted">
                        <option disabled {{ is_null($datePosted) ? 'selected' : '' }}>วันที่โพส</option>
                        <option value="1" {{ $datePosted == '1' ? 'selected' : '' }}>วันนี้</option>
                        <option value="2" {{ $datePosted == '2' ? 'selected' : '' }}>สัปดาห์นี้</option>
                        <option value="3" {{ $datePosted == '3' ? 'selected' : '' }}>เดือนนี้</option>
                        <option value="4" {{ $datePosted == '4' ? 'selected' : '' }}>1-6 เดือน</option>
                        <option value="5" {{ $datePosted == '5' ? 'selected' : '' }}>6 เดือนขึ้นไป</option>
                    </select>

                    {{--  <p style="margin-top: 12px">ลักษณะพิเศษ</p>
                    @include('assetsCustomer.optionsJs') welocome_filter  sort-by --}}
                    <button type="button" class="btn btn-outline-secondary col-12 mt-4 mb-3" data-bs-dismiss="modal"
                        aria-label="Close"> บันทึกการตั้งค่า</button>

                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModalWelocomeSortBy" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">


            <div class="modal-body">
                <div class="row-box mb-4">
                    <div class="form-check-search">
                        <input class="form-check-input" type="radio" name="too_little" value="price_min_max"
                            id="filter1" style="display: none">
                        <label class="form-check-label4" for="filter1">ราคาจากน้อยไปมาก</label>
                    </div>

                    <div class="form-check-search">
                        <input class="form-check-input" type="radio" name="too_little" value="price_max_min"
                            id="filter2" style="display: none">
                        <label class="form-check-label4" for="filter2">ราคาจากมากไปน้อย</label>
                    </div>
                </div>

                <p style="margin-top: 12px">พื้นที่ใช้สอย</p>
                <div class="row-box mb-4">
                    <div class="form-check-search">
                        <input class="form-check-input" type="radio" name="too_little" value="area_max_min"
                            id="filter3" style="display: none">
                        <label class="form-check-label4" for="filter3">จากมาก ไป น้อย</label>
                    </div>

                    <div class="form-check-search">
                        <input class="form-check-input" type="radio" name="too_little" value="area_min_max"
                            id="filter4" style="display: none">
                        <label class="form-check-label4" for="filter4">จากน้อย ไป มาก</label>
                    </div>
                </div>

                <p style="margin-top: 12px">จํานวนชั้น / ชั้น</p>
                <div class="row-box mb-4">
                    <div class="form-check-search">
                        <input class="form-check-input" type="radio" name="too_little" value="floors_max_min"
                            id="filter5" style="display: none">
                        <label class="form-check-label4" for="filter5">จากมาก ไป น้อย</label>
                    </div>

                    <div class="form-check-search">
                        <input class="form-check-input" type="radio" name="too_little" value="floors_min_max"
                            id="filter6" style="display: none">
                        <label class="form-check-label4" for="filter6">จากน้อย ไป มาก</label>
                    </div>
                </div>


                <button type="button" class="btn btn-primary col-12 mt-4 mb-3" data-bs-dismiss="modal"
                    aria-label="Close"> <span> <img class="icon-search-box"
                            src="{{ URL::asset('/assets/image/welcome/search-box.png') }}"></span>คันหา</button>

            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ดึง select elements ทั้งหมด
        const usableAreaSelect = document.getElementById('usable_area');
        const priceRangeSelect = document.getElementById('price_range');
        const datePostedSelect = document.getElementById('date_posted');
        const selectedFiltersInput = document.getElementById('welocome_filter');

        // ฟังก์ชันสำหรับอัปเดตค่าใน input
        function updateSelectedFilters() {
            // ดึงค่า text ที่เลือกจากแต่ละ select
            const usableAreaText = usableAreaSelect.options[usableAreaSelect.selectedIndex]?.text || '';
            const priceRangeText = priceRangeSelect.options[priceRangeSelect.selectedIndex]?.text || '';
            const datePostedText = datePostedSelect.options[datePostedSelect.selectedIndex]?.text || '';

            // รวมค่าทั้งหมดที่เลือกและเอามาแสดงใน input
            selectedFiltersInput.value =
                `พื้นที่: ${usableAreaText}, ราคา: ${priceRangeText}, วันที่โพส: ${datePostedText}`;
        }

        // เพิ่ม event listener ให้แต่ละ select เมื่อมีการเปลี่ยนแปลง
        usableAreaSelect.addEventListener('change', updateSelectedFilters);
        priceRangeSelect.addEventListener('change', updateSelectedFilters);
        datePostedSelect.addEventListener('change', updateSelectedFilters);
    });

    document.addEventListener('DOMContentLoaded', function() {
        // ดึง radio buttons ที่มี name 'too_little'
        const radioButtons = document.querySelectorAll('input[name="too_little"]');
        const selectedRadioInput = document.getElementById('sort-by');

        // ฟังก์ชันสำหรับอัปเดตค่าใน input
        function updateSelectedRadio() {
            const selectedRadio = document.querySelector('input[name="too_little"]:checked');
            if (selectedRadio) {
                const label = document.querySelector(`label[for="${selectedRadio.id}"]`).innerText;
                selectedRadioInput.value = `ตัวกรอง: ${label}`;
            }
        }

        // เพิ่ม event listener ให้ radio buttons เมื่อมีการเปลี่ยนแปลง
        radioButtons.forEach(function(radioButton) {
            radioButton.addEventListener('change', updateSelectedRadio);
        });
    });
</script>
