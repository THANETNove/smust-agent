@extends('layouts.app')

@section('content')
    @include('layouts.navbar_welcome')
    <div class="box-premium-all">
        <div class="row">
            <div class="col-md-12 col-lg-4">
                <p class="looking-broker">ตามหานายหน้าตรงใจ</p>
                <p class="looking-broker-sub">ขายไม่ได้ซักทีใช่ไหม? ลองส่งให้นายหน้าที่เชี่ยวชาญในประเภท
                    สัญญา ประเภททรัพย์ จังหวัด หรือลักษณะพิเศษของทรัพย์คุณสิ</p>
            </div>
            <div class="col-md-12 col-lg-8">
                <div class="search-welcome" style="margin-top: 16px">
                    <form method="POST" action="{{ route('contact-premium') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="search-welcome-box mb-3">
                            <div>
                                <input type="radio" id="rent" name="sale_rent" value="rent" checked>
                                <label for="rent" class="search-text-head">เช่า</label>
                            </div>

                            <div>
                                <input type="radio" id="buy" name="sale_rent" value="sale">
                                <label for="buy" class="search-text-head">ซื้อ</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-12 col-sm-3">
                                <select class="form-select" aria-label="Default select example" name="property_type">
                                    <option selected disabled>ประเภททรัพย์</option>
                                    <option value="บ้านเดี่ยว">บ้านเดี่ยว</option>
                                    <option value="คอนโด">คอนโด </option>
                                    <option value="ทาวน์เฮ้าส์">ทาวน์เฮ้าส์</option>
                                    <option value="ที่ดิน">ที่ดิน</option>
                                    <option value="พาณิชย์">พาณิชย์</option>
                                </select>
                            </div>
                            <div class="mb-3  col-12 col-sm-3">
                                <select class="form-select" aria-label="Default select example" name="province">
                                    <option selected disabled>จังหวัด</option>
                                    @foreach ($provincesQuery as $proQue)
                                        <option value="{{ $proQue->name_th }}">{{ $proQue->name_th }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3  col-12 col-sm-3">
                                <select class="form-select" aria-label="Default select example" name="province">
                                    <option selected disabled>ลักษณะพิเศษ</option>
                                    <option value="ผ่อนตรง">ผ่อนตรง</option>
                                    <option value="เช่าออม">เช่าออม</option>
                                    <option value="เช่าระยะสั้นได้ (น้อยกว่า 6 เดือน)">เช่าระยะสั้นได้ (น้อยกว่า 6 เดือน)
                                    </option>
                                    <option value="ห้องเปล่า">ห้องเปล่า</option>
                                    <option value="ผ่อนตรง">ทรัพย์มือหนึ่ง</option>
                                    <option value="ผ่อนตรง">ตกแต่งสวย</option>
                                    <option value="ผ่อนตรง">ใกล้มหาวิทยาลัย</option>
                                    <option value="ผ่อนตรง">ขายขาดทุน</option>
                                </select>
                            </div>



                            <div class="mb-3  col-12 col-sm-3">
                                <button type="submit" class="btn-find-out-now">ค้นหาเลย!</button>

                            </div>
                        </div>
                        @include('layouts.model_welcome')

                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer_welocome')
@endsection
