@extends('layouts.app')

@section('content')
    <div class="box-free-trial">
        <div class="free-trial-box-nav">
            <a href="javascript:void(0);" onclick="goBack()">
                <img class="free-go-back" src="{{ URL::asset('/assets/image/welcome/go-back.png') }}">
            </a>
            <p class="free-trial">ฝากทรัพย์</p>
        </div>
        <div class="box-announced">


        </div>

    </div>
@endsection
