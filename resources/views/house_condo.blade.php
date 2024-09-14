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
                <div class="mb-3 col-12 col-sm-2">
                    <select class="form-select" aria-label="Default select example">
                        <option selected disabled>ประเภททรัพย์</option>
                        <option value="บ้านเดี่ยว">บ้านเดี่ยว</option>
                        <option value="คอนโด">คอนโด </option>
                        <option value="ทาวน์เฮ้าส์">ทาวน์เฮ้าส์</option>
                        <option value="ที่ดิน">ที่ดิน</option>
                        <option value="พาณิชย์">พาณิชย์</option>
                    </select>
                </div>
                <div class="mb-3  col-12 col-sm-3">
                    <input type="text" class="form-control" data-bs-toggle="modal" name="stations" id="stations"
                        data-bs-target="#exampleModalWelocome" placeholder="ค้นหาด้วยทำเล รถไฟฟ้า" readonly>

                </div>

                <div class="mb-3  col-12 col-sm-2">
                    <input type="text" class="form-control" data-bs-toggle="modal" name="welocome_filter"
                        id="welocome_filter" data-bs-target="#exampleModalWelocomeFilter" placeholder="กรอง" readonly>

                </div>
                <div class="mb-3  col-12 col-sm-2">
                    <input type="text" class="form-control" data-bs-toggle="modal" name="sort_by" id="sort-by"
                        data-bs-target="#exampleModalWelocomeSortBy" placeholder="เรียงตาม" readonly>

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

    <div class="modal fade" id="exampleModalWelocomeFilter" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('search-data') }}">
                    @csrf

                    <div class="modal-body">
                        <p>กรอง</p>
                        <select class="form-select mb-3" aria-label="Default select example" name="usable_area">
                            <option selected disabled>พื้นที่ใช้สอย</option>
                            <option value="29">น้อยกว่า 30 ตร.ม.</option>
                            <option value="30-50">30-50 ตร.ม.</option>
                            <option value="50-100">50-100 ตร.ม.</option>
                            <option value="100-1000">100-1,000 ตร.ม.</option>
                            <option value="1000-5000">1,000-5,000 ตร.ม.</option>
                            <option value="5001">มากกว่า 5,000 ตร.ม.</option>
                        </select>
                        <select class="form-select mb-3" aria-label="Default select example" name="price_range">
                            <option selected disabled>ช่วงราคา</option>
                            <option value="9999">น้อยกว่า 10,000 บาท</option>
                            <option value="10000-15000">10,000-15,0000 บาท</option>
                            <option value="15000-20000">15,000-20,000 บาท</option>
                            <option value="20000-30000">20,000-30,000 บาท</option>
                            <option value="30000-50000">30,000-50,000 บาท</option>
                            <option value="50000-100000">50,000-100,000 บาท</option>
                            <option value="100000-500000">100,000-500,000 บาท</option>
                            <option value="500000-1000000">500,000-1,000,000 บาท</option>
                            <option value="1000000-2000000">1-2 ล้าน</option>
                            <option value="2000000-3000000">2-3 ล้าน</option>
                            <option value="3000000-5000000">3-5 ล้าน</option>
                            <option value="5000000-10000000">5-10 ล้าน</option>
                            <option value="10000001">มากกว่า 10 ล้าน</option>
                        </select>
                        <select class="form-select" aria-label="Default select example" name="date_posted">
                            <option selected disabled>วันที่โพส</option>
                            <option value="1">วันนี้</option>
                            <option value="2">สัปดาห์นี้</option>
                            <option value="3">เดือนนี้</option>
                            <option value="4">1-6 เดือน</option>
                            <option value="5">6 เดือนขึ้นไป</option>
                        </select>
                        <p style="margin-top: 12px">ลักษณะพิเศษ</p>
                        @include('assetsCustomer.optionsJs')
                        <button type="button" class="btn btn-outline-secondary col-12 mt-4 mb-3" data-bs-dismiss="modal"
                            aria-label="Close"> บันทึกการตั้งค่า</button>

                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModalWelocomeSortBy" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row-box mb-4">
                        <div class="form-check-search">
                            <input class="form-check-input" type="radio" name="too_little" value="price_min_max"
                                id="filter1" style="display: none">
                            <label class="form-check-label4" for="filter1">
                                ราคาจากน้อยไปมาก
                            </label>
                        </div>

                        <div class="form-check-search">
                            <input class="form-check-input" type="radio" name="too_little" value="price_max_min"
                                id="filter2" style="display: none">
                            <label class="form-check-label4" for="filter2">
                                ราคาจากมากไปน้อย
                            </label>
                        </div>

                    </div>

                    <p style="margin-top: 12px">พื้นที่ใช้สอย</p>
                    <div class="row-box mb-4">
                        <div class="form-check-search">
                            <input class="form-check-input" type="radio" name="too_little" value="area_max_min"
                                id="filter3" style="display: none">
                            <label class="form-check-label4" for="filter3">
                                จากมาก ไป น้อย
                            </label>
                        </div>

                        <div class="form-check-search">
                            <input class="form-check-input" type="radio" name="too_little" value="area_min_max"
                                id="filter4" style="display: none">
                            <label class="form-check-label4" for="filter4">
                                จากน้อย ไป มาก
                            </label>
                        </div>
                    </div>
                    <p style="margin-top: 12px">จํานวนชั้น / ชั้น</p>
                    <div class="row-box mb-4">
                        <div class="form-check-search">
                            <input class="form-check-input" type="radio" name="too_little" value="floors_max_min"
                                id="filter5" style="display: none">
                            <label class="form-check-label4" for="filter5">
                                จากมาก ไป น้อย
                            </label>
                        </div>

                        <div class="form-check-search">
                            <input class="form-check-input" type="radio" name="too_little" value="floors_min_max"
                                id="filter6" style="display: none">
                            <label class="form-check-label4" for="filter6">
                                จากน้อย ไป มาก
                            </label>
                        </div>
                    </div>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"
                        class="btn btn-primary col-12 mt-4 mb-3"> <span> <img class="icon-search-box"
                                src="{{ URL::asset('/assets/image/welcome/search-box.png') }}"></span>คันหา</button>

                </div>
            </div>
        </div>
    @endsection
