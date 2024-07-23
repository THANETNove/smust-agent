<script>
    $(document).ready(function() {
        var counter = 0;

        $("#add-input").click(function() {
            // Display a confirmation dialog
            var userConfirmation = confirm("เพิ่มเติมช่องสิ่งอำนวยความสะดวก");

            // Check if the user clicked "OK"
            if (userConfirmation) {
                // Increment the counter for a unique name
                counter++;

                // Create a new input element with a unique name
                var newInput = $("<input type='text' class='form-control mt-2' name='thereVarious[" +
                    counter + "]' placeholder='เพิ่มเติม สิ่งอำนวยความสะดวก'>");

                // Append the new input to the container
                $("#input-container").append(newInput);
            }
            // If the user clicked "Cancel," do nothing
        });
    });
</script>
