@extends('layouts.app')

@section('content')
    <div class="home-background">

        @if (session('message'))
            <p class="message-text text-center mt-4"> {{ session('message') }}</p>
        @endif

        {{--    <div class="col-12">
            @if (Auth::user()->status != '0')
                @if (Auth::user()->status < 3)
                    @if ($number < 101)
                        <a href="{{ url('/create-content') }}" class="box-call ml-16">เพิ่ม</a>
                    @endif
                @else
                    <a href="{{ url('/create-content') }}" class="box-call ml-16">เพิ่ม</a>
                @endif
            @endif
        </div> --}}


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
                <div class="box-search-home">
                    <img class="icon-search" src="{{ URL::asset('/assets/image/welcome/search.png') }}">
                    <input type="text" class="form-control box-filter_alt" id="exampleFormControlInput1"
                        placeholder="พิมพ์ค้นหา...">
                </div>
                <div class="box-filter-home">
                    <div>
                        <img class="icon-filterData" src="{{ URL::asset('/assets/image/welcome/filterData.png') }}">
                    </div>
                    <div>
                        <img class="icon-filter" src="{{ URL::asset('/assets/image/welcome/filter.png') }}">
                    </div>
                    <div>

                        <img class="icon-filterLove" src="{{ URL::asset('/assets/image/welcome/filterLove.png') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
