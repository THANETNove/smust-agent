@extends('layouts.app')

@section('content')
    <div class="box-content-background">
        <div id="container">

            <div class="box-content" id="back-home">
                <div class="content-box">
                    <a href="{{ url('/home') }}" class="box-call">
                        กลับ
                    </a>
                </div>
            </div>
            <div class="box-content">


                <div class="content-box background-white">
                    <p class="add_head-content text-center mt-3">เพิ่ม</p>
                    <form class="user" id="myForm" method="POST" action="{{ route('add-content') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">ชื่ออาคาร/สถานที่</label>
                            <input type="text" class="form-control @error('building_name') is-invalid @enderror"
                                name="building_name" id="exampleFormControlInput1" placeholder="ชื่ออาคาร/สถานที่" required>
                            @error('building_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">ประเภททรัพย์</label>
                            <select class="form-select" name="property_type" aria-label="Default select example">
                                <option value="บ้าน">บ้าน</option>
                                <option value="คอนโด">คอนโด</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">เลือก</label>
                            <select class="form-select" name="rent_sell" aria-label="Default select example">
                                <option value="เช่า">เช่า</option>
                                <option value="ขาย">ขาย</option>
                                <option value="เช่า/ขาย"> เช่า/ขาย</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">ราคาเช่า (ไม่มีไม่ต้องใส่)</label>
                            <input type="number" class="form-control @error('rental_price') is-invalid @enderror"
                                name="rental_price" id="exampleFormControlInput1" placeholder="ราคาเช่า">
                            @error('rental_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">ราคาขาย (ไม่มีไม่ต้องใส่)</label>
                            <input type="number" class="form-control @error('sell_price') is-invalid @enderror"
                                name="sell_price" id="exampleFormControlInput1" placeholder="ราคาขาย">
                            @error('sell_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">url gps</label>
                            <input type="text" class="form-control @error('url_gps') is-invalid @enderror" name="url_gps"
                                id="exampleFormControlInput1" placeholder="url gps" pattern="https?://.+">
                            @error('url_gps')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">ระยะเวลาถึงสถานีรถไฟ (นาที)</label>
                            <input type="text" class="form-control @error('time_arrive') is-invalid @enderror"
                                name="time_arrive" id="exampleFormControlInput1" placeholder="5 mins">
                            @error('time_arrive')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            @include('layouts.train_station')
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">จำนวนห้องนอน</label>
                            <input type="number" class="form-control @error('bedroom') is-invalid @enderror" name="bedroom"
                                id="exampleFormControlInput1" placeholder="จำนวนห้องนอน">
                            @error('bedroom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">จำนวนห้องน้ำ</label>
                            <input type="number" class="form-control @error('bathroom') is-invalid @enderror"
                                name="bathroom" id="exampleFormControlInput1" placeholder="จำนวนห้องนอน">
                            @error('bathroom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">ความกว้างห้อง (ตร.ม)</label>
                            <input type="number" class="form-control @error('room_width') is-invalid @enderror"
                                name="room_width" id="exampleFormControlInput1" placeholder="ความกว้างห้อง (ตร.ม)"
                                step="any">
                            @error('room_width')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">สตูดิโอ</label>
                            <select class="form-select" name="studio" aria-label="Default select example">
                                <option value="ไม่มี">ไม่มี</option>
                                <option value="มี">มี</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">จำนวนชั้น</label>
                            <input type="number" class="form-control @error('number_floors') is-invalid @enderror"
                                name="number_floors" id="exampleFormControlInput1" placeholder="1">
                            @error('number_floors')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">ของตกเเต่ง</label>
                            <select class="form-select" name="decoration" aria-label="Default select example">
                                <option value="ครบ">ครบ</option>
                                <option value="ครบ">ไม่ครบ</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">ที่อยู่</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    name="address" id="exampleFormControlInput1" placeholder="ที่อยู่">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @include('layouts.address')
                            <input type="number" class="form-control mt-2 @error('zip_code') is-invalid @enderror"
                                name="zip_code" id="zip_code" placeholder="รหัสไปรษณีย์">
                            @error('zip_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">รายละเอียด</label>
                            <textarea class="form-control" name="details" id="editor" rows="5"></textarea>
                            @error('details')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">เช่าขั้นต่ำ (เดือน)(เช่า)</label>
                            <input type="number" class="form-control mt-2 @error('minimum_rent') is-invalid @enderror"
                                name="minimum_rent" id="minimum_rent" placeholder="เช่าขั้นต่ำ">
                            @error('minimum_rent')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">เงินประกัน (เดือน)(เช่า)</label>
                            <input type="number" class="form-control mt-2 @error('deposit') is-invalid @enderror"
                                name="deposit" id="deposit" placeholder="เงินประกัน">
                            @error('deposit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">เงินมัดจำ (กี่เดือน) (เช่า)</label>
                            <input type="number" class="form-control mt-2 @error('cash_pledge') is-invalid @enderror"
                                name="cash_pledge" id="cash_pledge" placeholder="3 เดือน">
                            @error('cash_pledge')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">ค่าเช่าล่วงหน้า (เดือน)
                                (เช่า)</label>
                            <input type="number" class="form-control mt-2 @error('advance_rent') is-invalid @enderror"
                                name="advance_rent" id="advance_rent" placeholder="ค่าเช่าล่วงหน้า">
                            @error('advance_rent')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label"> เงินจอง (บาท) (เช่า)</label>
                            <input type="number"
                                class="form-control mt-2 @error('reservation_money') is-invalid @enderror"
                                name="reservation_money" id="reservation_money" placeholder="2000">
                            @error('reservation_money')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label"> เงินดาวน์ (ขาย)</label>
                            <input type="number" class="form-control mt-2 @error('down_payment') is-invalid @enderror"
                                name="down_payment" id="down_payment" placeholder="2000">
                            @error('down_payment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">ผ่อนดาวน์ (ขาย)</label>
                            <select class="form-select" name="down_payment_installments"
                                aria-label="Default select example">
                                <option value="ได้">ได้</option>
                                <option value="ไม่ได้">ไม่ได้</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">ผ่อนได้ กี่งวด (ขาย)</label>
                            <input type="number" class="form-control mt-2 @error('installments') is-invalid @enderror"
                                name="installments" id="installments" placeholder="3">
                            @error('installments')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">งวดละ (ขาย)</label>
                            <input type="number"
                                class="form-control mt-2 @error('each_installment') is-invalid @enderror"
                                name="each_installment" id="each_installment" placeholder="3000">
                            @error('each_installment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" name="kitchen" type="checkbox"
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            ห้องครัว
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" name="bed" type="checkbox"
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            เตียง
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fitness"
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            ฟิตเนส
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" name="wardrobe" type="checkbox"
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            ตู้เสื้อผ้า
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" name="parking" type="checkbox"
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            ที่จอดรถ
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" name="air_conditioner" type="checkbox"
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            เครื่องปรับอากาศ
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div id="input-container">
                                <!-- Existing input fields or none -->
                            </div>
                            <button type="button" id="add-input" class=" btn btn-primary mt-3 mb-5 btn-user btn-block">
                                เพิ่มเติ่ม
                            </button>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1"
                                class="form-label font-red">ภาพถูกเก็บเเบบเรียงตามตัวอักษร a-z หรือ 0-9</label>
                            <input id="file" type="file"
                                class="form-control @error('image[]') is-invalid @enderror" name="image[]"
                                value="{{ old('image[]') }}" multiple required placeholder="image">

                            @error('image[]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">นัดดูสถานที่</label>
                            <input type="text"
                                class="form-control mt-2 @error('make_appointment_location') is-invalid @enderror"
                                name="make_appointment_location" id="make_appointment_location"
                                placeholder="นัดดูสถานที่" pattern="https?://.+">
                            @error('make_appointment_location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">ส่งลูกค้า</label>
                            <input type="text" class="form-control mt-2 @error('send_customers') is-invalid @enderror"
                                name="send_customers" id="send_customers" placeholder="ส่งลูกค้า" pattern="https?://.+">
                            @error('send_customers')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">ถามเพิ่มเติม</label>
                            <input type="text" class="form-control mt-2 @error('ask_more') is-invalid @enderror"
                                name="ask_more" id="ask_more" placeholder="ถามเพิ่มเติม" pattern="https?://.+">
                            @error('ask_more')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">เบอร์ติดต่อ</label>
                            <input type="text" class="form-control mt-2 @error('contact_number') is-invalid @enderror"
                                name="contact_number" id="contact_number" placeholder="เบอร์ติดต่อ">
                            @error('contact_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <button type="submit" id="submitBtn"
                            class=" btn btn-primary mt-3 mb-5
                    btn-user btn-block">
                            {{ __('บันทึก') }}
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Initialize CKEditor
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>

    @include('admin.address')
    @include('admin.addInputJs')
@endsection
