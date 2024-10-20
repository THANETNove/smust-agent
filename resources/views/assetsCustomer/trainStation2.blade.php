@php

    $train = DB::table('train_station')->where('status', 1)->get();
@endphp
@php
    // Group the train data by line_code
    $groupedTrain = $train->groupBy('line_code');

    // Define background colors and text colors for each line_code
    $lineStyles = [
        'ARL' => ['bgColor' => '#C41230', 'textColor' => '#696969'],
        'Blue' => ['bgColor' => '#0000FF', 'textColor' => '#696969'],
        'Brown' => ['bgColor' => '#874514', 'textColor' => '#696969'],
        'Dark green' => ['bgColor' => '#06402B', 'textColor' => '#696969'],
        'Light green' => ['bgColor' => '#90EE90', 'textColor' => '#696969'],
        'Gold' => ['bgColor' => '#FFD700', 'textColor' => '#696969'],
        'Grey' => ['bgColor' => '#D3D3D3', 'textColor' => '#696969'],
        'Pink' => ['bgColor' => '#FFC0CB', 'textColor' => '#696969'],
        'Orange' => ['bgColor' => '#FFA500', 'textColor' => '#696969'],
        'Purple' => ['bgColor' => '#800080', 'textColor' => '#696969'],
        'Red east' => ['bgColor' => '#FF4500', 'textColor' => '#696969'],
        'Red north' => ['bgColor' => '#DC143C', 'textColor' => '#696969'],
        'Red south' => ['bgColor' => '#B22222', 'textColor' => '#696969'],
        'Red west' => ['bgColor' => '#FF6347', 'textColor' => '#696969'],
        'Red west south' => ['bgColor' => '#CD5C5C', 'textColor' => '#696969'],
        'Yellow' => ['bgColor' => '#FFFF00', 'textColor' => '#696969'],
    ];
@endphp

<p style="margin-top: 12px">สถานีรถไฟ</p>
<input type="text" id="stations" class="form-control col-12 mb-3" name="stations" onclick="showTrainStations()"
    placeholder="เลือกสถานีรถไฟฟ้า" readonly>
<div id="groupedTrain" style="display: none">
    @foreach ($groupedTrain as $lineCode => $stations)
        <div class="input-group mb-2">
            <label class="input-group-icon" for="">
                <i class="fa-solid fa-train-subway"
                    style="color: {{ $lineStyles[$lineCode]['bgColor'] ?? '#FFFFFF' }};"></i>
            </label>
            <select class="form-select station-select"{{--  name="stations" --}} id="station_{{ $lineCode }}"
                style="color: {{ $lineStyles[$lineCode]['textColor'] ?? '#000000' }};">
                <option selected disabled> {{ $stations[0]->line_name }}</option>

                @foreach ($stations as $station)
                    @php
                        $prefix = '';
                        if (in_array($lineCode, ['Light green', 'Dark green'])) {
                            $prefix = 'BTS';
                        } elseif (in_array($lineCode, ['Blue', 'Purple'])) {
                            $prefix = 'MRT';
                        } elseif (in_array($lineCode, ['ARL'])) {
                            $prefix = 'ARL';
                        }
                    @endphp
                    <option value="{{ $station->station_name_th }}"
                        style="color: {{ $lineStyles[$lineCode]['textColor'] ?? '#000000' }};">
                        {{ $prefix }} {{ $station->station_name_th }}
                    </option>
                @endforeach
            </select>
        </div>
    @endforeach
</div>

<script>
    function showTrainStations() {
        // แสดง div ที่ซ่อนอยู่
        const groupedTrainDiv = document.getElementById('groupedTrain');
        if (groupedTrainDiv.style.display === 'none' || groupedTrainDiv.style.display === '') {
            groupedTrainDiv.style.display = 'block'; // เปลี่ยน display เป็น block เพื่อแสดง
        } else {
            groupedTrainDiv.style.display = 'none'; // ซ่อนถ้ามีการคลิกซ้ำ
        }
    }

    // Add an event listener for each select element
    document.querySelectorAll('.station-select').forEach(selectElement => {
        selectElement.addEventListener('change', function() {
            // Get the selected value
            let selectedValue = this.value;
            document.getElementById('stations').value = selectedValue;
            // document.getElementById('station_name_select').innerText = "เลือกสถานี " + selectedValue;


            // Reset all other select elements to default (empty)
            document.querySelectorAll('.station-select').forEach(otherSelect => {
                if (otherSelect !== this) {
                    otherSelect.selectedIndex = 0; // Set to the first option (Select Station)
                    const groupedTrainDiv = document.getElementById('groupedTrain');
                    groupedTrainDiv.style.display = 'none';
                }
            });
        });

    });
</script>
