@php
    $train_station = Cache::remember('trainStationData', 0, function () {
        return DB::table('train_station')
            ->where('status', 1)
            ->select('train_station.id', 'train_station.station_name_th')
            ->orderBy('station_name_th', 'ASC')
            ->get();
    });

@endphp

<select class="form-select mt-2 font-size-12-black " name="train_name" aria-label="Default select example">
    <option selected disabled> ชื่อสถานี</option>
    <option value="ไม่มี">ไม่มี</option>
    @foreach ($train_station as $train)
        <option value="{{ $train->station_name_th }}">{{ $train->station_name_th }}</option>
    @endforeach

</select>
