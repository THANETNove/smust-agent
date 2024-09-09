@extends('layouts.app')

@section('content')
    <div class="box-free-trial">
        <div @if (Auth::user()->plans > 0) class="free-trial-box-nav" @endif>
            <a href="javascript:void(0);" onclick="goBack()">
                <img class="free-go-back" src="{{ URL::asset('/assets/image/welcome/go-back.png') }}">
            </a>
            <p class="free-trial">หา co-agent ช่วยขาย</p>

        </div>
        <div class="announced-background">
            <p class="announced-property text-announced2">ทั้งหมด</p>


            @foreach ($dataHomeQuery as $dataHo)
                <div class="box-co-uses" style="display: flex; align-items: center;">
                    <div class="box-profile-co" style="margin-right: 10px;">
                        <img class="profile-co" id="rectangle123"
                            @if ($dataHo->image) src="{{ URL::asset($dataHo->image) }}"
                            @else
                        src="{{ URL::asset('/assets/image/welcome/profile.png') }}" @endif>

                        <img class="icon-co-user" id="rectangle123"
                            @if ($dataHo->plans == 2) src="{{ URL::asset('/assets/image/welcome/iconPremium.png') }}"
                             @elseif ($dataHo->plans == 1) src="{{ URL::asset('/assets/image/welcome/iconPro.png') }}"
                              @else src="{{ URL::asset('/assets/image/welcome/iconFree.png') }}" @endif>
                    </div>
                    <div style="width: 100%">

                        <div style="justify-content: space-between; display: -webkit-inline-box;">
                            <div>
                                <p class="co-agent-type">co-agent</p>
                                <p class="co-name">{{ $dataHo->first_name }} {{ $dataHo->last_name }} <span
                                        class="co-name-span">กำลังช่วยคุณขาย</span></p>
                            </div>
                            <div
                                style="margin-right: 8px;
                            position: absolute;
                            right: 0;
                            margin-top: 18px;">

                                @php
                                    $lineIsUrl = filter_var($dataHo->line_id, FILTER_VALIDATE_URL);
                                    $facebookIsUrl = filter_var($dataHo->facebook_id, FILTER_VALIDATE_URL);
                                @endphp

                                @if ($dataHo->line_id)
                                    @if ($lineIsUrl)
                                        <a href="{{ $dataHo->line_id }}" class="no-underline" target="_blank"
                                            rel="noopener noreferrer">
                                            <img class="ass-icon-line2"
                                                src="{{ URL::asset('/assets/image/home/line.png') }}">
                                        </a>
                                    @else
                                        <img class="ass-icon-line2" src="{{ URL::asset('/assets/image/home/line.png') }}"
                                            onclick="copyLineID()">
                                        <script>
                                            function copyLineID() {
                                                var lineName = "{{ $dataHo->line_id }}";
                                                Swal.fire({
                                                    title: lineName,
                                                    text: "Line ID" + "\n\nถูกคัดลอกแล้ว!",
                                                    icon: 'success',
                                                    showConfirmButton: false,
                                                    timer: 2000
                                                });
                                                navigator.clipboard.writeText(lineName).then(function() {
                                                    console.log('Line ID ถูกคัดลอกไปยัง clipboard แล้ว');
                                                }, function(err) {
                                                    console.error('ไม่สามารถคัดลอกข้อความได้:', err);
                                                });
                                            }
                                        </script>
                                    @endif
                                @endif

                                @if ($dataHo->facebook_id)
                                    @if ($facebookIsUrl)
                                        <a href="{{ $dataHo->facebook_id }}" target="_blank" rel="noopener noreferrer"
                                            class="no-underline">
                                            <img class="ass-icon-line2"
                                                src="{{ URL::asset('/assets/image/home/facbook.png') }}">
                                        </a>
                                    @else
                                        <img class="ass-icon-line2"
                                            src="{{ URL::asset('/assets/image/home/facbook.png') }}"
                                            onclick="copyFacebookID()">
                                        <script>
                                            function copyFacebookID() {
                                                var fbName = "{{ $dataHo->facebook_id }}";
                                                Swal.fire({
                                                    title: fbName,
                                                    text: "Facebook ID" + "\n\nถูกคัดลอกแล้ว!",
                                                    icon: 'success',
                                                    showConfirmButton: false,
                                                    timer: 2000
                                                });
                                                navigator.clipboard.writeText(fbName).then(function() {
                                                    console.log('Facebook ID ถูกคัดลอกไปยัง clipboard แล้ว');
                                                }, function(err) {
                                                    console.error('ไม่สามารถคัดลอกข้อความได้:', err);
                                                });
                                            }
                                        </script>
                                    @endif
                                @endif




                                @if ($dataHo->phone)
                                    <a href="tel:{{ $dataHo->phone }}" rel="noopener noreferrer" class="no-underline">
                                        <img class="ass-icon-line2" src="{{ URL::asset('/assets/image/home/thone.png') }}">
                                    </a>
                                @endif


                            </div>
                        </div>
                    </div>
                </div>
            @endforeach



        </div>

    </div>
@endsection
