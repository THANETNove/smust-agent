<script>
    $(document).ready(function() {

        $("#provinces-id").change(function() {
            var selectedProvinceId = $(this).val();


            console.log("selectedProvinceId", selectedProvinceId);

            const stationSelect = document.getElementById('station-select');

            if (selectedProvinceId == '1') {
                stationSelect.style.display = 'block';
            } else {
                const station = document.getElementById('station');
                stationSelect.style.display = 'none';
                station.value = 'null';
            }


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
                        // อัปเดตตัวเลือก "แขวง/ อำเภอ"
                        var amphuresSelect = $("#amphures");
                        amphuresSelect.find("option").remove();
                        amphuresSelect.append(
                            $("<option selected disabled>แขวง/ตำบล</option>")
                        );

                        $.each(res, function(index, data) {

                            amphuresSelect.append(
                                $("<option>", {
                                    value: data.id,
                                    text: data.name_th,
                                })
                            );
                            if (data.zip_code) {
                                document.getElementById("zip_code").value =
                                    data.zip_code;
                            }
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
