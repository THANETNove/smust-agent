<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" id="exampleModalScrollBtn"
    data-bs-target="#exampleModalScroll" style="display: none">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalScroll" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-scroll">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                <button type="button" class="btn-close btn-close-2" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="date-count" class="date-count-text"></p>
                <div class="scroll-box-81">
                    <img class="group-81-scroll" src="{{ URL::asset('/assets/image/home/group-81.png') }}">
                    <img class="group-81-scroll" src="{{ URL::asset('/assets/image/home/group-82.png') }}">
                </div>

            </div>

        </div>
    </div>
</div>


<script>
    let dataCount = @json($dataCount2);
    let dataCount2 = @json($dataCount);

    var text = `อัพเกรดเพื่อดูทรัพย์ทั้งหมด กว่า ${dataCount} รายการ`; // แก้ไข `dataCoun2` เป็น `dataCount2`
    var text2 = `อัพเกรดเพื่อดูทรัพย์ทั้งหมด กว่า ${dataCount2} รายการ`;
    let modalShown = false; // ใช้ตัวแปรเพื่อตรวจสอบว่า Modal ถูกแสดงแล้วหรือยัง

    // Event listener for scrolling
    window.addEventListener('scroll', function() {
        const scrollPosition = window.scrollY + window.innerHeight;
        const pageHeight = document.documentElement.scrollHeight;

        // Check if the user has scrolled to 90% of the page height and modal has not been shown
        if (scrollPosition >= pageHeight * 0.9 && !modalShown) {
            console.log("show modal");
            document.getElementById("exampleModalScrollBtn").click(); // Auto-click the button to trigger modal
            modalShown = true; // Set modalShown to true to prevent showing again
        }

        // Reset modalShown to false if user scrolls up
        if (scrollPosition < pageHeight * 0.9) {
            modalShown = false; // Reset modalShown to allow modal to show again
        }
    });

    // Function to check and set the active tab content
    function checkAndSetTabContent(tabId) {
        if (tabId === "home-tab") {
            document.getElementById("date-count").textContent = text;
        } else if (tabId === "profile-tab") {
            document.getElementById("date-count").textContent = text2;
        }
    }

    // Initial check on page load
    window.addEventListener("DOMContentLoaded", function() {
        // Check the active tab on load
        const activeTab = document.querySelector('.box-link-manu-home.active')?.id;
        if (activeTab) {
            checkAndSetTabContent(activeTab);
        }
    });

    // Add event listeners for tab clicks if the elements exist
    const homeTab = document.getElementById("home-tab");
    const profileTab = document.getElementById("profile-tab");

    if (homeTab) homeTab.addEventListener("click", () => checkAndSetTabContent("home-tab"));
    if (profileTab) profileTab.addEventListener("click", () => checkAndSetTabContent("profile-tab"));
</script>
