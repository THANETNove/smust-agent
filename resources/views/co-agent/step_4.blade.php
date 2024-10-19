<div class="box-add-image-center" onclick="document.getElementById('file').click()">
    <div id="image-preview-container" style="position: relative; width: 350px; height: 150px; overflow: hidden;">
        <img id="default-image" class="image-rectangle-co-90"
            src="{{ URL::asset('/assets/image/welcome/rectangle90.png') }}">
    </div>
    <div class="box-add-photo-text">
        <img class="image-add_photo_alternate" src="{{ URL::asset('/assets/image/welcome/add_photo_alternate.png') }}">
        <p class="text-add-image">เพิ่มรูปภาพ</p>
    </div>
</div>

<input id="file" type="file" class="form-control @error('image') is-invalid @enderror" name="image[]" multiple
    placeholder="image[]" accept="image/*" style="display: none" onchange="previewImages(event)">
@error('image')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror


<p class="recommend-video">แนะนำให้เพิ่มวีดีโอ เพื่อให้ลูกค้าตัดสินใจได้เร็วขึ้น</p>

<div class="row mt-3 mb-3">
    <div class="col-md-12 mb-3 input_box">
        <input id="url_video" type="url" class="form-control @error('url_video') is-invalid @enderror"
            name="url_video" value="{{ old('url_video') }}" autocomplete="meters_store">
        <label>ลิงก์ Video (ลิงก์ Video youtube)*</label>
        @error('url_video')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row  mb-3">
    <div class="col-md-12 mb-3 input_box">
        <input id="announcement_name" type="text"
            class="form-control @error('announcement_name') is-invalid @enderror" name="announcement_name"
            value="{{ old('announcement_name') }}" autocomplete="announcement_name">
        <label>ชื่อประกาศ* (คำจูงใจสั้นๆ บอกว่านี่ทรัพย์อะไร)</label>
        @error('announcement_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-12 mb-3 input_box">
        <input id="url_gps" type="url" class="form-control @error('url_gps') is-invalid @enderror" name="url_gps"
            value="{{ old('url_gps') }}" autocomplete="url_gps">
        <label>พิกัดที่ตั้ง (ลิงก์ Google Maps)*</label>
        @error('url_gps')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-12 mb-3">
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="10"
            placeholder="รายละเอียด เขียนอิสระ เช่น สถานที่สำคัญ ใกล้เคียง หรือรายละเอียดอื่น ๆ ที่ไม่ได้กรอกไว้"
            name="details">{{ old('details') }}</textarea>

        @error('meters_store')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-12 mb-3">
        <input id="files" type="file" class="form-control @error('files') is-invalid @enderror" name="files"
            value="{{ old('files') }}" autocomplete="files" accept=".jpg,.jpeg,.png"
            onchange="validateFileSize(this)">
        @error('meters_store')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<span id="file-error" style="color: red; display: none;">ไฟล์ที่คุณเลือกมีขนาดใหญ่เกินไป กรุณาเลือกไฟล์ที่มีขนาดไม่เกิน
    2MB</span>

<p class="text-not-forced">(ไม่ได้บังคับ)
    <br>
    ประเภทไฟล์: pdf, jpg, png, docx
    <br>
    ขนาดไฟล์: ไม่เกิน 2MB
</p>



{{-- <div class="box-btn-block-center">
    <button type="button" class="btn btn-have-broker-back" onclick="previousStep()">
        กลับ
    </button>
    <button type="button" class="btn btn-have-broker" id="next-btn" onclick="nextStep()">
        ถัดไป
    </button>
</div>
 --}}
<div class="box-btn-block-center">
    <button type="button" class="btn btn-have-broker-back" onclick="previousStep()">
        กลับ
    </button>
    <button type="button" class="btn btn-have-broker" id="next-btn" onclick="nextStep()">
        ถัดไป
    </button>
</div>
<script>
    function previewImages(event) {
        const container = document.getElementById('image-preview-container');
        container.innerHTML = ''; // ล้างภาพเก่าออกก่อน

        const files = event.target.files;
        const maxWidth = 350;
        const maxHeight = 150;
        const imageWidth = Math.min(maxWidth / files.length, 350); // ความกว้างภาพแต่ละภาพ
        const imageHeight = maxHeight; // ความสูงภาพแต่ละภาพ
        const offset = 10; // ระยะห่างระหว่างภาพ

        if (files) {
            Array.from(files).forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.classList.add('image-rectangle-co-90');
                    img.src = e.target.result;
                    img.style.position = 'absolute';
                    img.style.left = `${index * offset}px`; // เลื่อนแต่ละภาพไปทางขวานิดหน่อย
                    img.style.top = `0`; // วางทุกภาพในแนวเดียวกัน
                    img.style.width = `${imageWidth}px`;
                    img.style.height = `${imageHeight}px`;
                    img.style.objectFit = 'cover'; // ให้ภาพพอดีกับขนาดที่กำหนด
                    img.style.zIndex = index; // ทำให้ภาพซ้อนกันในลำดับ
                    container.appendChild(img);
                }

                reader.readAsDataURL(file);
            });
        }


    }

    function validateFileSize(input) {
        const file = input.files[0];
        const maxSizeInMB = 2; // ขนาดไฟล์สูงสุดที่อนุญาตใน MB
        const maxSizeInBytes = maxSizeInMB * 1024 * 1024; // แปลงเป็น Bytes
        const errorSpan = document.getElementById('file-error');
        const nextButton = document.getElementById('next-btn');

        if (file.size > maxSizeInBytes) {
            errorSpan.style.display = 'block'; // แสดงข้อความแจ้งเตือน
            nextButton.disabled = true; // ปิดการทำงานของปุ่ม 'ถัดไป'
            // เริ่มต้นให้ปิดการทำงานของปุ่ม 'ถัดไป' จนกว่าจะมีการเลือกไฟล์
            document.getElementById('next-btn').disabled = true;
        } else {
            errorSpan.style.display = 'none'; // ซ่อนข้อความแจ้งเตือน
            nextButton.disabled = false; // เปิดการทำงานของปุ่ม 'ถัดไป'
        }
    }
</script>
