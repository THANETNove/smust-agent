@extends('layouts.app')

@section('content')
    <div class="box-content-background">
        <div id="container">

            <div class="box-content" id="back-home">
                <div class="content-box">
                    <a href="{{ url('/home') }}" class="box-call">
                        กลับ
                    </a>
                </div>
            </div>
            <div class="box-content">


                <div class="content-box background-white mp-16 pb-16">
                    <p class="add_head-content text-center mt-3">profile</p>
                    @if (session('error'))
                        <p class="error-message text-center mt-4"> {{ session('error') }}</p>
                    @endif
                    @if (session('message'))
                        <p class="message-text text-center mt-4"> {{ session('message') }}</p>
                    @endif
                    <div class="flex-direction-row">
                        <div class="box-profile">email</div>
                        <div class="box-profile2">{{ Auth::user()->email }}</div>
                    </div>
                    <div class="flex-direction-row mt-01">
                        <div class="box-profile">ชื่อ</div>
                        <div class="box-profile2">{{ Auth::user()->first_name }}</div>
                    </div>
                    <div class="flex-direction-row mt-01">
                        <div class="box-profile">นามสกุล</div>
                        <div class="box-profile2">{{ Auth::user()->last_name }}</div>
                    </div>
                    <div class="flex-direction-row mt-01">
                        <div class="box-profile">รหัส Admin</div>
                        <div class="box-profile2">
                            @if (Auth::user()->code_admin)
                                {{ Auth::user()->code_admin }}
                            @else
                                <form class="d-flex  col-12 col-md-12 mb-3" role="code_admin" method="POST"
                                    action="{{ route('add-code_admin') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input class="form-control me-2" type="text" name="code_admin"
                                        placeholder="code_admin" aria-label="code_admin">
                                    <button class="btn btn-outline-success" type="submit">add</button>
                                </form>
                            @endif

                        </div>
                    </div>

                    {{-- <p>ชื่อ&nbsp; {{ Auth::user()->first_name }}&nbsp; &nbsp; &nbsp; &nbsp; นามสกุล&nbsp;
                        {{ Auth::user()->last_name }}</p>

                    <div class="flex-direction-break-word">
                        <div>email &nbsp; &nbsp; &nbsp; &nbsp;</div>
                        <div>
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <div class="flex-direction-break-word">
                        <div>รหัส Admin &nbsp; &nbsp; &nbsp; &nbsp;</div>
                        <div>
                            <form class="d-flex  col-12 col-md-12 mb-3" role="code_admin" method="POST"
                                action="{{ route('add-code_admin') }}" enctype="multipart/form-data">
                                @csrf
                                <input class="form-control me-2" type="text" name="code_admin" placeholder="code_admin"
                                    aria-label="code_admin">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                    </div>

 --}}
                </div>
            </div>
        </div>
    </div>
@endsection
