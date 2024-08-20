@php

    $train = DB::table('train_station')->get();
@endphp
@php
    // Group the train data by line_code
    $groupedTrain = $train->groupBy('line_code');

    // Define background colors and text colors for each line_code
    $lineStyles = [
        'ARL' => ['bgColor' => '#C41230', 'textColor' => '#FFFFFF'],
        'Blue' => ['bgColor' => '#0000FF', 'textColor' => '#FFFFFF'],
        'Brown' => ['bgColor' => '#874514', 'textColor' => '#FFFFFF'],
        'Dark green' => ['bgColor' => '#06402B', 'textColor' => '#FFFFFF'],
        'Light green' => ['bgColor' => '#90EE90', 'textColor' => '#006400'],
        'Gold' => ['bgColor' => '#FFD700', 'textColor' => '#000000'],
        'Grey' => ['bgColor' => '#D3D3D3', 'textColor' => '#696969'],
        'Pink' => ['bgColor' => '#FFC0CB', 'textColor' => '#FF69B4'],
        'Orange' => ['bgColor' => '#FFA500', 'textColor' => '#8B4513'],
        'Purple' => ['bgColor' => '#800080', 'textColor' => '#FFFFFF'], // Purple with White Text
        'Red east' => ['bgColor' => '#FF4500', 'textColor' => '#FFFFFF'],
        'Red north' => ['bgColor' => '#DC143C', 'textColor' => '#FFFFFF'],
        'Red south' => ['bgColor' => '#B22222', 'textColor' => '#FFFFFF'],
        'Red west' => ['bgColor' => '#FF6347', 'textColor' => '#FFFFFF'],
        'Red west south' => ['bgColor' => '#CD5C5C', 'textColor' => '#FFFFFF'],
        'Yellow' => ['bgColor' => '#FFFF00', 'textColor' => '#000000'],
        // Add more line_code => background color and text color pairs as needed
    ];
@endphp
@foreach ($groupedTrain as $lineCode => $stations)
    <div>

        <select class="form-select mt-3" name="stations[{{ $lineCode }}]" id="station_{{ $lineCode }}"
            style="background-color: {{ $lineStyles[$lineCode]['bgColor'] ?? '#FFFFFF' }}; color: {{ $lineStyles[$lineCode]['textColor'] ?? '#000000' }};">
            @foreach ($stations as $station)
                @php
                    // ตรวจสอบสีเพื่อตรวจว่าเป็น BTS หรือ MRT
                    $prefix = '';
                    if (in_array($lineCode, ['Light green', 'Dark green'])) {
                        $prefix = 'BTS';
                    } elseif (in_array($lineCode, ['Blue', 'Purple'])) {
                        $prefix = 'MRT';
                    } elseif (in_array($lineCode, ['ARL'])) {
                        $prefix = 'ARL';
                    }
                @endphp
                <option value="{{ $station->station_code }}"
                    style="color: {{ $lineStyles[$lineCode]['textColor'] ?? '#000000' }};">
                    {{ $prefix }} {{ $station->station_name_th }}
                </option>
            @endforeach
        </select>
    </div>
@endforeach
