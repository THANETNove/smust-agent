@extends('layouts.app')

@section('content')
    <div class="box-free-trial">
        <div>
            <a href="{{ url('free-trial') }}">
                <img class="free-go-back" src="{{ URL::asset('/assets/image/welcome/go-back.png') }}">
            </a>
            <p class="free-trial">แพลนทั้งหมด</p>
        </div>
        <div class="container-box-free">
            <img class="head-plans" src="{{ URL::asset('/assets/image/welcome/head-plans.png') }}">
        </div>
        <p class="upgrade-now">อัปเกรดเลย!</p>

        <div class="container-pro-premium">
            <a {{-- href="#" target="_blank" --}} rel="noopener noreferrer">
                <img class="plans-pro-premium-img" src="{{ URL::asset('/assets/image/welcome/plans-pro.png') }}">
            </a>
            <a {{-- href="#" target="_blank" --}} rel="noopener noreferrer">
                <img class="plans-pro-premium-img" src="{{ URL::asset('/assets/image/welcome/plans-premium.png') }}">
            </a>
        </div>
        <p class="compare-plans">เปรียบเทียบแพลน</p>
        <div class="container-box-free">
            <img class="compare-plans-img" src="{{ URL::asset('/assets/image/welcome/compare-plans.png') }}">
        </div>
    </div>
@endsection
