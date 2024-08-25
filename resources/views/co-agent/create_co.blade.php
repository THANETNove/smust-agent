@extends('layouts.app')

@section('content')
    <div class="box-announced-co">
        <div class="smust-co-head-box ">
            <img class="img-ellipse" src="{{ URL::asset('/assets/image/welcome/Ellipse.png') }}">
            <div class="back-co">
                <a href="javascript:void(0);" onclick="goBack()">
                    <img class="co-go-back" src="{{ URL::asset('/assets/image/welcome/go-back.png') }}">
                </a>
                <p class="co-trial">ฝากทรัพย์</p>
            </div>


            <img class="img-smust" src="{{ URL::asset('/assets/image/welcome/SMUSTLogo.png') }}">
        </div>
        <div class="box-announced">

            <div class="progress-bar-co">
                <div class="progress-step completed"></div>
                <div class="progress-step completed"></div>
                <div class="progress-step"></div>
                <div class="progress-step"></div>
                <div class="progress-step"></div>
            </div>



        </div>

    </div>
@endsection
