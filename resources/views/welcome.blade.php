@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <img class="agentlogo-navbar" src="{{ URL::asset('/assets/image/home/SMUSTAgentlogo.png') }}">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 navbar-nav-white">
                    <li class="nav-item">
                        <a class="nav-link apply-job-with-us" aria-current="page" href="#">หาบ้าน/คอนโดที่ถูกใจ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  apply-job-with-us" aria-current="page" href="#">ศูนย์รวมนายหน้าฝีมือดี</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link apply-job-with-us" href="#">สมัครงานกับเรา</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link owner-allows-free" aria-disabled="true">เจ้าของให้เราช่วยขายได้ ฟรี</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="bg-navbar">
        <p class="integration-platform">แพลตฟอร์มรวมอสังหาริมทรัพย์<br> และนายหน้าฝีมือดี พร้อมช่วยคุณหาทรัพย์ที่ตรงใจ</p>
        <div class="search-welcome">
            {{--   <div class="search-welcome-box mb-1">
                <p class="search-text-head active">เช่า</p>
                <p class="search-text-head">ซื้อ</p>
                <p class="search-text-head-2">ผ่อนตรงเจ้าของ <span style="color:  #E34234">(NEW)</span></p>
            </div> --}}
            <div class="search-welcome-box mb-2">
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
    </div>
    <div class="box-bg">
        <div>
            <p>เช่า</p>
            <p>ซื้อ</p>
            <p>ผ่อนตรงเจ้าของ (NEW)</p>
        </div>
    </div>
@endsection
