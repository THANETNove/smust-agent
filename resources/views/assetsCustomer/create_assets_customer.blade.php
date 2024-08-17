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
                    <div class="row">
                        profile
                    </div>
                </div>
            </div>


        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        <img class="icon-filterData" src="{{ URL::asset('/assets/image/welcome/filterData.png') }}">

                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>เลือกทำเลจาก</p>
                </div>


            </div>
        </div>
    </div>
@endsection
