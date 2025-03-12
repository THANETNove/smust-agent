<script>
    $(document).ready(function() {

        $("#provinces-id").change(function() {
            var selectedProvinceId = $(this).val();

            console.log("selectedProvinceId", selectedProvinceId);



            if (document.getElementById('stations-name')) {
                document.getElementById('stations-name').value = null;
            }
            const stationSelect = document.getElementById('station-select');

            if (stationSelect) { // Check if stationSelect exists
                if (selectedProvinceId == '1' || selectedProvinceId == '2' || selectedProvinceId ==
                    '3' || selectedProvinceId == '4') {
                    stationSelect.style.display = 'block';
                } else {
                    stationSelect.style.display = 'none';
                    const station = document.getElementById('station');
                    if (station) { // Check if station exists

                        station.value = 'null';
                    }
                }
            }
            // นทบุรี ปทุมธานี สมุทรปราการ


            // ตรวจสอบว่าเลือก "จังหวัด" ให้ค่าไม่ใช่ค่าเริ่มต้น
            if (selectedProvinceId !== "0") {
                // ใช้ Ajax เรียกเส้นทางใน Laravel เพื่อดึงข้อมูลแขวง/อำเภอ

                $.ajax({
                    url: "/get-districts/" + selectedProvinceId,
                    type: "GET",

                    success: function(res) {
                        // อัปเดตตัวเลือก "เขต/อำเภอ"
                        var districtsSelect = $("#districts");
                        districtsSelect.find("option").remove();
                        districtsSelect.append(
                            $("<option selected disabled>เขต/อำเภอ</option>")
                        );

                        $.each(res, function(index, district) {


                            districtsSelect.append(
                                $("<option>", {
                                    value: district.id,
                                    text: district.name_th,
                                })
                            );
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    },
                });
            }
        });

        // เมื่อเลือก "แขวง/ อำเภอ"
        $("#districts").change(function() {
            var selectedDistrictId = $(this).val();

            // ตรวจสอบว่าเลือก " เขต/อำเภอ" ให้ค่าไม่ใช่ค่าเริ่มต้น
            if (selectedDistrictId !== "0") {
                $.ajax({
                    url: "/get-amphures/" + selectedDistrictId,
                    type: "GET",
                    success: function(res) {
                        console.log("res", res);
                        // Clear existing options and add a default placeholder
                        var amphuresSelect = $("#amphures");
                        amphuresSelect.find("option").remove();
                        amphuresSelect.append(
                            $("<option selected disabled>แขวง/ตำบล</option>")
                        );

                        // Append each option
                        $.each(res, function(index, data) {
                            amphuresSelect.append(
                                $("<option>", {
                                    value: data.id,
                                    text: data.name_th

                                })
                            );
                        });

                        // Set zip code when an option is selected
                        amphuresSelect.on("change", function() {
                            var selectedZip = $(this).find("option:selected").data(
                                "zip");
                            document.getElementById("zip_code").value =
                                selectedZip || "";
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    },
                });
            }
        });

    });
</script>
