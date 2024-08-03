<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const submitBtn = document.getElementById('submitBtn');
        const requiredFields = form.querySelectorAll('input[required], select[required]');

        function checkFormValidity() {
            let allFilled = true;
            requiredFields.forEach(function(field) {
                if (!field.value) {
                    allFilled = false;
                }
            });

            if (allFilled) {
                submitBtn.disabled = false;
                submitBtn.style.backgroundColor = 'blue';
            } else {
                submitBtn.disabled = true;
                submitBtn.style.backgroundColor = 'gray';
            }
        }

        requiredFields.forEach(function(field) {
            field.addEventListener('input', checkFormValidity);
        });

        checkFormValidity(); // Initial check
    });
</script>
