// ตรวจสอบความพร้อมก่อนใช้งาน jQuery
$(document).ready(function () {
    /**
     *  ! save ภาพ หน้าจอ
     */
    const captureButton = document.getElementById("captureButton");
    const captureContainer = document.getElementById("container");
    const captureSave = document.getElementById("captureButton");
    const captureSaveLink = document.getElementById("link-url");
    const captureBack = document.getElementById("back-home");


    // ... other logs

    captureButton.addEventListener("click", () => {
        captureContainer.style.border = "3px solid var(--primary_200)";
        captureContainer.style.padding = "16px";
        captureContainer.style.maxWidth = "700px";
        captureSave.style.display = "none";
        captureSaveLink.style.display = "none";
        captureBack.style.visibility = "hidden";

        html2canvas(document.getElementById("container")).then((canvas) => {
            const dataURL = canvas.toDataURL("image/png");

            const downloadLink = document.createElement("a");
            downloadLink.href = dataURL;
            downloadLink.download = "webpage.png";
            downloadLink.click();
        });
        captureContainer.style.border = "none";
        captureContainer.style.padding = "0px";
        captureContainer.style.maxWidth = "100%";
        captureSave.style.display = "block";
        captureSaveLink.style.display = "block";
        captureBack.style.visibility = "visible";
    });

    // ตัวอย่างอื่น ๆ ของโค้ด JavaScript

    /**
     *  ! copyUrl
     */

    const copyUrlButton = document.getElementById("link-url");

    copyUrlButton.addEventListener("click", () => {
        // Get the URL from the address bar
        var urlToCopy = window.location.href;

        // Create a temporary input element
        var tempInput = document.createElement("input");

        // Set the input value to the URL
        tempInput.value = urlToCopy;

        // Append the input element to the body
        document.body.appendChild(tempInput);

        // Select the input value
        tempInput.select();

        // Copy the selected text
        document.execCommand("copy");

        // Remove the temporary input element
        document.body.removeChild(tempInput);

        // Optional: Provide feedback to the user
        alert("URL copied to clipboard: " + urlToCopy);
    });
});



document.getElementById('forgotPasswordBtn').addEventListener('click', function () {
    var img = document.getElementById('forgotLineImage');
    if (img.style.display === 'none') {
        img.style.display = 'block';
    } else {
        img.style.display = 'none';
    }
});

