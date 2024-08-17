@extends('layouts.app')

@section('content')
    <div class="home-background">

        @if (session('message'))
            <p class="message-text text-center mt-4"> {{ session('message') }}</p>
        @endif
        <div class="home-head">
            <div class="col-12">
                <div class="box-head-home">
                    @include('layouts.offcanvasManu')
                    <div>
                        <p class="p-login">ทรัพย์ที่ลูกค้าต้องการ </p>
                    </div>
                    <div class="box-number-count">
                        <div class="number-count"> 5</div>
                        <img class="vector-icon" src="{{ URL::asset('/assets/image/welcome/Vector.png') }}">
                    </div>
                </div>
                <div class="box-search-home justify-content-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <img class="search-filter" src="{{ URL::asset('/assets/image/welcome/Search-Filter.png') }}">

                </div>

            </div>
            <div class="box-nav-link-home nav nav-tabs" id="myTab" role="tablist">
                <div class="box-link-manu-home active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                    type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                    ส่วนลูกค้า
                </div>
                <div class="box-link-manu-home" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                    type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                    ส่วน co-agent
                </div>
            </div>
        </div>
        <div class="card-content">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                    tabindex="0">
                    <div class="row">
                        home
                    </div>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                    tabindex="0">
                    <div>
                        <a href="{{ url('create-assets-customer') }}">
                            <img class="icon-frame648" src="{{ URL::asset('/assets/image/welcome/frame648.png') }}">
                        </a>
                    </div>
                </div>
            </div>


        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        <img class="icon-filterData" src="{{ URL::asset('/assets/image/welcome/filterData.png') }}">

                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>เลือกทำเลจาก</p>

                    <div class="row-box">
                        <div class="filter-box" data-type="area" onclick="toggleSelection(this)">
                            <img class="icon-location" src="{{ URL::asset('/assets/image/welcome/location_on.png') }}">
                            <p>ย่าน</p>
                        </div>
                        <div class="filter-box" data-type="station" onclick="toggleSelection(this)">
                            <img class="icon-location" src="{{ URL::asset('/assets/image/welcome/train.png') }}">
                            <p>สถานีรถไฟฟ้า</p>
                        </div>
                    </div>

                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <p style="margin-top: 12px">ประเภทสัญญา</p>
                    <div class="row-box">
                        <div class="filter-box-input form-check" data-type="area">
                            <input class="form-check-input" type="radio" name="filterOptions" id="filterArea"
                                onclick="toggleSelectionBox(this)">
                            <label class="form-check-label" for="filterArea">

                                เช่า
                            </label>
                        </div>
                        <div class="filter-box-input form-check" data-type="station">
                            <input class="form-check-input" type="radio" name="filterOptions" id="filterStation"
                                onclick="toggleSelectionBox(this)">
                            <label class="form-check-label" for="filterStation">

                                ซื้อ
                            </label>
                        </div>
                        <div class="filter-box-input form-check" data-type="all">
                            <input class="form-check-input" type="radio" name="filterOptions" id="filterAll"
                                onclick="toggleSelectionBox(this)">
                            <label class="form-check-label" for="filterAll">

                                ทั้งหมด
                            </label>
                        </div>
                    </div>
                    <p style="margin-top: 12px">ลักษณะพิเศษ</p>
                    <div class="row-box" style="margin-top: 12px">
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    ผ่อนตรง </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    เช่าออม
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    เช่าระยะสั้นได้ (น้อยกว่า 6 เดือน)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    ขายขาดทุน
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    ใกล้มหาวิทยาลัยดัง
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    ห้องเปล่า
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    ทรัพย์มือหนึ่ง
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    ตกแต่งสวยเว่อร์
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    คนต่างชาติ
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary col-12 mt-3"> <span> <img class="icon-search-box"
                                src="{{ URL::asset('/assets/image/welcome/search-box.png') }}"></span>คันหา</button>

                </div>

            </div>
        </div>
    </div>

    <script>
        let selectedType = null;

        function toggleSelection(element) {
            const type = element.getAttribute('data-type');

            // If the same element is clicked, deselect it
            if (selectedType === type) {
                element.classList.remove('selected');
                selectedType = null;
            } else {
                // Deselect the previously selected element, if any
                const previouslySelected = document.querySelector('.filter-box.selected');
                if (previouslySelected) {
                    previouslySelected.classList.remove('selected');
                }

                // Select the clicked element
                element.classList.add('selected');
                selectedType = type;
            }

            // Log the selected type or perform an action based on it
            console.log('Selected type:', selectedType);
        }

        function toggleSelectionBox(element) {
            // Remove 'selected' class from all filter-boxes
            document.querySelectorAll('.filter-box-input').forEach(box => box.classList.remove('selected'));

            // Add 'selected' class to the clicked element's parent
            element.closest('.filter-box-input').classList.add('selected');
        }
    </script>
@endsection
