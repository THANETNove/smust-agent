{{-- <div class="box-add-image-center" onclick="document.getElementById('file').click()">
    <div id="image-preview-container">
        <img id="default-image" class="image-rectangle-co-90"
            src="{{ URL::asset('/assets/image/welcome/rectangle90.png') }}">
    </div>
    <div class="box-add-photo-text">
        <img class="image-add_photo_alternate" src="{{ URL::asset('/assets/image/welcome/add_photo_alternate.png') }}">
        <p class="text-add-image">เพิ่มรูปภาพ</p>
    </div>
</div>

<input id="file" type="file" class="form-control @error('image[]') is-invalid @enderror" name="image[]" multiple
    required placeholder="image" accept="image/*" style="display:none;" onchange="previewImages(event)">

 --}}

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

<input id="file" type="file" class="form-control @error('image[]') is-invalid @enderror" name="image[]" multiple
    required placeholder="image" accept="image/*" style="display:none;" onchange="previewImages(event)">

<div class="box-btn-block-center">
    <button type="button" class="btn btn-have-broker-back" onclick="previousStep()">
        กลับ
    </button>
    <button type="button" class="btn btn-have-broker" onclick="nextStep()">
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
</script>
