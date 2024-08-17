@extends('layouts.app')

@section('content')
    <div class="box-free-trial">
        <div>
            <a href="javascript:void(0);" onclick="goBack()">
                <img class="free-go-back" src="{{ URL::asset('/assets/image/welcome/go-back.png') }}">
            </a>
            <p class="free-trial">
                สร้างประกาศ
            </p>
        </div>
    @endsection
