<div class="modal fade" id="exampleModalWelocome" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <p>เลือกทำเลจาก</p>

                <div class="row-box">
                    <div class="filter-box selected" data-type="area" onclick="toggleSelection2(this)">
                        <img class="icon-location" src="{{ URL::asset('/assets/image/welcome/location_on.png') }}">
                        <p>ย่าน</p>
                    </div>
                    <div class="filter-box" data-type="station" onclick="toggleSelection2(this)">
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
            <form method="POST" action="{{ route('search-data') }}">
                @csrf


                <div class="modal-body">
                    <p>กรอง</p>
                    <select class="form-select mb-3" aria-label="Default select example" name="usable_area"
                        id="usable_area">
                        <option selected disabled>พื้นที่ใช้สอย</option>
                        <option value="29">น้อยกว่า 30 ตร.ม.</option>
                        <option value="30-50">30-50 ตร.ม.</option>
                        <option value="50-100">50-100 ตร.ม.</option>
                        <option value="100-1000">100-1,000 ตร.ม.</option>
                        <option value="1000-5000">1,000-5,000 ตร.ม.</option>
                        <option value="5001">มากกว่า 5,000 ตร.ม.</option>
                    </select>

                    <select class="form-select mb-3" aria-label="Default select example" name="price_range"
                        id="price_range">
                        <option selected disabled>ช่วงราคา</option>
                        <option value="9999">น้อยกว่า 10,000 บาท</option>
                        <option value="10000-15000">10,000-15,000 บาท</option>
                        <option value="15000-20000">15,000-20,000 บาท</option>
                        <option value="20000-30000">20,000-30,000 บาท</option>
                        <option value="30000-50000">30,000-50,000 บาท</option>
                        <option value="50000-100000">50,000-100,000 บาท</option>
                        <option value="100000-500000">100,000-500,000 บาท</option>
                        <option value="500000-1000000">500,000-1,000,000 บาท</option>
                        <option value="1000000-2000000">1-2 ล้าน</option>
                        <option value="2000000-3000000">2-3 ล้าน</option>
                        <option value="3000000-5000000">3-5 ล้าน</option>
                        <option value="5000000-10000000">5-10 ล้าน</option>
                        <option value="10000001">มากกว่า 10 ล้าน</option>
                    </select>

                    <select class="form-select" aria-label="Default select example" name="date_posted" id="date_posted">
                        <option selected disabled>วันที่โพส</option>
                        <option value="1">วันนี้</option>
                        <option value="2">สัปดาห์นี้</option>
                        <option value="3">เดือนนี้</option>
                        <option value="4">1-6 เดือน</option>
                        <option value="5">6 เดือนขึ้นไป</option>
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
