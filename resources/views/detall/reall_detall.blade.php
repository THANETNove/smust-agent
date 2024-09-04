{{-- <p class="text-content">{!! $home->details !!}</p> --}}

<p class="text-content-black margin-bottom-8">
    <img class="icon-content-2" src="{{ URL::asset('/assets/image/home/Vector.png') }}">
    เช่าขั้นต่ำ <span class="ml-16">{{ number_format($home->minimum_rent) }}
        เดือน</span>
</p>
<div class="">
    <div class="w-100">
        @if ($home->name_have)
            <p class="text-content-black margin-bottom-8 space-between">
                <span> <img class="icon-content-2" src="{{ URL::asset('/assets/image/home/pajamas_sort-lowest.png') }}">
                    โฉนดมีภาระหนี้กับ {{ $home->name_have }}</span>

            </p>
        @else
            <p class="text-content-black margin-bottom-8 space-between">
                <span> <img class="icon-content-2" src="{{ URL::asset('/assets/image/home/pajamas_sort-lowest.png') }}">
                    โฉนดมีภาระหนี้ไม่</span>

            </p>
        @endif
        @if ($home->deposit)
            <p class="text-content-black margin-bottom-8 space-between">
                <span> <img class="icon-content-2" src="{{ URL::asset('/assets/image/home/pajamas_sort-lowest.png') }}">
                    เงินประกัน {{ number_format($home->deposit) }} เดือน</span>

            </p>
        @endif

        <p class="text-content-black margin-bottom-8 space-between">
            <span> <img class="icon-content-2" src="{{ URL::asset('/assets/image/home/pajamas_sort-lowest.png') }}">
                ค่าเช่าล่วงหน้า @if ($home->advance_rent)
                    {{ number_format($home->advance_rent) }}
                @else
                    {{ number_format($home->month_advance_rent) }}
                @endif

                เดือน</span>

        </p>
    </div>
    <div class="w-100">
        <p class="text-content-black margin-bottom-8">
            <img class="icon-content-2" src="{{ URL::asset('/assets/image/home/pajamas_sort-lowest.png') }}">
            เงินมัดจำ <span class="ml-16"> {{ $home->cash_pledge }} เดือน</span>
        </p>
        <p class="text-content-black margin-bottom-8">
            <img class="icon-content-2" src="{{ URL::asset('/assets/image/home/pajamas_sort-lowest.png') }}">
            เงินจอง <span class="ml-16">{{ number_format($home->reservation_money) }}
                บาท</span>
        </p>
    </div>
</div>
