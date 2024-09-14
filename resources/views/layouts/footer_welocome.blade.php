<div class="footer-section">
    <div class="row custom-row">
        <div class="col-sm-12 col-md-6  col-lg-5 mb-4">
            <img src="{{ URL::asset('/assets/image/home/frame-407.png') }}" class="frame-407" alt="user">
            <p class="contact-us-we">ติดต่อเรา</p>
            <a href="mailto:smust.home@gmail.com">
                <img src="{{ URL::asset('/assets/image/home/frame-268.png') }}" class="frame-268" alt="rame-268">
            </a>
            <br>
            <a href="tel:099-361-5451">
                <img src="{{ URL::asset('/assets/image/home/frame-269.png') }}" class="frame-269-we" alt="frame-268">
            </a>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-2 mb-4 ">
            <p class="serve-us-we">บริการ</p>
            <p class="text-property-owner-we">เจ้าของทรัพย์</p>
            <p class="text-property-owner-we">นายหน้า</p>
            <p class="text-property-owner-we">ลูกค้าหาทรัพย์</p>
        </div>
        <div class="col-sm-12 col-md-6  col-lg-3 mb-4">
            <p class="serve-us-we">ข้อตกลงและความเป็นส่วนตัว</p>
            <p class="text-property-owner-we">นโยบายความเป็นส่วนตัว</p>
            <p class="text-property-owner-we">ข้อตกลงและเงื่อนไข</p>
            <p class="text-property-owner-we">เงื่อนไขการซื้อขาย</p>
            <p class="serve-us-we" style="margin-top: 48px">ช่วยเหลือ</p>
            <p class="text-property-owner-we">คำถามที่พบบ่อย</p>
        </div>
        <div class="col-sm-12 col-md-6  col-lg-2">
            <p class="serve-us-we">ติดตามข่าวสารใหม่ๆจากเรา</p>
            <img src="{{ URL::asset('/assets/image/home/ic_baseline-facebook.png') }}" class="ic_baseline-facebook"
                alt="frame-268">
            <img src="{{ URL::asset('/assets/image/home/youtube_activity.png') }}" class="ic_baseline-facebook"
                alt="frame-268">
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModalWelocome" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    <img class="icon-filterData" src="{{ URL::asset('/assets/image/welcome/filterData.png') }}">

                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

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
                        @include('assetsCustomer.trainStation2')
                    </div>

                </div>
                <button type="button" class="btn btn-primary  col-12 mt-4 mb-3" data-bs-dismiss="modal"
                    aria-label="Close"> <span> <img class="icon-search-box"
                            src="{{ URL::asset('/assets/image/welcome/search-box.png') }}"></span>คันหา</button>
            </div>
        </div>
    </div>
</div>
<script>
    let selectedType = null;

    function toggleSelection2(element) {
        const type = element.getAttribute('data-type');

        // If the same element is clicked, deselect it
        if (selectedType === type) {
            element.classList.remove('selected');
            selectedType = null;
        } else {
            // Deselect the previously selected element, if any
            const previouslySelected = document.querySelector('.filter-box.selected');
            if (previouslySelected) {
                previouslySelected.classList.remove('selected');
            }

            // Select the clicked element
            element.classList.add('selected');
            selectedType = type;
        }

        // Log the selected type or perform an action based on it

        if (selectedType == 'area') {
            document.querySelector('.id-address').style.display = 'block';
            document.querySelector('.id-trainStation').style.display = 'none';
            document.getElementById('area-station').value = "area";

        } else {
            document.querySelector('.id-address').style.display = 'none';
            document.querySelector('.id-trainStation').style.display = 'block';
            document.getElementById('area-station').value = "station";

        }

    }



    let name_provinces = "";
    let name_districts = "";
    let name_amphures = "";

    // ฟังก์ชันที่ใช้ในการอัปเดตค่า stations
    function updateStations() {
        console.log("updateStations called with value:", );
        document.getElementById('stations').value = name_provinces + name_districts + name_amphures;
    }

    // Event listener สำหรับ provinces
    document.getElementById('provinces-id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        name_provinces = selectedOption.text;
        name_districts = "";
        name_amphures = "";

        updateStations();
    });

    // Event listener สำหรับ districts
    document.getElementById('districts').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        name_districts = "," + selectedOption.text;
        name_amphures = "";

        updateStations();
    });

    // Event listener สำหรับ amphures
    document.getElementById('amphures').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        name_amphures = "," + selectedOption.text;
        updateStations();
    });
</script>
