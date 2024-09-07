<script>
    document.addEventListener("DOMContentLoaded", function() {
        let lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));
        if ("IntersectionObserver" in window) {
            let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        let lazyImage = entry.target;
                        lazyImage.src = lazyImage.dataset.src;
                        lazyImage.classList.remove("lazy");
                        lazyImageObserver.unobserve(lazyImage);
                    }
                });
            });
            lazyImages.forEach(function(lazyImage) {
                lazyImageObserver.observe(lazyImage);
            });
        } else {
            // Fallback for older browsers
            let lazyLoad = function() {
                lazyImages.forEach(function(img) {
                    if (img.getBoundingClientRect().top <= window.innerHeight && img
                        .getBoundingClientRect().bottom >= 0 && getComputedStyle(img).display !==
                        "none") {
                        img.src = img.dataset.src;
                        img.classList.remove("lazy");
                    }
                });
                if (lazyImages.length == 0) {
                    document.removeEventListener("scroll", lazyLoad);
                    window.removeEventListener("resize", lazyLoad);
                    window.removeEventListener("orientationchange", lazyLoad);
                }
            };
            document.addEventListener("scroll", lazyLoad);
            window.addEventListener("resize", lazyLoad);
            window.addEventListener("orientationchange", lazyLoad);
        }
    });



    let selectedType = null;

    function toggleSelection(element) {
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

    function toggleSelectionBox(element) {
        // Remove 'selected' class from all filter-boxes
        document.querySelectorAll('.filter-box-input').forEach(box => box.classList.remove('selected'));

        // Add 'selected' class to the clicked element's parent
        element.closest('.filter-box-input').classList.add('selected');
    }

    document.addEventListener('DOMContentLoaded', function() {
        // อ่านค่าแท็บที่ถูกเลือกจาก localStorage
        const activeTab = localStorage.getItem('activeTabHome');



        // ถ้ามีค่าแท็บที่ถูกเลือกใน localStorage


        if (activeTab) {
            // เอาคลาส active ออกจากแท็บทั้งหมด
            document.querySelectorAll('.box-link-manu-home').forEach(tab => {
                tab.classList.remove('active');
                tab.setAttribute('aria-selected', 'false');
            });

            // เพิ่มคลาส active ให้กับแท็บที่ถูกเลือกใน localStorage
            const selectedTab = document.getElementById(activeTab);
            selectedTab.classList.add('active');
            selectedTab.setAttribute('aria-selected', 'true');

            // แสดง pane ที่ตรงกับแท็บที่ถูกเลือก
            const selectedPane = document.querySelector(selectedTab.getAttribute('data-bs-target'));
            document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('show', 'active'));
            selectedPane.classList.add('show', 'active');
        }

        // เพิ่ม Event Listener ให้กับแท็บทั้งหมด
        document.querySelectorAll('.box-link-manu-home').forEach(tab => {

            tab.addEventListener('click', function() {
                // เก็บ ID ของแท็บที่ถูกเลือกลงใน localStorage
                localStorage.setItem('activeTabHome', this.id);
            });
        });


    });
    document.addEventListener('DOMContentLoaded', function() {
        const activeTab = localStorage.getItem('activeTabHome');
        if (activeTab == "home-tab") {
            document.getElementById('data-count-1').style.display = 'none';
            document.getElementById('data-count-2').style.display = 'block';
        } else {
            document.getElementById('data-count-1').style.display = 'block';
            document.getElementById('data-count-2').style.display = 'none';
        }


        document.querySelector('.box-nav-link-home').addEventListener('click', function() {
            const url = new URL(window.location.href);
            url.searchParams.delete('page'); // ลบพารามิเตอร์ page ออกจาก URL
            history.replaceState(null, '', url.toString()); // ปรับปรุง URL โดยไม่โหลดหน้าใหม่

            const activeTab = localStorage.getItem('activeTabHome');

            if (activeTab == "home-tab") {
                document.getElementById('data-count-1').style.display = 'none';
                document.getElementById('data-count-2').style.display = 'block';
            } else {
                document.getElementById('data-count-1').style.display = 'block';
                document.getElementById('data-count-2').style.display = 'none';
            }

        })



    });
</script>
