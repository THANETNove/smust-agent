@php

    $data = DB::table('provinces')->orderBy('name_th', 'ASC')->get();
@endphp
<select class="select-address select-address form-select font-size-12-black @error('provinces') is-invalid @enderror"
    name="provinces" id="provinces-id" aria-label="Default select example">
    <option selected disabled>จังหวัด</option>
    @foreach ($data as $provinces)
        <option value="{{ $provinces->id }}">{{ $provinces->name_th }}</option>
    @endforeach
</select>
@error('provinces')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
<select class="select-address form-select mt-2 font-size-12-black @error('districts') is-invalid @enderror"
    name="districts" id="districts" aria-label="Default select example">
    <option selected disabled>เขต/อำเภอ</option>
</select>
@error('districts')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
<select class="select-address form-select mt-2 font-size-12-black @error('amphures') is-invalid @enderror"
    name="amphures" id="amphures" aria-label="Default select example">
    <option selected disabled>แขวง/ตำบล</option>
</select>
@error('amphures')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror

@include('admin.address')
