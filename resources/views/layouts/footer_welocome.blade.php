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



<script>
    let selectedType = null;

    function toggleSelection2(element) {
        const type = element.getAttribute('data-type');
        console.log("555555");
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

        document.getElementById('stations').value = name_provinces + name_districts + name_amphures;
    }

    // Event listener สำหรับ provinces
    document.getElementById('provinces-id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        name_provinces = selectedOption.text;
        name_districts = "";
        name_amphures = "";
        if (document.getElementById('stations-name')) {
            document.getElementById('stations-name').value = null;
        }
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


    function changeImage(event, direction) {
        const item = event.target.closest('.item');
        if (!item) return;

        const imgElements = item.querySelectorAll('.sliderImage');
        const imgCount = imgElements.length;

        let currentIndex = Array.from(imgElements).findIndex(img => img.style.display === 'block');
        if (currentIndex === -1) currentIndex = 0;

        currentIndex += direction;

        // ตรวจสอบขอบเขต
        if (currentIndex < 0) {
            currentIndex = imgCount - 1;
        } else if (currentIndex >= imgCount) {
            currentIndex = 0;
        }

        // ซ่อนทุกรูปภาพ
        imgElements.forEach(img => {
            img.style.display = 'none';
        });

        // แสดงรูปภาพที่เลือก
        imgElements[currentIndex].style.display = 'block';

        // อัปเดตปุ่ม
        const prevBtn2 = item.querySelector('.prev-btn2');
        const nextBtn2 = item.querySelector('.next-btn2');
        console.log(nextBtn2); // ตรวจสอบว่า nextBtn2 ถูกเลือก

        console.log("currentIndex", currentIndex, imgCount);
        // อัปเดตปุ่ม "ก่อนหน้า"
        if (currentIndex == 0) {
            prevBtn2.classList.add('disabled');
        } else {
            prevBtn2.classList.remove('disabled');
        }

        if (currentIndex === imgCount - 1) {
            console.log("8888", imgCount);
            nextBtn2.classList.add('disabled');
        } else {
            nextBtn2.classList.remove('disabled');
        }
    }




    // เริ่มต้นแสดงภาพแรก
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.item').forEach(item => {
            const images = item.querySelectorAll('.sliderImage');
            if (images.length > 0) {
                images[0].style.display = 'block'; // แสดงรูปภาพแรก
            }
            // อัปเดตปุ่มเมื่อโหลดเสร็จ
            updateButtons(item, 0, images.length);
        });
    });
</script>
