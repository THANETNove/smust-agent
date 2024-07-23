@extends('layouts.app')

@section('content')
    <div class="box-content-background">
        <div id="container">

            <div class="box-content" id="back-home">
                <div class="content-box flex-direction-row">
                    <a href="{{ url('/home') }}" class="box-call">
                        กลับ home
                    </a>
                    &nbsp; &nbsp;
                    <a href="{{ url('get-detall', $id) }}" class="box-call">
                        กลับเดิม
                    </a>

                </div>
            </div>
            <div class="box-content">


                <div class="content-box background-white">
                    <p class="add_head-content text-center mt-3">เเก้ไข</p>

                    @foreach ($dataProduct as $hod)
                        <form class="user" id="myForm" method="POST" action="{{ route('update', $hod->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">ชื่ออาคาร/สถานที่</label>
                                <input type="text" class="form-control @error('building_name') is-invalid @enderror"
                                    name="building_name" id="exampleFormControlInput1" value="{{ $hod->building_name }}"
                                    placeholder="ชื่ออาคาร/สถานที่" required>
                                @error('building_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">ประเภททรัพย์</label>
                                <select class="form-select" name="property_type" aria-label="Default select example">
                                    @if ($hod->property_type == 'บ้าน')
                                        <option value="บ้าน" selected>บ้าน</option>
                                    @else
                                        <option value="บ้าน">บ้าน</option>
                                    @endif
                                    @if ($hod->property_type == 'คอนโด')
                                        <option value="คอนโด" selected>คอนโด</option>
                                    @else
                                        <option value="คอนโด">คอนโด</option>
                                    @endif

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">เลือก</label>
                                <select class="form-select" name="rent_sell" aria-label="Default select example">
                                    @if ($hod->rent_sell == 'เช่า')
                                        <option value="เช่า" selected>เช่า</option>
                                    @else
                                        <option value="เช่า">เช่า</option>
                                    @endif
                                    @if ($hod->rent_sell == 'ขาย')
                                        <option value="ขาย" selected>ขาย</option>
                                    @else
                                        <option value="ขาย">ขาย</option>
                                    @endif
                                    @if ($hod->rent_sell == 'เช่า/ขาย')
                                        <option value="เช่า/ขาย" selected>เช่า/ขาย</option>
                                    @else
                                        <option value="เช่า/ขาย">เช่า/ขาย</option>
                                    @endif

                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">ราคาเช่า (ไม่มีไม่ต้องใส่)</label>
                                <input type="number" class="form-control @error('rental_price') is-invalid @enderror"
                                    name="rental_price" id="exampleFormControlInput1" placeholder="ราคาเช่า"
                                    value="{{ $hod->rental_price }}">
                                @error('rental_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">ราคาขาย (ไม่มีไม่ต้องใส่)</label>
                                <input type="number" class="form-control @error('sell_price') is-invalid @enderror"
                                    name="sell_price" value="{{ $hod->sell_price }}" id="exampleFormControlInput1"
                                    placeholder="ราคาขาย">
                                @error('sell_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">url gps</label>
                                <input type="text" class="form-control @error('url_gps') is-invalid @enderror"
                                    name="url_gps" id="exampleFormControlInput1" value="{{ $hod->url_gps }}"
                                    placeholder="url gps">
                                @error('url_gps')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">ระยะเวลาถึงสถานีรถไฟ (นาที)</label>
                                <input type="text" class="form-control @error('time_arrive') is-invalid @enderror"
                                    name="time_arrive" id="exampleFormControlInput1" value="{{ $hod->time_arrive }}"
                                    placeholder="5 mins">
                                @error('time_arrive')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <select class="form-select mt-2 font-size-12-black " name="train_name"
                                    aria-label="Default select example">
                                    <option selected disabled> ชื่อสถานี</option>
                                    <option value="ไม่มี">ไม่มี</option>
                                    @foreach ($train_station as $train)
                                        @if ($hod->train_name == $train->station_name_th)
                                            <option value="{{ $train->station_name_th }}" selected>
                                                {{ $train->station_name_th }}</option>
                                        @else
                                            <option value="{{ $train->station_name_th }}">{{ $train->station_name_th }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">จำนวนห้องนอน</label>
                                <input type="number" class="form-control @error('bedroom') is-invalid @enderror"
                                    name="bedroom" id="exampleFormControlInput1" value="{{ $hod->bedroom }}"
                                    placeholder="จำนวนห้องนอน">
                                @error('bedroom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">จำนวนห้องน้ำ</label>
                                <input type="number" class="form-control @error('bathroom') is-invalid @enderror"
                                    name="bathroom" id="exampleFormControlInput1" value="{{ $hod->bathroom }}"
                                    placeholder="จำนวนห้องนอน">
                                @error('bathroom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">ความกว้างห้อง (ตร.ม)</label>
                                <input type="number" class="form-control @error('room_width') is-invalid @enderror"
                                    name="room_width" id="exampleFormControlInput1" value="{{ $hod->room_width }}"
                                    placeholder="ความกว้างห้อง (ตร.ม)" step="any">
                                @error('room_width')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">สตูดิโอ</label>
                                <select class="form-select" name="studio" aria-label="Default select example">
                                    @if ($hod->studio == 'ไม่มี')
                                        <option value="ไม่มี" selected>ไม่มี</option>
                                    @else
                                        <option value="ไม่มี">ไม่มี</option>
                                    @endif

                                    @if ($hod->studio == 'มี')
                                        <option value="มี" selected>มี</option>
                                    @else
                                        <option value="มี">มี</option>
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">จำนวนชั้น</label>
                                <input type="number" class="form-control @error('number_floors') is-invalid @enderror"
                                    name="number_floors" id="exampleFormControlInput1" value="{{ $hod->number_floors }}"
                                    placeholder="1">
                                @error('number_floors')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">ของตกเเต่ง</label>
                                <select class="form-select" name="decoration" aria-label="Default select example">
                                    @if ($hod->decoration == 'ครบ')
                                        <option value="ครบ" selected>ครบ</option>
                                    @else
                                        <option value="ครบ">ครบ</option>
                                    @endif
                                    @if ($hod->decoration == 'ไม่ครบ')
                                        <option value="ไม่ครบ" selected>ไม่ครบ</option>
                                    @else
                                        <option value="ไม่ครบ">ไม่ครบ</option>
                                    @endif

                                </select>
                            </div>
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">ที่อยู่</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        name="address" id="exampleFormControlInput1" value="{{ $hod->address }}"
                                        placeholder="ที่อยู่">
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <select class="select-address select-address form-select font-size-12-black"
                                    name="provinces" id="provinces-id" aria-label="Default select example">
                                    <option selected disabled>จังหวัด</option>
                                    @foreach ($data as $provinces)
                                        @if ($provinces->id == $hod->provinces)
                                            <option value="{{ $provinces->id }}" selected>{{ $provinces->name_th }}
                                            </option>
                                        @else
                                            <option value="{{ $provinces->id }}">{{ $provinces->name_th }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <select class="select-address form-select mt-2 font-size-12-black" name="districts"
                                    id="districts" aria-label="Default select example">
                                    <option selected disabled>เขต/อำเภอ</option>
                                    @foreach ($dataAmphures as $amp)
                                        <option value="{{ $amp->id }}" selected>{{ $amp->name_th }}
                                        </option>
                                    @endforeach

                                </select>
                                <select class="select-address form-select mt-2 font-size-12-black" name="amphures"
                                    id="amphures" aria-label="Default select example">
                                    <option selected disabled>แขวง/อำเภอ</option>
                                    @foreach ($dataDistricts as $dip)
                                        <option value="{{ $dip->id }}" selected>{{ $dip->name_th }}
                                        </option>
                                    @endforeach

                                </select>
                                <input type="number" class="form-control mt-2 @error('zip_code') is-invalid @enderror"
                                    name="zip_code"
                                    value="{{ isset($dataDistricts[0]) ? $dataDistricts[0]->zip_code : '' }}"
                                    id="zip_code" placeholder="รหัสไปรษณีย์">
                                @error('zip_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">รายละเอียด</label>


                                <textarea class="form-control" name="details" id="editor" rows="5">{{ $hod->details }}</textarea>

                                @error('details')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">เช่าขั้นต่ำ (เดือน)(เช่า)
                                </label>
                                <input type="number"
                                    class="form-control mt-2 @error('minimum_rent') is-invalid @enderror"
                                    name="minimum_rent" id="minimum_rent" value="{{ $hod->minimum_rent }}"
                                    placeholder="เช่าขั้นต่ำ">
                                @error('minimum_rent')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">เงินประกัน (เดือน)(เช่า)</label>
                                <input type="number" class="form-control mt-2 @error('deposit') is-invalid @enderror"
                                    name="deposit" id="deposit" value="{{ $hod->deposit }}" placeholder="เงินประกัน">
                                @error('deposit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">เงินมัดจำ (กี่เดือน)
                                    (เช่า)
                                </label>
                                <input type="number"
                                    class="form-control mt-2 @error('cash_pledge') is-invalid @enderror"
                                    name="cash_pledge" id="cash_pledge" value="{{ $hod->cash_pledge }}"
                                    placeholder="3 เดือน">
                                @error('cash_pledge')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">ค่าเช่าล่วงหน้า
                                    (เดือน)(เช่า)</label>
                                <input type="number"
                                    class="form-control mt-2 @error('advance_rent') is-invalid @enderror"
                                    name="advance_rent" id="advance_rent" value="{{ $hod->advance_rent }}"
                                    placeholder="ค่าเช่าล่วงหน้า">
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
                                    name="reservation_money" id="reservation_money"
                                    value="{{ $hod->reservation_money }}" placeholder="2000">
                                @error('reservation_money')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label"> เงินดาวน์ (ขาย)</label>
                                <input type="number"
                                    class="form-control mt-2 @error('down_payment') is-invalid @enderror"
                                    name="down_payment" id="down_payment" value="{{ $hod->down_payment }}"
                                    placeholder="2000">
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
                                    @if ($hod->down_payment_installments == 'ได้')
                                        <option value="ได้" selected>ได้</option>
                                    @else
                                        <option value="ได้">ได้</option>
                                    @endif
                                    @if ($hod->down_payment_installments == 'ไม่ได้')
                                        <option value="ไม่ได้" selected>ไม่ได้</option>
                                    @else
                                        <option value="ไม่ได้">ไม่ได้</option>
                                    @endif


                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">ผ่อนได้ กี่งวด (ขาย)</label>
                                <input type="number"
                                    class="form-control mt-2 @error('installments') is-invalid @enderror"
                                    name="installments" id="installments" value="{{ $hod->installments }}"
                                    placeholder="3">
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
                                    name="each_installment" id="each_installment" value="{{ $hod->each_installment }}"
                                    placeholder="3000">
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
                                                id="flexCheckDefault" @if ($hod->kitchen == 'on') checked @endif>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                ห้องครัว
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" name="bed" type="checkbox"
                                                @if ($hod->bed == 'on') checked @endif id="flexCheckDefault">
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
                                                @if ($hod->fitness == 'on') checked @endif id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                ฟิตเนส
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" name="wardrobe" type="checkbox"
                                                @if ($hod->wardrobe == 'on') checked @endif id="flexCheckDefault">
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
                                                @if ($hod->parking == 'on') checked @endif id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                ที่จอดรถ
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" name="air_conditioner" type="checkbox"
                                                @if ($hod->air_conditioner == 'on') checked @endif id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                เครื่องปรับอากาศ
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($hod->thereVarious)
                                @php
                                    $thereVarious = json_decode($hod->thereVarious, true);
                                    $conntThereVarious = count($thereVarious);
                                @endphp
                                <div class="flex-direction-break-word" id="input-container"
                                    data-counter="{{ $conntThereVarious }}">

                                    @foreach ($thereVarious as $key => $value)
                                        <input type='text' class='form-control mt-2'
                                            name='thereVarious[{{ $key }}]' value="{{ $value }}"
                                            placeholder='เพิ่มเติม สิ่งอำนวยความสะดวก'>
                                    @endforeach

                                </div>
                            @endif
                            <div id="input-container">
                                <!-- Existing input fields or none -->
                            </div>
                            <button type="button" id="add-input" class=" btn btn-primary mt-3 mb-5 btn-user btn-block">
                                เพิ่มเติ่ม
                            </button>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1"
                                    class="form-label font-red">ภาพถูกเก็บเเบบเรียงตามตัวอักษร a-z หรือ 0-9</label>
                                <input id="file" type="file"
                                    class="form-control @error('image[]') is-invalid @enderror" name="image[]"
                                    value="{{ old('image[]') }}" multiple placeholder="image">

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
                                    value="{{ $hod->make_appointment_location }}" placeholder="นัดดูสถานที่"
                                    pattern="https?://.+">
                                @error('make_appointment_location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">ส่งลูกค้า</label>
                                <input type="text"
                                    class="form-control mt-2 @error('send_customers') is-invalid @enderror"
                                    name="send_customers" value="{{ $hod->send_customers }}" id="send_customers"
                                    placeholder="ส่งลูกค้า" pattern="https?://.+">
                                @error('send_customers')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">ถามเพิ่มเติม</label>
                                <input type="text" class="form-control mt-2 @error('ask_more') is-invalid @enderror"
                                    name="ask_more" id="ask_more" value="{{ $hod->ask_more }}"
                                    placeholder="ถามเพิ่มเติม" pattern="https?://.+">
                                @error('ask_more')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">เบอร์ติดต่อ</label>
                                <input type="text"
                                    class="form-control mt-2 @error('contact_number') is-invalid @enderror"
                                    name="contact_number" id="contact_number" value="{{ $hod->contact_number }}"
                                    placeholder="เบอร์ติดต่อ">
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('admin.address')
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });


        $(document).ready(function() {
            var counter = 0;

            $("#add-input").click(function() {
                // Display a confirmation dialog
                var userConfirmation = confirm("เพิ่มเติมช่องสิ่งอำนวยความสะดวก");

                // Check if the user clicked "OK"
                if (userConfirmation) {
                    // Increment the counter for a unique name
                    counter++;

                    // Create a new input element with a unique name
                    var newInput = $("<div class='input-group mt-2'>" +
                        "<input type='text' class='form-control' name='thereVarious[" +
                        counter + "]' placeholder='เพิ่มเติม สิ่งอำนวยความสะดวก'>" +
                        "<div class='input-group-append'>" +
                        "<button class='btn btn-danger remove-input ml-3' type='button'>Remove</button>" +
                        "</div>" +
                        "</div>");

                    // Append the new input to the container
                    $("#input-container").append(newInput);

                    // Add click event for the remove button
                    $(".remove-input").click(function() {
                        $(this).closest('.input-group').remove();
                    });
                }
                // If the user clicked "Cancel," do nothing
            });
        });
    </script>


@endsection
