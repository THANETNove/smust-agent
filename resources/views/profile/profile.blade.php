@extends('layouts.app')

@section('content')
    <?php
    $data = DB::table('provinces')->orderBy('name_th', 'ASC')->get();
    ?>

    <div class="box-free-trial">
        <div class="free-trial-box-nav">

            @if (session('success'))
                <a href="{{ url('home') }}">
                    <img class="free-go-back" src="{{ URL::asset('/assets/image/welcome/go-back.png') }}">
                </a>
            @else
                <a href="javascript:void(0);" onclick="goBack()">
                    <img class="free-go-back" src="{{ URL::asset('/assets/image/welcome/go-back.png') }}">
                </a>
            @endif

            <p class="free-trial">
                ตั้งค่าโปรไฟล์
            </p>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <form method="POST" action="{{ route('new-setup-profile', Auth::user()->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="box-setup-profile">

                <div class="boxUserProfile" id="profileButton">
                    @if (Auth::user()->image)
                        <img id="userProfileImg" class="userProfile" src="{{ URL::asset(Auth::user()->image) }}">
                    @else
                        <img id="userProfileImg" class="userProfile"
                            src="{{ URL::asset('/assets/image/welcome/profile.png') }}">
                    @endif


                    <div class="box-edit-profile">
                        <img id="userProfileImg" class="Frame584"
                            src="{{ URL::asset('/assets/image/welcome/Frame584.png') }}">
                    </div>

                    <input type="file" id="profileInput" name="image" accept="image/*" style="display: none;">
                </div>

                <div class="box-profile-setup">

                    <p class="auto-name text-center">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                    <p class="auto-email text-center">{{ Auth::user()->email }} </p>

                    @if (Auth::user()->plans == 0)
                        <p class="auto-account text-center">
                            <img class="icon-account" src="{{ URL::asset('/assets/image/welcome/iconFree.jpg') }}">
                            Free Trial Account
                        </p>
                    @elseif (Auth::user()->plans == 1)
                        <p class="auto-account text-center">
                            <img class="icon-account" src="{{ URL::asset('/assets/image/welcome/iconPro.jpg') }}">
                            Pro Account
                        </p>
                    @elseif (Auth::user()->plans == 2)
                        <p class="auto-account text-center">
                            <img class="icon-account" src="{{ URL::asset('/assets/image/welcome/iconPremium.png') }}">
                            Premium Account
                        </p>
                    @endif
                    <p class="information-setup">ข้อมูลของฉัน</p>

                    <div class="row mb-3">
                        <div class="col-md-12 input_box">
                            <input id="number" type="number" name="phone"
                                class="form-control  @error('phone') is-invalid @enderror"
                                value="{{ Auth::user()->phone }}" required autocomplete="phone">
                            <label>เบอร์ติดต่อ <samp style="color: red;margin-left: 6px;"> *</samp></label>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 input_box">
                            <input type="numner" name="id_card_number"
                                class="form-control @error('id_card_number') is-invalid @enderror"
                                value="{{ Auth::user()->email }}" required autocomplete="id_card_number">
                            <label>เลขบัตรประจำตัวประชาชน <span style="color: red;margin-left: 6px;"> *</span> </label>
                            @error('id_card_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <p class="card_number-setup">อัปโหลดรูปบัตรประชาชน <span style="color: red;"> *</span> </p>
                    <div class="card_image" id="card_imageButton">
                        @if (Auth::user()->card_image)
                            <img id="card_numberImg" class="card_image" height="100%" width="100%"
                                src="{{ URL::asset(Auth::user()->card_image) }}">
                        @else
                            <img id="card_numberImg" class="card_image">
                        @endif

                        <img class="group78" src="{{ URL::asset('/assets/image/welcome/Group78.png') }}">

                    </div>

                    <input type="file" id="card_numberInput" class="@error('card_image') is-invalid @enderror"
                        name="card_image" accept="image/*" style="display: none;">

                    @error('card_image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <p class="card_number-setup">ช่องทางติดต่อ</p>
                    <p class="contact-setup">จะปรากฎบนเว็บไซต์สำหรับการติดต่อกลับจากลูกค้า</p>
                    <div class="row mb-3 mt-4">
                        <div class="col-md-12 input_box">
                            <input type="text" name="line_id" class="form-control @error('line_id') is-invalid @enderror"
                                value="{{ Auth::user()->line_id }}" autocomplete="Line id">
                            <label>Line ID </label>
                            @error('line_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 input_box">
                            <input type="text" name="facebook"
                                class="form-control @error('facebook') is-invalid @enderror"
                                value="{{ Auth::user()->facebook_id }}" autocomplete="Facebook">

                            <label>Facebook </label>
                            @error('facebook')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <p class="brokerage-work">งานนายหน้าที่คุณสะดวกทำงาน</p>
                    <p class="details-word">ตรงนี้จะเป็นข้อมูลที่จะโชว์ขึ้นบนเว็บไซต์สาธารณะของเราใน “นามบัตรออนไลน์”</p>
                    <div class="row mb-3">
                        <div class="col-md-12 mb-3 input_box">
                            <select class="form-select" name="provinces" aria-label="Default select example">
                                @foreach ($data as $provinces)
                                    <option value="{{ $provinces->name_th }}"
                                        @if (Auth::user()->provinces == $provinces->name_th) selected @endif>
                                        {{ $provinces->name_th }}
                                    </option>
                                @endforeach
                            </select>

                            @error('provinces')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- ประเภทสัญญา -->
                    <p class="font-size-12-black mt-21 text-left">
                        <img class="contract" src="{{ URL::asset('/assets/image/welcome/contract.png') }}">
                        ประเภทสัญญา
                    </p>
                    <div class="flex-direction-row mb-3">
                        <input type="text" class="form-control" id="contract_type_input"
                            value="{{ Auth::user()->contract_type }}" name="contract_type" data-bs-toggle="modal"
                            data-bs-target="#contractTypeModal" placeholder="เลือกประเภทสัญญา" readonly>

                    </div>

                    <!-- Modal ประเภทสัญญา (Checkbox) -->
                    <div class="modal fade" id="contractTypeModal" tabindex="-1"
                        aria-labelledby="contractTypeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="contractTypeModalLabel">เลือกประเภทสัญญา</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="contract_type_option"
                                            value="เช่า" id="contract_type_rent">
                                        <label class="form-check-label-profile" for="contract_type_rent">เช่า</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="contract_type_option"
                                            value="ขาย" id="contract_type_sell">
                                        <label class="form-check-label-profile" for="contract_type_sell">ขาย</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="contract_type_option"
                                            value="เช่า/ขาย" id="contract_type_rent_sell">
                                        <label class="form-check-label-profile"
                                            for="contract_type_rent_sell">เช่า/ขาย</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                    <button type="button" class="btn btn-primary" id="saveContractType"
                                        data-bs-dismiss="modal">บันทึก</button>
                                </div>
                            </div>
                        </div>
                    </div>




                    <!-- ประเภททรัพย์ -->
                    <p class="font-size-12-black text-left">
                        <img class="contract" src="{{ URL::asset('/assets/image/welcome/domain.png') }}">
                        ประเภททรัพย์
                    </p>
                    <div class="flex-direction-row mb-3">
                        <input type="text" class="form-control" value="{{ Auth::user()->property_type }}"
                            id="property_type_input" name="property_type" data-bs-toggle="modal"
                            data-bs-target="#propertyTypeModal" placeholder="เลือกประเภททรัพย์" readonly>

                    </div>

                    <!-- Modal ประเภททรัพย์ (Checkbox) -->
                    <div class="modal fade" id="propertyTypeModal" tabindex="-1"
                        aria-labelledby="propertyTypeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="propertyTypeModalLabel">เลือกประเภททรัพย์</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="property_type_option"
                                            value="บ้านเดี่ยว" id="property_type_house">
                                        <label class="form-check-label-profile"
                                            for="property_type_house">บ้านเดี่ยว</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="property_type_option"
                                            value="คอนโด" id="property_type_condo">
                                        <label class="form-check-label-profile" for="property_type_condo">คอนโด</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="property_type_option"
                                            value="ทาวน์เฮ้าส์" id="property_type_townhouse">
                                        <label class="form-check-label-profile"
                                            for="property_type_townhouse">ทาวน์เฮ้าส์</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="property_type_option"
                                            value="ที่ดิน" id="property_type_land">
                                        <label class="form-check-label-profile" for="property_type_land">ที่ดิน</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="property_type_option"
                                            value="พาณิชย์" id="property_type_commercial">
                                        <label class="form-check-label-profile"
                                            for="property_type_commercial">พาณิชย์</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                    <button type="button" class="btn btn-primary" id="savePropertyType"
                                        data-bs-dismiss="modal">บันทึก</button>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- ลักษณะเฉพาะ -->
                    <p class="font-size-12-black text-left">
                        <img class="contract" src="{{ URL::asset('/assets/image/welcome/domain.png') }}">
                        ลักษณะเฉพาะ
                    </p>
                    <div class="flex-direction-row">
                        <input type="text" class="form-control" id="characteristics_input"
                            value="{{ Auth::user()->characteristics }}" name="characteristics" data-bs-toggle="modal"
                            data-bs-target="#characteristicsModal" placeholder="เลือกลักษณะเฉพาะ" readonly>

                    </div>

                    <!-- Modal ลักษณะเฉพาะ (Checkbox) -->
                    <div class="modal fade" id="characteristicsModal" tabindex="-1"
                        aria-labelledby="characteristicsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="characteristicsModalLabel">เลือกลักษณะเฉพาะ</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="characteristics_option"
                                            value="ผ่อนตรง" id="characteristics_payon">
                                        <label class="form-check-label-profile"
                                            for="characteristics_payon">ผ่อนตรง</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="characteristics_option"
                                            value="ทรัพย์มือหนึ่ง" id="characteristics_new_property">
                                        <label class="form-check-label-profile"
                                            for="characteristics_new_property">ทรัพย์มือหนึ่ง</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="characteristics_option"
                                            value="เช่าออม" id="characteristics_rent_save">
                                        <label class="form-check-label-profile"
                                            for="characteristics_rent_save">เช่าออม</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="characteristics_option"
                                            value="ตกแต่งสวยเว่อร์" id="characteristics_decorated">
                                        <label class="form-check-label-profile"
                                            for="characteristics_decorated">ตกแต่งสวยเว่อร์</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="characteristics_option"
                                            value="เช่าระยะสั้นได้ (น้อยกว่า 6 เดือน)" id="characteristics_short_rent">
                                        <label class="form-check-label-profile"
                                            for="characteristics_short_rent">เช่าระยะสั้นได้
                                            (น้อยกว่า 6 เดือน)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="characteristics_option"
                                            value="ใกล้มหาวิทยาลัยดัง" id="characteristics_near_university">
                                        <label class="form-check-label-profile"
                                            for="characteristics_near_university">ใกล้มหาวิทยาลัยดัง</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="characteristics_option"
                                            value="ห้องเปล่า" id="characteristics_empty_room">
                                        <label class="form-check-label-profile"
                                            for="characteristics_empty_room">ห้องเปล่า</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                        id="saveCharacteristics">บันทึก</button>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="submit-box">
                        <button type="submit" class="btn btn-register">
                            บันทึกการแก้ไข
                        </button>

                    </div>


                </div>

            </div>
        </form>
    </div>


    </div>
    <script>
        document.getElementById('card_imageButton').addEventListener('click', function() {
            document.getElementById('card_numberInput').click();
        });

        document.getElementById('card_numberInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('card_numberImg').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });


        // Function to save the selected checkboxes and display the values
        function saveCheckedValues(modalId, checkboxName, inputId) {
            const selectedCheckboxes = document.querySelectorAll(`input[name="${checkboxName}"]:checked`);
            const values = Array.from(selectedCheckboxes).map(cb => cb.value).join(', ');
            document.getElementById(inputId).value = values;
            const modal = bootstrap.Modal.getInstance(document.getElementById(modalId));
            modal.hide();

        }

        // Save contract type selections
        document.getElementById('saveContractType').addEventListener('click', function() {
            saveCheckedValues('contractTypeModal', 'contract_type_option', 'contract_type_input');
        });

        // Save property type selections
        document.getElementById('savePropertyType').addEventListener('click', function() {
            saveCheckedValues('propertyTypeModal', 'property_type_option', 'property_type_input');
        });

        // Save characteristics selections
        document.getElementById('saveCharacteristics').addEventListener('click', function() {
            saveCheckedValues('characteristicsModal', 'characteristics_option', 'characteristics_input');
        });

        //  <!-- Modal ประเภททรัพย์ (Checkbox) -->
        document.addEventListener('DOMContentLoaded', function() {
            // แยกค่า property_type เป็นอาเรย์
            const propertyType = "{{ Auth::user()->property_type }}".split(',');

            // ตรวจสอบว่า checkbox ใดตรงกับค่าใน propertyType และตั้งค่า checked
            propertyType.forEach(type => {
                // Trim ค่าเพื่อให้ไม่มีช่องว่าง
                const trimmedType = type.trim();
                const checkbox = document.querySelector(`input[type="checkbox"][value="${trimmedType}"]`);
                if (checkbox) {
                    checkbox.checked = true; // ใส่ checked ถ้าตรงกัน
                }
            });
        });

        //  <!-- ประเภทสัญญา -->
        document.addEventListener('DOMContentLoaded', function() {
            // แยกค่า contract_type เป็นอาเรย์
            const contractType = "{{ Auth::user()->contract_type }}".split(',');

            // ตรวจสอบว่า checkbox ใดตรงกับค่าใน contractType และตั้งค่า checked
            contractType.forEach(type => {
                // Trim ค่าเพื่อให้ไม่มีช่องว่าง
                const trimmedType = type.trim();
                const checkbox = document.querySelector(`input[type="checkbox"][value="${trimmedType}"]`);
                if (checkbox) {
                    checkbox.checked = true; // ใส่ checked ถ้าตรงกัน
                }
            });
        });

        // <!-- Modal ลักษณะเฉพาะ (Checkbox) -->
        document.addEventListener('DOMContentLoaded', function() {
            // แยกค่า characteristics เป็นอาเรย์
            const characteristics = "{{ Auth::user()->characteristics }}".split(',');

            // ตรวจสอบว่า checkbox ใดตรงกับค่าใน characteristics และตั้งค่า checked
            characteristics.forEach(characteristic => {
                // Trim ค่าเพื่อให้ไม่มีช่องว่าง
                const trimmedCharacteristic = characteristic.trim();
                const checkbox = document.querySelector(
                    `input[type="checkbox"][value="${trimmedCharacteristic}"]`);
                if (checkbox) {
                    checkbox.checked = true; // ใส่ checked ถ้าตรงกัน
                }
            });
        });
    </script>
    @include('auth.profileButton')
@endsection
