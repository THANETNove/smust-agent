<script>
    document.getElementById('profileButton').addEventListener('click', function() {
        document.getElementById('profileInput').click();
    });

    document.getElementById('profileInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('userProfileImg').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
