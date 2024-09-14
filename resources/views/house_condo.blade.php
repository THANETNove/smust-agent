@extends('layouts.app')

@section('content')
    @include('layouts.navbar_welcome')
    <div class="bg-navbar-home-condo">
        <div class="search-welcome-home-condo">
            <form method="POST" action="{{ route('house-condo') }}" enctype="multipart/form-data">
                @csrf
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
                    @include('layouts.model_welcome')
                    <div class="mb-3  col-12 col-sm-3">
                        <button type="submit" class="btn-find-out-now">ค้นหาเลย!</button>

                    </div>
                </div>
            </form>
        </div>
        <div class="box-or-agent-we">
            <div class="box-or">
                <p class="or-text">หรือ</p>
                <a href="{{ url('co-create') }}">
                    <div class="box-agent">ให้สามารถเอเจนท์ (SMUST Agent) ช่วยหาทรัพย์ตรงใจ</div>
                </a>

            </div>
        </div>
    </div>

    @include('layouts.footer_welocome')
@endsection
