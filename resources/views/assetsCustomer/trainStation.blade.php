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





<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                <button type="button" class="btn-close" id="btn-close-train" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @foreach ($groupedTrain as $lineCode => $stations)
                    <div class="input-group">
                        <label class="input-group-icon" for="">
                            <i class="fa-solid fa-train-subway"
                                style="color: {{ $lineStyles[$lineCode]['bgColor'] ?? '#FFFFFF' }};"></i>
                        </label>
                        <select class="form-select mt-3 station-select"{{--  name="stations" --}}
                            id="station_{{ $lineCode }}"
                            style="color: {{ $lineStyles[$lineCode]['textColor'] ?? '#000000' }};">
                            {{-- <option selected disabled>สถานีรถไฟฟ้าที่ใกล้ที่สุด</option> --}}

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
        </div>
    </div>
</div>


<script>
    // Add an event listener for each select element
    document.querySelectorAll('.station-select').forEach(selectElement => {
        selectElement.addEventListener('change', function() {
            // Get the selected value
            let selectedValue = this.value;
            document.getElementById('stations').value = selectedValue;

            // Reset all other select elements to default (empty)
            document.querySelectorAll('.station-select').forEach(otherSelect => {
                if (otherSelect !== this) {
                    otherSelect.selectedIndex = 0; // Set to the first option (Select Station)
                }
            });
            const button = document.getElementById('btn-close-train');

            // Trigger a click event on the button
            button.click();
        });

    });
</script>
