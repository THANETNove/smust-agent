@extends('layouts.app')

@section('content')
    @include('layouts.navbar_welcome')
    <div class="bg-navbar-home-condo">
        <div class="search-welcome-home-condo">
            <form method="POST" action="{{ route('house-condo') }}" enctype="multipart/form-data">
                @csrf
                <div class="search-welcome-box mb-3">
                    <div>
                        <input type="radio" name="sale_rent" value="rent" id="filterArea">
                        <label for="rent" class="search-text-head">เช่า</label>
                    </div>

                    <div>
                        <input type="radio" name="sale_rent" value="sale" id="filterStation">
                        <label for="buy" class="search-text-head">ซื้อ</label>
                    </div>

                    <div>
                        <input type="radio" name="sale_rent" value="sale_rent" id="filterAll">
                        <label for="owner-financing" class="search-text-head2 head-new">ผ่อนตรงเจ้าของ
                            <span style="color: #E34234">(NEW)</span>
                        </label>
                    </div>
                </div>
                <div class="row">
                    @php
                        $characteristics = $request['property_type'] ?? '';
                        //dd($characteristics);
                    @endphp
                    <div class="mb-3 col-12 col-sm-2">
                        <select class="form-select" aria-label="Default select example" name="property_type">
                            <option selected disabled>ประเภททรัพย์</option>
                            <option value="บ้านเดี่ยว" {{ $characteristics == 'บ้านเดี่ยว' ? 'selected' : '' }}>บ้านเดี่ยว
                            </option>
                            <option value="คอนโด" {{ $characteristics == 'คอนโด' ? 'selected' : '' }}>คอนโด </option>
                            <option value="ทาวน์เฮ้าส์" {{ $characteristics == 'ทาวน์เฮ้าส์' ? 'selected' : '' }}>
                                ทาวน์เฮ้าส์
                            </option>
                            <option value="ที่ดิน" {{ $characteristics == 'ที่ดิน' ? 'selected' : '' }}>ที่ดิน</option>
                            <option value="พาณิชย์" {{ $characteristics == 'พาณิชย์' ? 'selected' : '' }}>พาณิชย์
                            </option>
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
                <a href="{{ url('create-assets-customer') }}">
                    <div class="box-agent">ให้สามารถเอเจนท์ (SMUST Agent) ช่วยหาทรัพย์ตรงใจ</div>
                </a>

            </div>
        </div>
    </div>
    <p class="all-search-results">ผลการค้นหาทั้งหมด </p>
    <div class="box-all-search-results">

        @foreach ($weData as $key => $que)
            @php
                $price = $que->sell_price;
                $priceString = (string) $price;
                if (strlen($priceString) > 6) {
                    $priceString = str_replace(',', '', $priceString);
                    $formattedPrice = number_format($priceString / 1000000, 1) . ' ล้าน';
                    $price_sell = $formattedPrice;
                } else {
                    $price_sell = number_format($que->sell_price) . ' บาท';
                }
                $rental_ = $que->rental_price;
                $rental_String = (string) $rental_;
                if (strlen($rental_String) > 6) {
                    $rental_String = str_replace(',', '', $rental_String);
                    $formatted_rental = number_format($rental_String / 1000000, 1) . ' ล้าน';
                    $rental_price = $formatted_rental;
                } else {
                    $rental_price = number_format($que->rental_price) . ' บาท';
                }

                $imgUrl = json_decode(htmlspecialchars_decode($que->image));
            @endphp

            <div class="item item-home-condo" data-index="{{ $key }}">
                <div class="rent_sell-box-we">
                    @if ($que->rent_sell == 'เช่า')
                        <span class="rent-sell-primary absolute-rent-sell">{{ $que->rent_sell }}</span>
                    @elseif ($que->rent_sell == 'ขาย')
                        <span class="rent-sell-yellow absolute-rent-sell">{{ $que->rent_sell }}</span>
                    @elseif ($que->rent_sell == 'เช่า/ขาย' || $que->rent_sell == 'เช่าซื้อ/ขายผ่อน')
                        <span class="rent-sell-green absolute-rent-sell">{{ $que->rent_sell }}</span>
                    @endif

                    @if ($que->rent == 'เช่า')
                        <span class="rent-sell-primary absolute-rent-sell">{{ $que->rent }}</span>
                    @endif

                    @if ($que->sell == 'ขาย')
                        <span class="rent-sell-yellow absolute-rent-sell">{{ $que->sell }}</span>
                    @endif
                </div>
                <button class="prev-btn2" onclick="changeImage(event, -1)">
                    <span>
                        < </span>
                </button>
                @foreach ($imgUrl as $index => $image)
                    <img class="sliderImage" src="{{ URL::asset('img/product/' . $image) }}" loading="lazy" alt="Slide"
                        style="{{ $index === 0 ? 'display: block;' : 'display: none;' }}">
                @endforeach
                <button class="next-btn2" onclick="changeImage(event, 1)">
                    <span> > </span>
                </button>

                <a href="{{ url('house-condo-details', $que->id) }}">
                    <p class="building_name-we">{{ $que->building_name }}</p>



                    <div class="box-width-rent-sell">
                        <div class="box-price-new-we">
                            @if (($que->sell_price && $que->rent_sell == 'เช่า/ขาย') || $que->rent_sell == 'เช่าซื้อ/ขายผ่อน')
                                <p class="price-new-we">฿
                                    {{ number_format($que->rental_price) }}/m
                                </p>
                                <p class="price-new-we">฿ {{ $price_sell }}</p>
                            @else
                                @if (($que->rental_price && $que->rent_sell == 'เช่า') || $que->rent == 'เช่า')
                                    <p class="price-new-we">฿ {{ number_format($que->rental_price) }}/m
                                    </p>
                                @endif
                                @if (($que->sell_price && $que->rent_sell == 'ขาย') || $que->sell == 'ขาย')
                                    <p class="price-new-we">฿{{ $price_sell }}</p>
                                @endif
                            @endif
                        </div>
                    </div>
                    <p class="provinces-we">
                        <img class="location_on-we" src="{{ URL::asset('/assets/image/home/location_on.png') }}"
                            alt="Slide">
                        {{ $que->districts_name_th }} {{ $que->amphures_name_th }}
                        {{ $que->provinces_name_th }}
                    </p>
                    <p class="number-rooms text-ellipsis img-we">
                        <span class="img-icon-ri2 img-we" style="margin-right: 12px">
                            <img class="img-icon img-icon-ri" src="{{ URL::asset('/assets/image/home/bed.png') }}">
                            {{ $que->bedroom }} ห้องนอน
                        </span>
                        <span class="img-icon-ri2 img-we">
                            <img class="img-icon img-icon-ri"
                                src="{{ URL::asset('/assets/image/home/screenshot_frame.png') }}">
                            {{ $que->room_width }} ตร.ม.
                        </span>
                    </p>

                    <div class="flex-direction-break-word margin-bottom-8 mt-wealth">
                        <div class="box-content-icon">
                            <img class="icon-content-2-we" src="{{ URL::asset('/assets/image/home/bed_2.png') }}">
                            <span>{{ $que->bedroom }} ห้องนอน</span>
                        </div>
                        <div class="box-content-icon">
                            <img class="icon-content-2-we" src="{{ URL::asset('/assets/image/home/shower.png') }}">
                            <span>{{ $que->bathroom }} ห้องน้ำ</span>
                        </div>
                        <div class="box-content-icon">
                            <img class="icon-content-2-we"
                                src="{{ URL::asset('/assets/image/home/screenshot_frame2.png') }}">
                            <span>{{ $que->room_width }} ตร.ม.</span>
                        </div>
                        @if ($que->studio == 'มี')
                            <div class="box-content-icon">
                                <img class="icon-content-2-we"
                                    src="{{ URL::asset('/assets/image/home/countertops.png') }}">
                                <span>สตูดิโอ</span>
                            </div>
                        @endif

                        <div class="box-content-icon">
                            <img class="icon-content-2-we" src="{{ URL::asset('/assets/image/home/floor.png') }}">
                            <span>ชั้น {{ $que->number_floors }}</span>
                        </div>
                        <div class="box-content-icon">
                            <img class="icon-content-2-we" src="{{ URL::asset('/assets/image/home/weekend.png') }}">
                            <span>ตกแต่ง{{ $que->decoration }}</span>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
        <div class="mt-5">
            {!! $weData->links() !!}

        </div>
    </div>


    @include('layouts.footer_welocome')

    <script>
        // เมื่อหน้าถูกโหลดเสร็จสมบูรณ์
        window.onload = function() {
            @if (isset($request))
                let requestData = @json($request);
            @else
                let requestData = null;
            @endif

            if (requestData) {
                var selecteName = null;

                if (requestData.provinces) {
                    document.querySelector("#provinces-id").value = requestData.provinces;
                }

                // เมื่อเลือก "แขวง/ อำเภอ"
                $.ajax({
                    url: "/get-districts/" + requestData.provinces,
                    type: "GET",
                    success: function(res) {
                        // อัปเดตตัวเลือก "เขต/อำเภอ"
                        var districtsSelect = $("#districts");
                        districtsSelect.find("option").remove();
                        districtsSelect.append(
                            $("<option selected disabled>เขต/อำเภอ</option>")
                        );

                        $.each(res, function(index, district) {
                            districtsSelect.append(
                                $("<option>", {
                                    value: district.id,
                                    text: district.name_th,
                                    selected: district.id == requestData.districts
                                })
                            );
                        });

                        // ถ้ามีค่า districts ที่ถูกเลือก, ดึง text ของ option ที่ selected
                        if (requestData.districts) {
                            var selectedDistrictText = districtsSelect.find("option:selected").text();
                            updateStations(selectedDistrictText, ''); // ส่งค่าไป updateStations
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    },
                });

                $.ajax({
                    url: "/get-amphures/" + requestData.districts,
                    type: "GET",
                    success: function(res) {
                        // อัปเดตตัวเลือก "แขวง/ตำบล"
                        var amphuresSelect = $("#amphures");
                        amphuresSelect.find("option").remove();
                        amphuresSelect.append(
                            $("<option selected disabled>แขวง/ตำบล</option>")
                        );

                        $.each(res, function(index, data) {
                            amphuresSelect.append(
                                $("<option>", {
                                    value: data.id,
                                    text: data.name_th,
                                    selected: data.id == requestData.amphures
                                })
                            );
                        });

                        // ถ้ามีค่า amphures ที่ถูกเลือก, ดึง text ของ option ที่ selected
                        if (requestData.amphures) {
                            var selectedAmphureText = amphuresSelect.find("option:selected").text();

                            // เรียกฟังก์ชัน updateStations พร้อมส่ง selectedDistrictText และ selectedAmphureText
                            var selectedDistrictText = $("#districts option:selected")
                                .text(); // หรือดึงจากค่า requestData.districts ถ้ามี
                            updateStations(selectedDistrictText,
                                selectedAmphureText); // ส่งค่าไปยังฟังก์ชัน
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    },
                });



                // ฟังก์ชันที่จะอัปเดตค่าใน input "stations"
                function updateStations(selectedDistrictText, selectedAmphureText) {
                    // ตรวจสอบกรณีไม่มีค่า
                    var selectedDistrict = selectedDistrictText || '';
                    var selectedAmphure = selectedAmphureText || '';
                    var provincesSelect = document.querySelector("#provinces-id");
                    var selectedProvinceText = provincesSelect.options[provincesSelect.selectedIndex].text;

                    // รวมข้อความจาก province, district และ amphure
                    var fullText = selectedProvinceText + ' , ' + selectedDistrict + ' , ' + selectedAmphure;

                    // อัปเดตค่าที่แสดงใน input "stations"
                    document.getElementById('stations').value = fullText;


                }
                $usable_area = requestData['usable_area'] ?? ''
                $price_range = requestData['price_range'] ?? ''
                $date_posted = requestData['date_posted'] ?? ''
                if (usable_area || price_range || date_posted) { // ถ้ามีค่าใดๆ ก็ให้ทำการดำเนินการ
                    // ค่าที่เลือกจาก dropdown "usable_area"
                    const varusableAreaSelect = document.querySelector("#usable_area");
                    var selectedVarusableAreaText = varusableAreaSelect.options[varusableAreaSelect.selectedIndex].text;
                    // ถ้า selectedIndex เป็น 0 หรือค่าของ selectedText เป็นค่าปริยาย เช่น "กรุณาเลือก"
                    if (varusableAreaSelect.selectedIndex === 0 || selectedVarusableAreaText === "กรุณาเลือก") {
                        selectedVarusableAreaText = null; // ใช้ค่าเป็น null
                    }

                    // ค่าที่เลือกจาก dropdown "price_range"
                    const priceRangeSelect = document.querySelector("#price_range");
                    var selectedPriceRangeText = priceRangeSelect.options[priceRangeSelect.selectedIndex].text;
                    // ถ้า selectedIndex เป็น 0 หรือค่าของ selectedText เป็นค่าปริยาย เช่น "กรุณาเลือก"
                    if (priceRangeSelect.selectedIndex === 0 || selectedPriceRangeText === "กรุณาเลือก") {
                        selectedPriceRangeText = null; // ใช้ค่าเป็น null
                    }

                    // ค่าที่เลือกจาก dropdown "date_posted"
                    const datePostedaSelect = document.querySelector("#date_posted");
                    var selectedDatePostedaText = datePostedaSelect.options[datePostedaSelect.selectedIndex].text;
                    // ถ้า selectedIndex เป็น 0 หรือค่าของ selectedText เป็นค่าปริยาย เช่น "กรุณาเลือก"
                    if (datePostedaSelect.selectedIndex === 0 || selectedDatePostedaText === "กรุณาเลือก") {
                        selectedDatePostedaText = null; // ใช้ค่าเป็น null
                    }

                    // รวมค่าที่เลือกจากทั้งหมด หากไม่มีค่าให้ใช้ 'null'
                    var dataText = '';

                    // เช็คค่าของ selectedVarusableAreaText
                    if (selectedVarusableAreaText) {
                        dataText += selectedVarusableAreaText;
                    }

                    // เช็คค่าของ selectedPriceRangeText
                    if (selectedPriceRangeText) {
                        // ถ้ามีค่า selectedVarusableAreaText อยู่แล้ว ให้เพิ่ม , ก่อนค่าที่จะใส่
                        if (dataText) {
                            dataText += ','; // เพิ่มเครื่องหมาย , ถ้ามีค่าอยู่แล้ว
                        }
                        dataText += selectedPriceRangeText;
                    }

                    // เช็คค่าของ selectedDatePostedaText
                    if (selectedDatePostedaText) {
                        // ถ้ามีค่า selectedPriceRangeText อยู่แล้ว ให้เพิ่ม , ก่อนค่าที่จะใส่
                        if (dataText) {
                            dataText += ','; // เพิ่มเครื่องหมาย , ถ้ามีค่าอยู่แล้ว
                        }
                        dataText += selectedDatePostedaText;
                    }



                    document.getElementById('welocome_filter').value = dataText;
                }




                // ประเภทสัญญา ชื้อ ขาย ทั้งหมด
                let saleRent = requestData['sale_rent'] ?? '';

                // ตรวจสอบว่า sale_rent มีค่าเป็น 'sale' และคลิกที่ปุ่ม filterStation อัตโนมัติ
                if (saleRent == 'sale') {
                    let filterStationButton = document.getElementById('filterStation');
                    if (filterStationButton) {
                        filterStationButton.click(); // คลิกที่ปุ่ม filterStation
                    }
                }
                if (saleRent == 'rent') {
                    const filterStationButton = document.getElementById('filterArea');
                    if (filterStationButton) {
                        filterStationButton.click(); // คลิกที่ปุ่ม filterStation
                    }
                }
                if (saleRent == 'sale_rent') {
                    const filterStationButton = document.getElementById('filterAll');
                    if (filterStationButton) {
                        filterStationButton.click(); // คลิกที่ปุ่ม filterStation
                    }
                }

                // สถานี้รถไฟ stations
                let stationsName = requestData['stations'] ?? '';
                if (stationsName) {
                    const station_name = document.getElementById('stations-name');
                    if (station_name) {
                        station_name.value = stationsName;
                        document.getElementById('stations').value = stationsName;
                    }
                }

                // จัดเรียงตามน้อย - มาก/ มาก-น้อย
                let tooLittle = requestData['too_little'] ?? '';

                // ราคา
                if (tooLittle == 'price_min_max') {
                    document.getElementById('filter1').click();
                }
                if (tooLittle == 'price_max_min') {
                    document.getElementById('filter2').click();
                }

                // พื้นที่ใช้สอย
                if (tooLittle == 'area_max_min') {
                    document.getElementById('filter3').click();
                }
                if (tooLittle == 'area_min_max') {
                    document.getElementById('filter4').click();
                }

                // จํานวนชั้น / ชั้น
                if (tooLittle == 'floors_max_min') {
                    document.getElementById('filter5').click();
                }
                if (tooLittle == 'floors_min_max') {
                    document.getElementById('filter6').click();
                }
            }
        }
    </script>
@endsection
