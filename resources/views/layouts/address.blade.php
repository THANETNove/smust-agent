<select class="select-address select-address form-select font-size-12-black" name="provinces" id="provinces-id"
    aria-label="Default select example">
    <option selected disabled>จังหวัด</option>
    @foreach ($data as $provinces)
        <option value="{{ $provinces->id }}">{{ $provinces->name_th }}</option>
    @endforeach
</select>
<select class="select-address form-select mt-2 font-size-12-black" name="districts" id="districts"
    aria-label="Default select example">
    <option selected disabled>เขต/อำเภอ</option>
</select>
<select class="select-address form-select mt-2 font-size-12-black" name="amphures" id="amphures"
    aria-label="Default select example">
    <option selected disabled>แขวง/ตำบล</option>
</select>
