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
                        @php
                            $lastDisplayedDate = null;
                        @endphp
                        <div class="margin-wants-box">
                            @if ($authCount == 1)
                                @foreach ($wants->take(10) as $wan)
                                    <div>
                                        @php
                                            $createdAt = \Carbon\Carbon::parse($wan->created_at);
                                            $now = \Carbon\Carbon::now();
                                            $diffInDays = $createdAt->diffInDays($now);

                                            if ($createdAt->isToday()) {
                                                $displayText = 'วันนี้';
                                            } elseif ($createdAt->isYesterday()) {
                                                $displayText = 'เมื่อวาน';
                                            } elseif ($diffInDays <= 7) {
                                                $displayText = 'สัปดาห์นี้';
                                            } elseif ($diffInDays <= 30) {
                                                $displayText = 'เดือนนี้';
                                            } else {
                                                $displayText = 'เกิน 1 เดือน';
                                            }

                                            // ตรวจสอบว่ากลุ่มวันที่นี้ได้แสดงผลไปแล้วหรือยัง
                                            if ($lastDisplayedDate !== $displayText) {
                                                echo '<div class="ass-hr-wants"><span>' .
                                                    $displayText .
                                                    '</span></div>';
                                                $lastDisplayedDate = $displayText;
                                            }
                                        @endphp

                                    </div>

                                    <div class="wants-box">
                                        <div class="row-box">
                                            <div class="col-2 wants-box-icon">
                                                @php
                                                    $backgroundColors = [
                                                        'บ้าน' => '#B8D7E2', // สีทอง
                                                        'บ้านเดี่ยว' => '#B8D7E2', // สีส้มอ่อน
                                                        'คอนโด' => '#FBC9BB', // สีฟ้าอ่อน
                                                        'ทาวน์เฮ้าส์' => '#B8D7E2', // สีเขียวอ่อน
                                                        'ที่ดิน' => '#FEE8C7', // สีชมพูอ่อน
                                                        'พาณิชย์' => '#629F8C', // สีเทาอ่อน
                                                    ];
                                                @endphp
                                                <div class="ass-box-icon"
                                                    style="background-color: {{ $backgroundColors[$wan->property_type] }}">
                                                    @php
                                                        $propertyImages = [
                                                            'บ้าน' => '/assets/image/welcome/cottage.png',
                                                            'บ้านเดี่ยว' => '/assets/image/welcome/cottage.png',
                                                            'คอนโด' => '/assets/image/welcome/location_city.png',
                                                            'ทาวน์เฮ้าส์' => '/assets/image/welcome/fluent_.png',
                                                            'ที่ดิน' => '/assets/image/welcome/group_49.png',
                                                            'พาณิชย์' => '/assets/image/welcome/location_city.png',
                                                        ];
                                                    @endphp

                                                    @if (isset($propertyImages[$wan->property_type]))
                                                        <img class="icon-cottage"
                                                            src="{{ URL::asset($propertyImages[$wan->property_type]) }}">
                                                    @endif

                                                    <p class="icon-cottage-text">{{ $wan->property_type }}</p>
                                                </div>


                                                @if ($wan->sale_rent == 'sale')
                                                    <div class="ass-box-sale">
                                                        ขาย
                                                    </div>
                                                @else
                                                    <div class="ass-box-rent">
                                                        เช่า
                                                    </div>
                                                @endif

                                            </div>
                                            <div class="col-10">
                                                <div>
                                                    <img class="icon-cottage"
                                                        src="{{ URL::asset('/assets/image/welcome/pajamas_sort-lowest.png') }}">

                                                    <span class="ass-price_start">{{ number_format($wan->price_start) }} -
                                                        {{ number_format($wan->price_end) }}</span>
                                                </div>
                                                <div>
                                                    <img class="icon-cottage"
                                                        src="{{ URL::asset('/assets/image/welcome/location_on.png') }}">
                                                    <span class="station_name_th">{{ $wan->provinces_name_th }}
                                                        {{ $wan->districts_name_th }} {{ $wan->amphures_name_th }}</span>
                                                </div>
                                                <div>
                                                    @php
                                                        // ตรวจสอบสีเพื่อตรวจว่าเป็น BTS หรือ MRT
                                                        $prefix = '';
                                                        if (in_array($wan->line_code, ['Light green', 'Dark green'])) {
                                                            $prefix = 'BTS';
                                                        } elseif (in_array($wan->line_code, ['Blue', 'Purple'])) {
                                                            $prefix = 'MRT';
                                                        } elseif (in_array($wan->line_code, ['ARL'])) {
                                                            $prefix = 'ARL';
                                                        }
                                                    @endphp
                                                    @if ($wan->station_name_th)
                                                        <img class="icon-cottage"
                                                            src="{{ URL::asset('/assets/image/home/directions_subway.png') }}">
                                                        <span class="station_name_th">{{ $prefix }}
                                                            {{ $wan->station_name_th }}
                                                        </span>
                                                    @endif

                                                </div>
                                                <div class="row-ass mt-2">

                                                    @php
                                                        $optionsArray = json_decode($wan->options, true); // แปลง JSON string เป็น array
                                                    @endphp

                                                    @if (is_array($optionsArray))
                                                        @foreach ($optionsArray as $op)
                                                            <div class="special-characteristics">#{{ $op }}</div>
                                                        @endforeach
                                                    @endif

                                                </div>
                                                <div class="row ">

                                                    <div>
                                                        <p class="message_customer">{{ $wan->message_customer }}</p>
                                                    </div>

                                                </div>
                                                <div class="ass-hr"></div>
                                                <div class="ass-user">
                                                    <div class="row-ass">

                                                        @if ($wan->user_id)
                                                            <img class="icon-cottage-user"
                                                                src="{{ URL::asset($wan->image) }}">
                                                        @else
                                                            <img class="icon-cottage"
                                                                src="{{ URL::asset('/assets/image/welcome/Frame360.png') }}">
                                                        @endif


                                                        <div class="box-dan-name">
                                                            <p class="dan-name">
                                                                @if ($wan->user_id)
                                                                    {{ $wan->first_name }} {{ $wan->last_name }}
                                                                @else
                                                                    {{ $wan->webName }}
                                                                @endif

                                                            </p>
                                                            @php
                                                                $createdAt = \Carbon\Carbon::parse($wan->created_at);
                                                                $now = \Carbon\Carbon::now();

                                                                if ($createdAt->diffInDays($now) < 1) {
                                                                    $hoursDiff = $createdAt->diffInHours($now);
                                                                    if ($hoursDiff == 0) {
                                                                        $minutesDiff = $createdAt->diffInMinutes($now);
                                                                        $displayTime = $minutesDiff . ' นาทีที่ผ่านมา'; // เช่น "15 นาทีที่ผ่านมา"
                                                                    } else {
                                                                        $displayTime = $hoursDiff . ' ชั่วโมงก่อน'; // เช่น "6 ชั่วโมงก่อน"
                                                                    }
                                                                } else {
                                                                    $displayTime = $createdAt
                                                                        ->locale('th')
                                                                        ->translatedFormat('d F Y'); // แสดงวันที่ในรูปแบบ 27 กุมภาพันธ์ 2024
                                                                }
                                                            @endphp

                                                            <p class="dan-time">
                                                                {{ $displayTime }}
                                                            </p>



                                                        </div>
                                                    </div>
                                                    <div style="margin-right: 16px">
                                                        @if (is_null($wan->user_id))
                                                            @php
                                                                $lineIsUrl = filter_var(
                                                                    $wan->webLine,
                                                                    FILTER_VALIDATE_URL,
                                                                );
                                                                $facebookIsUrl = filter_var(
                                                                    $wan->webFacebook,
                                                                    FILTER_VALIDATE_URL,
                                                                );
                                                            @endphp

                                                            @if ($wan->webLine)
                                                                @if ($lineIsUrl)
                                                                    <a href="{{ $wan->webLine }}" class="no-underline"
                                                                        target="_blank" rel="noopener noreferrer">
                                                                        <img class="ass-icon-line"
                                                                            src="{{ URL::asset('/assets/image/home/line.png') }}">
                                                                    </a>
                                                                @else
                                                                    <img class="ass-icon-line"
                                                                        src="{{ URL::asset('/assets/image/home/line.png') }}"
                                                                        onclick="copyLineID('{{ $wan->webLine }}')">
                                                                @endif
                                                            @endif

                                                            @if ($wan->webFacebook)
                                                                @if ($facebookIsUrl)
                                                                    <a href="{{ $wan->webFacebook }}" target="_blank"
                                                                        rel="noopener noreferrer" class="no-underline">
                                                                        <img class="ass-icon-line"
                                                                            src="{{ URL::asset('/assets/image/home/facbook.png') }}">
                                                                    </a>
                                                                @else
                                                                    <img class="ass-icon-line"
                                                                        src="{{ URL::asset('/assets/image/home/facbook.png') }}"
                                                                        onclick="copyFacebookID('{{ $wan->webFacebook }}')">
                                                                @endif
                                                            @endif


                                                            @if ($wan->webPhone)
                                                                <a href="tel:{{ $wan->webPhone }}"
                                                                    rel="noopener noreferrer" class="no-underline">
                                                                    <img class="ass-icon-line"
                                                                        src="{{ URL::asset('/assets/image/home/thone.png') }}">
                                                                </a>
                                                            @endif
                                                        @endif

                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                @foreach ($wants as $wan)
                                    <div>
                                        @php
                                            $createdAt = \Carbon\Carbon::parse($wan->created_at);
                                            $now = \Carbon\Carbon::now();
                                            $diffInDays = $createdAt->diffInDays($now);

                                            if ($createdAt->isToday()) {
                                                $displayText = 'วันนี้';
                                            } elseif ($createdAt->isYesterday()) {
                                                $displayText = 'เมื่อวาน';
                                            } elseif ($diffInDays <= 7) {
                                                $displayText = 'สัปดาห์นี้';
                                            } elseif ($diffInDays <= 30) {
                                                $displayText = 'เดือนนี้';
                                            } else {
                                                $displayText = 'เกิน 1 เดือน';
                                            }

                                            // ตรวจสอบว่ากลุ่มวันที่นี้ได้แสดงผลไปแล้วหรือยัง
                                            if ($lastDisplayedDate !== $displayText) {
                                                echo '<div class="ass-hr-wants"><span>' .
                                                    $displayText .
                                                    '</span></div>';
                                                $lastDisplayedDate = $displayText;
                                            }
                                        @endphp

                                    </div>

                                    <div class="wants-box">
                                        <div class="row-box">
                                            <div class="col-2 wants-box-icon">
                                                @php
                                                    $backgroundColors = [
                                                        'บ้าน' => '#B8D7E2', // สีทอง
                                                        'บ้านเดี่ยว' => '#B8D7E2', // สีส้มอ่อน
                                                        'คอนโด' => '#FBC9BB', // สีฟ้าอ่อน
                                                        'ทาวน์เฮ้าส์' => '#B8D7E2', // สีเขียวอ่อน
                                                        'ที่ดิน' => '#FEE8C7', // สีชมพูอ่อน
                                                        'พาณิชย์' => '#629F8C', // สีเทาอ่อน
                                                    ];
                                                @endphp
                                                <div class="ass-box-icon"
                                                    style="background-color: {{ $backgroundColors[$wan->property_type] }}">
                                                    @php
                                                        $propertyImages = [
                                                            'บ้าน' => '/assets/image/welcome/cottage.png',
                                                            'บ้านเดี่ยว' => '/assets/image/welcome/cottage.png',
                                                            'คอนโด' => '/assets/image/welcome/location_city.png',
                                                            'ทาวน์เฮ้าส์' => '/assets/image/welcome/fluent_.png',
                                                            'ที่ดิน' => '/assets/image/welcome/group_49.png',
                                                            'พาณิชย์' => '/assets/image/welcome/location_city.png',
                                                        ];
                                                    @endphp

                                                    @if (isset($propertyImages[$wan->property_type]))
                                                        <img class="icon-cottage"
                                                            src="{{ URL::asset($propertyImages[$wan->property_type]) }}">
                                                    @endif

                                                    <p class="icon-cottage-text">{{ $wan->property_type }}</p>
                                                </div>


                                                @if ($wan->sale_rent == 'sale')
                                                    <div class="ass-box-sale">
                                                        ขาย
                                                    </div>
                                                @else
                                                    <div class="ass-box-rent">
                                                        เช่า
                                                    </div>
                                                @endif

                                            </div>
                                            <div class="col-10">
                                                <div>
                                                    <img class="icon-cottage"
                                                        src="{{ URL::asset('/assets/image/welcome/pajamas_sort-lowest.png') }}">

                                                    <span class="ass-price_start">{{ number_format($wan->price_start) }} -
                                                        {{ number_format($wan->price_end) }}</span>
                                                </div>
                                                <div>
                                                    <img class="icon-cottage"
                                                        src="{{ URL::asset('/assets/image/welcome/location_on.png') }}">
                                                    <span class="station_name_th">{{ $wan->provinces_name_th }}
                                                        {{ $wan->districts_name_th }} {{ $wan->amphures_name_th }}</span>
                                                </div>
                                                <div>
                                                    @php
                                                        // ตรวจสอบสีเพื่อตรวจว่าเป็น BTS หรือ MRT
                                                        $prefix = '';
                                                        if (in_array($wan->line_code, ['Light green', 'Dark green'])) {
                                                            $prefix = 'BTS';
                                                        } elseif (in_array($wan->line_code, ['Blue', 'Purple'])) {
                                                            $prefix = 'MRT';
                                                        } elseif (in_array($wan->line_code, ['ARL'])) {
                                                            $prefix = 'ARL';
                                                        }
                                                    @endphp
                                                    @if ($wan->station_name_th)
                                                        <img class="icon-cottage"
                                                            src="{{ URL::asset('/assets/image/home/directions_subway.png') }}">
                                                        <span class="station_name_th">{{ $prefix }}
                                                            {{ $wan->station_name_th }}
                                                        </span>
                                                    @endif

                                                </div>
                                                <div class="row-ass mt-2">

                                                    @php
                                                        $optionsArray = json_decode($wan->options, true); // แปลง JSON string เป็น array
                                                    @endphp

                                                    @if (is_array($optionsArray))
                                                        @foreach ($optionsArray as $op)
                                                            <div class="special-characteristics">#{{ $op }}
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                </div>
                                                <div class="row ">

                                                    <div>
                                                        <p class="message_customer">{{ $wan->message_customer }}</p>
                                                    </div>

                                                </div>
                                                <div class="ass-hr"></div>
                                                <div class="ass-user">
                                                    <div class="row-ass">

                                                        @if ($wan->user_id)
                                                            <img class="icon-cottage-user"
                                                                src="{{ URL::asset($wan->image) }}">
                                                        @else
                                                            <img class="icon-cottage"
                                                                src="{{ URL::asset('/assets/image/welcome/Frame360.png') }}">
                                                        @endif


                                                        <div class="box-dan-name">
                                                            <p class="dan-name">
                                                                @if ($wan->user_id)
                                                                    {{ $wan->first_name }} {{ $wan->last_name }}
                                                                @else
                                                                    {{ $wan->webName }}
                                                                @endif

                                                            </p>
                                                            @php
                                                                $createdAt = \Carbon\Carbon::parse($wan->created_at);
                                                                $now = \Carbon\Carbon::now();

                                                                if ($createdAt->diffInDays($now) < 1) {
                                                                    $hoursDiff = $createdAt->diffInHours($now);
                                                                    if ($hoursDiff == 0) {
                                                                        $minutesDiff = $createdAt->diffInMinutes($now);
                                                                        $displayTime = $minutesDiff . ' นาทีที่ผ่านมา'; // เช่น "15 นาทีที่ผ่านมา"
                                                                    } else {
                                                                        $displayTime = $hoursDiff . ' ชั่วโมงก่อน'; // เช่น "6 ชั่วโมงก่อน"
                                                                    }
                                                                } else {
                                                                    $displayTime = $createdAt
                                                                        ->locale('th')
                                                                        ->translatedFormat('d F Y'); // แสดงวันที่ในรูปแบบ 27 กุมภาพันธ์ 2024
                                                                }
                                                            @endphp

                                                            <p class="dan-time">
                                                                {{ $displayTime }}
                                                            </p>



                                                        </div>
                                                    </div>
                                                    <div style="margin-right: 16px">
                                                        @if (is_null($wan->user_id))
                                                            @php
                                                                $lineIsUrl = filter_var(
                                                                    $wan->webLine,
                                                                    FILTER_VALIDATE_URL,
                                                                );
                                                                $facebookIsUrl = filter_var(
                                                                    $wan->webFacebook,
                                                                    FILTER_VALIDATE_URL,
                                                                );
                                                            @endphp

                                                            @if ($wan->webLine)
                                                                @if ($lineIsUrl)
                                                                    <a href="{{ $wan->webLine }}" class="no-underline"
                                                                        target="_blank" rel="noopener noreferrer">
                                                                        <img class="ass-icon-line"
                                                                            src="{{ URL::asset('/assets/image/home/line.png') }}">
                                                                    </a>
                                                                @else
                                                                    <img class="ass-icon-line"
                                                                        src="{{ URL::asset('/assets/image/home/line.png') }}"
                                                                        onclick="copyLineID('{{ $wan->webLine }}')">
                                                                @endif
                                                            @endif

                                                            @if ($wan->webFacebook)
                                                                @if ($facebookIsUrl)
                                                                    <a href="{{ $wan->webFacebook }}" target="_blank"
                                                                        rel="noopener noreferrer" class="no-underline">
                                                                        <img class="ass-icon-line"
                                                                            src="{{ URL::asset('/assets/image/home/facbook.png') }}">
                                                                    </a>
                                                                @else
                                                                    <img class="ass-icon-line"
                                                                        src="{{ URL::asset('/assets/image/home/facbook.png') }}"
                                                                        onclick="copyFacebookID('{{ $wan->webFacebook }}')">
                                                                @endif
                                                            @endif
                                                            @if ($wan->webPhone)
                                                                <a href="tel:{{ $wan->webPhone }}"
                                                                    rel="noopener noreferrer" class="no-underline">
                                                                    <img class="ass-icon-line"
                                                                        src="{{ URL::asset('/assets/image/home/thone.png') }}">
                                                                </a>
                                                            @endif
                                                        @endif

                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>

                    </div>

                    @if ($authCount == 2)
                        <div class="mt-5">
                            {!! $wants->links() !!}
                        </div>
                    @endif



                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                    tabindex="0">
                    <div class="">
                        <a href="{{ url('create-assets-customer') }}">
                            <img class="icon-frame648" src="{{ URL::asset('/assets/image/welcome/frame648.png') }}">
                        </a>
                    </div>
                    @php
                        $lastDisplayedDate = null;
                    @endphp
                    <div class="margin-wants-box">
                        @if ($authCount == 1)
                            @foreach ($wants2->take(100) as $wan2)
                                <div>
                                    @php
                                        $createdAt = \Carbon\Carbon::parse($wan2->created_at);
                                        $now = \Carbon\Carbon::now();
                                        $diffInDays = $createdAt->diffInDays($now);

                                        if ($createdAt->isToday()) {
                                            $displayText = 'วันนี้';
                                        } elseif ($createdAt->isYesterday()) {
                                            $displayText = 'เมื่อวาน';
                                        } elseif ($diffInDays <= 7) {
                                            $displayText = 'สัปดาห์นี้';
                                        } elseif ($diffInDays <= 30) {
                                            $displayText = 'เดือนนี้';
                                        } else {
                                            $displayText = 'เกิน 1 เดือน';
                                        }

                                        // ตรวจสอบว่ากลุ่มวันที่นี้ได้แสดงผลไปแล้วหรือยัง
                                        if ($lastDisplayedDate !== $displayText) {
                                            echo '<div class="ass-hr-wants"><span>' . $displayText . '</span></div>';
                                            $lastDisplayedDate = $displayText;
                                        }
                                    @endphp

                                </div>

                                <div class="wants-box">
                                    <div class="row-box">
                                        <div class="col-2 wants-box-icon">
                                            @php
                                                $backgroundColors = [
                                                    'บ้าน' => '#B8D7E2', // สีทอง
                                                    'บ้านเดี่ยว' => '#B8D7E2', // สีส้มอ่อน
                                                    'คอนโด' => '#FBC9BB', // สีฟ้าอ่อน
                                                    'ทาวน์เฮ้าส์' => '#B8D7E2', // สีเขียวอ่อน
                                                    'ที่ดิน' => '#FEE8C7', // สีชมพูอ่อน
                                                    'พาณิชย์' => '#629F8C', // สีเทาอ่อน
                                                ];
                                            @endphp
                                            <div class="ass-box-icon"
                                                style="background-color: {{ $backgroundColors[$wan2->property_type] }}">
                                                @php
                                                    $propertyImages = [
                                                        'บ้าน' => '/assets/image/welcome/cottage.png',
                                                        'บ้านเดี่ยว' => '/assets/image/welcome/cottage.png',
                                                        'คอนโด' => '/assets/image/welcome/location_city.png',
                                                        'ทาวน์เฮ้าส์' => '/assets/image/welcome/fluent_.png',
                                                        'ที่ดิน' => '/assets/image/welcome/group_49.png',
                                                        'พาณิชย์' => '/assets/image/welcome/location_city.png',
                                                    ];
                                                @endphp

                                                @if (isset($propertyImages[$wan2->property_type]))
                                                    <img class="icon-cottage"
                                                        src="{{ URL::asset($propertyImages[$wan2->property_type]) }}">
                                                @endif

                                                <p class="icon-cottage-text">{{ $wan2->property_type }}</p>
                                            </div>


                                            @if ($wan2->sale_rent == 'sale')
                                                <div class="ass-box-sale">
                                                    ขาย
                                                </div>
                                            @else
                                                <div class="ass-box-rent">
                                                    เช่า
                                                </div>
                                            @endif

                                        </div>
                                        <div class="col-10">
                                            <div>
                                                <img class="icon-cottage"
                                                    src="{{ URL::asset('/assets/image/welcome/pajamas_sort-lowest.png') }}">

                                                <span class="ass-price_start">{{ number_format($wan2->price_start) }} -
                                                    {{ number_format($wan2->price_end) }}</span>
                                            </div>
                                            <div>
                                                <img class="icon-cottage"
                                                    src="{{ URL::asset('/assets/image/welcome/location_on.png') }}">
                                                <span class="station_name_th">{{ $wan2->provinces_name_th }}
                                                    {{ $wan2->districts_name_th }} {{ $wan2->amphures_name_th }}</span>
                                            </div>
                                            <div>
                                                @php
                                                    // ตรวจสอบสีเพื่อตรวจว่าเป็น BTS หรือ MRT
                                                    $prefix = '';
                                                    if (in_array($wan2->line_code, ['Light green', 'Dark green'])) {
                                                        $prefix = 'BTS';
                                                    } elseif (in_array($wan2->line_code, ['Blue', 'Purple'])) {
                                                        $prefix = 'MRT';
                                                    } elseif (in_array($wan2->line_code, ['ARL'])) {
                                                        $prefix = 'ARL';
                                                    }
                                                @endphp
                                                @if ($wan2->station_name_th)
                                                    <img class="icon-cottage"
                                                        src="{{ URL::asset('/assets/image/home/directions_subway.png') }}">
                                                    <span class="station_name_th">{{ $prefix }}
                                                        {{ $wan2->station_name_th }}
                                                    </span>
                                                @endif

                                            </div>
                                            <div class="row-ass mt-2">

                                                @php
                                                    $optionsArray = json_decode($wan2->options, true); // แปลง JSON string เป็น array
                                                @endphp

                                                @if (is_array($optionsArray))
                                                    @foreach ($optionsArray as $op)
                                                        <div class="special-characteristics">#{{ $op }}</div>
                                                    @endforeach
                                                @endif

                                            </div>
                                            <div class="row ">

                                                <div>
                                                    <p class="message_customer">{{ $wan2->message_customer }}</p>
                                                </div>

                                            </div>
                                            <div class="ass-hr"></div>
                                            <div class="ass-user">
                                                <div class="row-ass">

                                                    @if ($wan2->user_id)
                                                        <img class="icon-cottage-user"
                                                            src="{{ URL::asset($wan2->image) }}">
                                                    @else
                                                        <img class="icon-cottage"
                                                            src="{{ URL::asset('/assets/image/welcome/Frame360.png') }}">
                                                    @endif


                                                    <div class="box-dan-name">
                                                        <p class="dan-name">
                                                            @if ($wan2->user_id)
                                                                {{ $wan2->first_name }} {{ $wan2->last_name }}
                                                            @else
                                                                {{ $wan->webName }}
                                                            @endif

                                                        </p>
                                                        @php
                                                            $createdAt = \Carbon\Carbon::parse($wan2->created_at);
                                                            $now = \Carbon\Carbon::now();

                                                            if ($createdAt->diffInDays($now) < 1) {
                                                                $hoursDiff = $createdAt->diffInHours($now);
                                                                if ($hoursDiff == 0) {
                                                                    $minutesDiff = $createdAt->diffInMinutes($now);
                                                                    $displayTime = $minutesDiff . ' นาทีที่ผ่านมา'; // เช่น "15 นาทีที่ผ่านมา"
                                                                } else {
                                                                    $displayTime = $hoursDiff . ' ชั่วโมงก่อน'; // เช่น "6 ชั่วโมงก่อน"
                                                                }
                                                            } else {
                                                                $displayTime = $createdAt
                                                                    ->locale('th')
                                                                    ->translatedFormat('d F Y'); // แสดงวันที่ในรูปแบบ 27 กุมภาพันธ์ 2024
                                                            }
                                                        @endphp

                                                        <p class="dan-time">
                                                            {{ $displayTime }}
                                                        </p>



                                                    </div>
                                                </div>

                                                <div style="margin-right: 16px">
                                                    @if ($wan2->user_id)
                                                        @php
                                                            $lineIsUrl = filter_var(
                                                                $wan2->line_id,
                                                                FILTER_VALIDATE_URL,
                                                            );
                                                            $facebookIsUrl = filter_var(
                                                                $wan2->facebook_id,
                                                                FILTER_VALIDATE_URL,
                                                            );
                                                        @endphp

                                                        @if ($wan2->line_id)
                                                            @if ($lineIsUrl)
                                                                <a href="{{ $wan2->line_id }}" class="no-underline"
                                                                    target="_blank" rel="noopener noreferrer">
                                                                    <img class="ass-icon-line"
                                                                        src="{{ URL::asset('/assets/image/home/line.png') }}">
                                                                </a>
                                                            @else
                                                                <img class="ass-icon-line"
                                                                    src="{{ URL::asset('/assets/image/home/line.png') }}"
                                                                    onclick="copyLineID('{{ $wan2->line_id }}')">
                                                            @endif
                                                        @endif

                                                        @if ($wan2->facebook_id)
                                                            @if ($facebookIsUrl)
                                                                <a href="{{ $wan2->facebook_id }}" target="_blank"
                                                                    rel="noopener noreferrer" class="no-underline">
                                                                    <img class="ass-icon-line"
                                                                        src="{{ URL::asset('/assets/image/home/facbook.png') }}">
                                                                </a>
                                                            @else
                                                                <img class="ass-icon-line"
                                                                    src="{{ URL::asset('/assets/image/home/facbook.png') }}"
                                                                    onclick="copyFacebookID('{{ $wan2->facebook_id }}')">
                                                            @endif
                                                        @endif




                                                        @if ($wan2->phone)
                                                            <a href="tel:{{ $wan2->phone }}" rel="noopener noreferrer"
                                                                class="no-underline">
                                                                <img class="ass-icon-line"
                                                                    src="{{ URL::asset('/assets/image/home/thone.png') }}">
                                                            </a>
                                                        @endif
                                                    @endif

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @foreach ($wants2 as $wan2)
                                <div>
                                    @php
                                        $createdAt = \Carbon\Carbon::parse($wan2->created_at);
                                        $now = \Carbon\Carbon::now();
                                        $diffInDays = $createdAt->diffInDays($now);

                                        if ($createdAt->isToday()) {
                                            $displayText = 'วันนี้';
                                        } elseif ($createdAt->isYesterday()) {
                                            $displayText = 'เมื่อวาน';
                                        } elseif ($diffInDays <= 7) {
                                            $displayText = 'สัปดาห์นี้';
                                        } elseif ($diffInDays <= 30) {
                                            $displayText = 'เดือนนี้';
                                        } else {
                                            $displayText = 'เกิน 1 เดือน';
                                        }

                                        // ตรวจสอบว่ากลุ่มวันที่นี้ได้แสดงผลไปแล้วหรือยัง
                                        if ($lastDisplayedDate !== $displayText) {
                                            echo '<div class="ass-hr-wants"><span>' . $displayText . '</span></div>';
                                            $lastDisplayedDate = $displayText;
                                        }
                                    @endphp

                                </div>

                                <div class="wants-box">
                                    <div class="row-box">
                                        <div class="col-2 wants-box-icon">
                                            @php
                                                $backgroundColors = [
                                                    'บ้าน' => '#B8D7E2', // สีทอง
                                                    'บ้านเดี่ยว' => '#B8D7E2', // สีส้มอ่อน
                                                    'คอนโด' => '#FBC9BB', // สีฟ้าอ่อน
                                                    'ทาวน์เฮ้าส์' => '#B8D7E2', // สีเขียวอ่อน
                                                    'ที่ดิน' => '#FEE8C7', // สีชมพูอ่อน
                                                    'พาณิชย์' => '#629F8C', // สีเทาอ่อน
                                                ];
                                            @endphp
                                            <div class="ass-box-icon"
                                                style="background-color: {{ $backgroundColors[$wan2->property_type] }}">
                                                @php
                                                    $propertyImages = [
                                                        'บ้าน' => '/assets/image/welcome/cottage.png',
                                                        'บ้านเดี่ยว' => '/assets/image/welcome/cottage.png',
                                                        'คอนโด' => '/assets/image/welcome/location_city.png',
                                                        'ทาวน์เฮ้าส์' => '/assets/image/welcome/fluent_.png',
                                                        'ที่ดิน' => '/assets/image/welcome/group_49.png',
                                                        'พาณิชย์' => '/assets/image/welcome/location_city.png',
                                                    ];
                                                @endphp

                                                @if (isset($propertyImages[$wan2->property_type]))
                                                    <img class="icon-cottage"
                                                        src="{{ URL::asset($propertyImages[$wan2->property_type]) }}">
                                                @endif

                                                <p class="icon-cottage-text">{{ $wan2->property_type }}</p>
                                            </div>


                                            @if ($wan2->sale_rent == 'sale')
                                                <div class="ass-box-sale">
                                                    ขาย
                                                </div>
                                            @else
                                                <div class="ass-box-rent">
                                                    เช่า
                                                </div>
                                            @endif

                                        </div>
                                        <div class="col-10">
                                            <div>
                                                <img class="icon-cottage"
                                                    src="{{ URL::asset('/assets/image/welcome/pajamas_sort-lowest.png') }}">

                                                <span class="ass-price_start">{{ number_format($wan2->price_start) }} -
                                                    {{ number_format($wan2->price_end) }}</span>
                                            </div>
                                            <div>
                                                <img class="icon-cottage"
                                                    src="{{ URL::asset('/assets/image/welcome/location_on.png') }}">
                                                <span class="station_name_th">{{ $wan2->provinces_name_th }}
                                                    {{ $wan2->districts_name_th }} {{ $wan2->amphures_name_th }}</span>
                                            </div>
                                            <div>
                                                @php
                                                    // ตรวจสอบสีเพื่อตรวจว่าเป็น BTS หรือ MRT
                                                    $prefix = '';
                                                    if (in_array($wan2->line_code, ['Light green', 'Dark green'])) {
                                                        $prefix = 'BTS';
                                                    } elseif (in_array($wan2->line_code, ['Blue', 'Purple'])) {
                                                        $prefix = 'MRT';
                                                    } elseif (in_array($wan2->line_code, ['ARL'])) {
                                                        $prefix = 'ARL';
                                                    }
                                                @endphp
                                                @if ($wan2->station_name_th)
                                                    <img class="icon-cottage"
                                                        src="{{ URL::asset('/assets/image/home/directions_subway.png') }}">
                                                    <span class="station_name_th">{{ $prefix }}
                                                        {{ $wan2->station_name_th }}
                                                    </span>
                                                @endif

                                            </div>
                                            <div class="row-ass mt-2">

                                                @php
                                                    $optionsArray = json_decode($wan2->options, true); // แปลง JSON string เป็น array
                                                @endphp

                                                @if (is_array($optionsArray))
                                                    @foreach ($optionsArray as $op)
                                                        <div class="special-characteristics">#{{ $op }}</div>
                                                    @endforeach
                                                @endif

                                            </div>
                                            <div class="row ">

                                                <div>
                                                    <p class="message_customer">{{ $wan2->message_customer }}</p>
                                                </div>

                                            </div>
                                            <div class="ass-hr"></div>
                                            <div class="ass-user">
                                                <div class="row-ass">

                                                    @if ($wan2->user_id)
                                                        <img class="icon-cottage-user"
                                                            src="{{ URL::asset($wan2->image) }}">
                                                    @else
                                                        <img class="icon-cottage"
                                                            src="{{ URL::asset('/assets/image/welcome/Frame360.png') }}">
                                                    @endif


                                                    <div class="box-dan-name">
                                                        <p class="dan-name">
                                                            @if ($wan2->user_id)
                                                                {{ $wan2->first_name }} {{ $wan2->last_name }}
                                                            @endif

                                                        </p>
                                                        @php
                                                            $createdAt = \Carbon\Carbon::parse($wan2->created_at);
                                                            $now = \Carbon\Carbon::now();

                                                            if ($createdAt->diffInDays($now) < 1) {
                                                                $hoursDiff = $createdAt->diffInHours($now);
                                                                if ($hoursDiff == 0) {
                                                                    $minutesDiff = $createdAt->diffInMinutes($now);
                                                                    $displayTime = $minutesDiff . ' นาทีที่ผ่านมา'; // เช่น "15 นาทีที่ผ่านมา"
                                                                } else {
                                                                    $displayTime = $hoursDiff . ' ชั่วโมงก่อน'; // เช่น "6 ชั่วโมงก่อน"
                                                                }
                                                            } else {
                                                                $displayTime = $createdAt
                                                                    ->locale('th')
                                                                    ->translatedFormat('d F Y'); // แสดงวันที่ในรูปแบบ 27 กุมภาพันธ์ 2024
                                                            }
                                                        @endphp

                                                        <p class="dan-time">
                                                            {{ $displayTime }}
                                                        </p>



                                                    </div>
                                                </div>
                                                <div style="margin-right: 16px">
                                                    @if ($wan2->user_id)
                                                        @php
                                                            $lineIsUrl = filter_var(
                                                                $wan2->line_id,
                                                                FILTER_VALIDATE_URL,
                                                            );
                                                            $facebookIsUrl = filter_var(
                                                                $wan2->facebook_id,
                                                                FILTER_VALIDATE_URL,
                                                            );
                                                        @endphp

                                                        @if ($wan2->line_id)
                                                            @if ($lineIsUrl)
                                                                <a href="{{ $wan2->line_id }}" class="no-underline"
                                                                    target="_blank" rel="noopener noreferrer">
                                                                    <img class="ass-icon-line"
                                                                        src="{{ URL::asset('/assets/image/home/line.png') }}">
                                                                </a>
                                                            @else
                                                                <img class="ass-icon-line"
                                                                    src="{{ URL::asset('/assets/image/home/line.png') }}"
                                                                    onclick="copyLineID('{{ $wan2->line_id }}')">
                                                            @endif
                                                        @endif

                                                        @if ($wan2->facebook_id)
                                                            @if ($facebookIsUrl)
                                                                <a href="{{ $wan2->facebook_id }}" target="_blank"
                                                                    rel="noopener noreferrer" class="no-underline">
                                                                    <img class="ass-icon-line"
                                                                        src="{{ URL::asset('/assets/image/home/facbook.png') }}">
                                                                </a>
                                                            @else
                                                                <img class="ass-icon-line"
                                                                    src="{{ URL::asset('/assets/image/home/facbook.png') }}"
                                                                    onclick="copyFacebookID('{{ $wan2->facebook_id }}')">
                                                            @endif
                                                        @endif




                                                        @if ($wan2->phone)
                                                            <a href="tel:{{ $wan2->phone }}" rel="noopener noreferrer"
                                                                class="no-underline">
                                                                <img class="ass-icon-line"
                                                                    src="{{ URL::asset('/assets/image/home/thone.png') }}">
                                                            </a>
                                                        @endif
                                                    @endif

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif


                    </div>

                    @if ($authCount == 2)
                        <div class="mt-5">
                            {!! $wants2->links() !!}
                        </div>
                    @endif





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
                <form method="POST" action="{{ route('assets-customer') }}">
                    @csrf

                    <div class="modal-body">
                        <p>เลือกทำเลจาก</p>

                        <div class="row-box">
                            <div class="filter-box selected" data-type="area" onclick="toggleSelection(this)">
                                <img class="icon-location"
                                    src="{{ URL::asset('/assets/image/welcome/location_on.png') }}">
                                <p>ย่าน</p>
                            </div>
                            <div class="filter-box" data-type="station" onclick="toggleSelection(this)">
                                <img class="icon-location" src="{{ URL::asset('/assets/image/welcome/train.png') }}">
                                <p>สถานีรถไฟฟ้า</p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <input type="text" id="area-station" name="area_station" value="area"
                                style="display: none">
                            <div class="id-address">
                                @include('layouts.address')
                            </div>

                            <div class="id-trainStation" style="display: none">
                                @include('assetsCustomer.trainStation2')
                            </div>

                        </div>
                        <p style="margin-top: 12px">ประเภทสัญญา</p>
                        <div class="row-box mb-4">
                            <div class="form-check-home">
                                <input class="form-check-input" type="radio" name="sale_rent" value="rent"
                                    id="filterArea" style="display: none">
                                <label class="form-check-label3" for="filterArea">
                                    เช่า
                                </label>
                            </div>

                            <div class="form-check-home">
                                <input class="form-check-input" type="radio" name="sale_rent" value="sale"
                                    id="filterStation" style="display: none">
                                <label class="form-check-label3" for="filterStation">
                                    ซื้อ
                                </label>
                            </div>

                            <div class="form-check-home">
                                <input class="form-check-input" type="radio" name="sale_rent" value="sale_rent"
                                    id="filterAll" style="display: none">
                                <label class="form-check-label3" for="filterAll">
                                    ทั้งหมด
                                </label>
                            </div>
                        </div>
                        {{-- <div class="row-box">
                            <div class="filter-box-input form-check" data-type="area">
                                <input class="form-check-input" type="radio" name="sale_rent" value="rent"
                                    id="filterArea" onclick="toggleSelectionBox(this)">
                                <label class="form-check-label" for="filterArea">

                                    เช่า
                                </label>
                            </div>
                            <div class="filter-box-input form-check" data-type="station">
                                <input class="form-check-input" type="radio" name="sale_rent" value="sale"
                                    id="filterStation" onclick="toggleSelectionBox(this)">
                                <label class="form-check-label" for="filterStation">

                                    ซื้อ
                                </label>
                            </div>
                            <div class="filter-box-input form-check" data-type="all">
                                <input class="form-check-input" type="radio" name="sale_rent" id="filterAll"
                                    value="sale_rent" onclick="toggleSelectionBox(this)">
                                <label class="form-check-label" for="filterAll">

                                    ทั้งหมด
                                </label>
                            </div>
                        </div> --}}
                        <p style="margin-top: 12px">ลักษณะพิเศษ</p>
                        @include('assetsCustomer.optionsJs')
                        <button type="submit" class="btn btn-primary col-12 mt-4 mb-3"> <span> <img
                                    class="icon-search-box"
                                    src="{{ URL::asset('/assets/image/welcome/search-box.png') }}"></span>คันหา</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('assetsCustomer.js')

    @if ($authCount == 1)
        @include('layouts.scrollModel')
    @endif


    <script>
        function copyLineID(line_id) {

            var lineName = line_id;
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

        function copyFacebookID(facebook_id) {

            var fbName = facebook_id;
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
@endsection
