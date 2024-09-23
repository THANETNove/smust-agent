<script>
    var currentMedia = 0;
    var currentImages = []; // ตัวแปรนี้จะเก็บภาพสำหรับรายการปัจจุบัน

    document.querySelectorAll('.popup-trigger').forEach(function(element) {
        element.addEventListener('click', function() {
            // ดึงข้อมูลภาพจาก data-attribute ของ wel-image-box
            var imageBox = element.closest('.wel-image-box');
            var images = JSON.parse(imageBox.getAttribute('data-images'));

            // เปิด popup และแสดงภาพ
            openPopup(parseInt(element.getAttribute('data-index')), images);
        });
    });

    function openPopup(index, images) {
        console.log("Opening popup with images: ", images);
        currentMedia = index;
        currentImages = images; // เก็บภาพใน currentImages
        showMedia(currentMedia, currentImages);

        var popup = document.getElementById('imagePopup');
        popup.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closePopup() {
        var popup = document.getElementById('imagePopup');
        popup.style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    function changeMedia(direction) {
        currentMedia += direction;

        // ตรวจสอบว่า currentMedia ไม่เกินขอบเขตของ images array
        if (currentMedia < 0) {
            currentMedia = 0;
        }
        if (currentMedia >= currentImages.length) {
            currentMedia = currentImages.length - 1;
        }

        showMedia(currentMedia, currentImages);
    }

    function showMedia(index, images) {
        var prevBtn = document.getElementById("prev-btn");
        var nextBtn = document.getElementById("next-btn");

        // ตรวจสอบการแสดงผลปุ่ม next และ prev
        if (index >= images.length - 1) {
            nextBtn.style.display = "none";
        } else {
            nextBtn.style.display = "block";
        }
        if (index <= 0) {
            prevBtn.style.display = "none";
        } else {
            prevBtn.style.display = "block";
        }

        // แสดงภาพที่เลือก
        var popupMediaContainer = document.getElementById('popupMediaContainer');
        popupMediaContainer.innerHTML = '';

        var assetUrl = "{{ asset('img/product') }}";
        var img = document.createElement('img');
        img.src = assetUrl + "/" + images[index];
        popupMediaContainer.appendChild(img);
    }


    document.getElementById('save-image-btn').addEventListener('click', function() {
        if (currentImages[currentMedia]) {
            var assetUrl = "{{ asset('img/product') }}";
            var imageUrl = assetUrl + "/" + currentImages[currentMedia];
            saveImage(imageUrl);
        } else {
            console.error('No image found to save.');
        }
    });






    function saveAll() {
        var assetUrl = "{{ asset('img/product') }}";

        currentImages.forEach(function(item) {
            var imageUrl = assetUrl + '/' + item;
            saveImage(imageUrl);
        });
    }

    function saveImage(imageUrl) {
        var downloadLink = document.createElement('a');
        downloadLink.href = imageUrl;
        downloadLink.download = 'image.jpg';
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    }


    function captureContainer(imageUrl) {
        var downloadLink = document.createElement('a');
        downloadLink.href = imageUrl;
        downloadLink.download = 'image.jpg';
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    }

    $(document).ready(function() {
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: true,
            autoplay: true,
            autoplayTimeout: 3000,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                },
                1200: {
                    items: 4
                }

            }
        });
    });
</script>
