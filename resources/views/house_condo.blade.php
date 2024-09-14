@extends('layouts.app')

@section('content')
    @include('layouts.navbar_welcome')
    <div class="bg-navbar-home-condo">
        <div class="search-welcome-home-condo">
            <div class="search-welcome-box mb-3">
                <div>
                    <input type="radio" id="rent" name="property-type" value="เช่า" checked>
                    <label for="rent" class="search-text-head">เช่า</label>
                </div>

                <div>
                    <input type="radio" id="buy" name="property-type" value="ซื้อ">
                    <label for="buy" class="search-text-head">ซื้อ</label>
                </div>

                <div>
                    <input type="radio" id="owner-financing" name="property-type" value="ownerFinancing">
                    <label for="owner-financing" class="search-text-head2 head-new">ผ่อนตรงเจ้าของ
                        <span style="color: #E34234">(NEW)</span>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-12 col-sm-4">
                    <select class="form-select" aria-label="Default select example">
                        <option selected disabled>ประเภททรัพย์</option>
                        <option value="บ้านเดี่ยว">บ้านเดี่ยว</option>
                        <option value="คอนโด">คอนโด </option>
                        <option value="ทาวน์เฮ้าส์">ทาวน์เฮ้าส์</option>
                        <option value="ที่ดิน">ที่ดิน</option>
                        <option value="พาณิชย์">พาณิชย์</option>
                    </select>
                </div>

                <div class="mb-3 col-12 col-sm-4">
                    <button class="box-filter_alt" type="button" data-bs-toggle="modal"
                        data-bs-target="#exampleModal-home-condo">
                        <img class="filter_alt-img" src="{{ URL::asset('/assets/image/home/filter_alt.png') }}">กรอง
                    </button>
                </div>

                <div class="mb-3  col-12 col-sm-5">
                    <input type="text" class="form-control" data-bs-toggle="modal" name="stations" id="stations"
                        data-bs-target="#exampleModal" placeholder="ค้นหาด้วยทำเล รถไฟฟ้า" readonly>
                    @include('assetsCustomer.trainStation')
                </div>
                <div class="mb-3  col-12 col-sm-3">
                    <button type="submit" class="btn-find-out-now">ค้นหาเลย!</button>

                </div>
            </div>
        </div>
        <div class="box-or-agent">
            <div class="box-or">
                <p class="or-text">หรือ</p>
                <a href="{{ url('co-create') }}">
                    <div class="box-agent">ให้สามารถเอเจนท์ (SMUST Agent) ช่วยหาทรัพย์ตรงใจ</div>
                </a>

            </div>
        </div>
    </div>

    @include('layouts.footer_welocome')
    <div class="modal fade" id="exampleModal-home-condo" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title fs-5">
                        <img class="filter_alt-img" src="{{ URL::asset('/assets/image/home/filter_alt.png') }}">กรอง
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="user" id="myForm" method="POST" action="{{ route('search-data') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <p class="font-size-12-black">ประเภททรัพย์</p>
                        <div class="flex-direction-row">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="property_type" value="คอนโด"
                                    id="property_type1">
                                <label class="form-check-label check-icon" for="property_type1">
                                    <img class="property-img" src="{{ URL::asset('/assets/image/home/apartment.png') }}">
                                    <p class="font-size-12-black text-lr">คอนโด</p>
                                </label>
                            </div>
                            &nbsp; &nbsp; &nbsp; &nbsp;
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="property_type" value="บ้าน"
                                    id="property_type2">
                                <label class="form-check-label check-icon" for="property_type2">
                                    <img class="property-img" src="{{ URL::asset('/assets/image/home/cottage.png') }}">
                                    <p class="font-size-12-black text-lr-2">บ้าน</p>
                                </label>
                            </div>
                        </div>

                        <p class="font-size-12-black mt-21">พื้นที่</p>
                        @include('layouts.address')

                        <p class="font-size-12-black mt-21">สถานีรถไฟฟ้า</p>
                        <img class="property-img" src="{{ URL::asset('/assets/image/home/directions_subway.png') }}">
                        @include('layouts.train_station')
                        <div class="box-button">
                            <button class="btn-search">ค้นหา</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
