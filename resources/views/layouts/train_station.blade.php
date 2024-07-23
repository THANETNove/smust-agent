<select class="form-select mt-2 font-size-12-black " name="train_name" aria-label="Default select example">
    <option selected disabled> ชื่อสถานี</option>
    <option value="ไม่มี">ไม่มี</option>
    @foreach ($train_station as $train)
        <option value="{{ $train->station_name_th }}">{{ $train->station_name_th }}</option>
    @endforeach

</select>
