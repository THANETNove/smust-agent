<div class="home-head">
    <div class="col-12">
        <div class="box-head-home">
            @include('layouts.offcanvasManu')
            <div>
                <p class="p-login" id="data-count-1">ทรัพย์ของฉัน ({{ $dataCount }}) </p>
                <p class="p-login" id="data-count-2">ทรัพย์ของฉัน ({{ $dataCount2 }}) </p>
            </div>

            @php
                $query_co = DB::table('assets_customers_wants')->where('status', 1)->where('notifications', 1)->count();
                $query_home = DB::table('rent_sell_home_details')
                    ->where('status_home', 'on')
                    ->where('cross', 0)
                    ->where('notifications', 1)
                    ->count();

                $co_agQuery_1 = DB::table('rent_sell_home_details')
                    ->where('rent_sell_home_details.status_home', 'on')
                    ->where('rent_sell_home_details.user_id', Auth::user()->id)
                    ->join('favorites', 'rent_sell_home_details.id', '=', 'favorites.id_product')
                    ->where('favorites.status_favorites', 1)
                    ->count();
                $co_agQuery_2 = DB::table('rent_sell_home_details')
                    ->where('rent_sell_home_details.status_home', 'on')
                    ->where('rent_sell_home_details.user_id', Auth::user()->id)
                    ->join('favorites', 'rent_sell_home_details.id', '=', 'favorites.id_product')
                    ->where('favorites.status_favorites', 2)
                    ->count();
                //  dd($query_co, $query_home);

                if (Auth::user()->plans == '2') {
                    $co_hom_count = $query_home + $query_co + $co_agQuery_1 + $co_agQuery_2;
                } else {
                    $co_hom_count = $query_home + $query_co;
                }

            @endphp
            <div class="box-number-count" data-bs-toggle="modal" data-bs-target="#exampleModal3_co">
                <div class="number-count"> {{ $co_hom_count }}</div>
                <img class="vector-icon" src="{{ URL::asset('/assets/image/welcome/Vector.png') }}">
            </div>
        </div>
        {{--  <div class="box-search-home mb-3">
            <img class="icon-search" src="{{ URL::asset('/assets/image/welcome/search.png') }}">
            <input type="text" name="search_name" class="form-control box-filter_alt" id="exampleFormControlInput1"
                placeholder="พิมพ์ค้นหา...">
        </div> --}}
        <form action="{{ url('/search-name') }}" method="GET" id="searchForm">
            <div class="box-search-home mb-3">
                <img class="icon-search" src="{{ URL::asset('/assets/image/welcome/search.png') }}">
                <input type="text" name="search_name" class="form-control box-filter_alt"
                    id="exampleFormControlInput1" placeholder="พิมพ์ค้นหา..." onkeyup="doneTyping()">
            </div>
        </form>
        <script>
            let typingTimer; // ตัวแปรเก็บ timer
            let doneTypingInterval = 1000; // หน่วงเวลา 1 วินาที (1000 มิลลิวินาที)

            // ฟังก์ชันเรียกใช้เมื่อผู้ใช้พิมพ์
            function doneTyping() {
                clearTimeout(typingTimer); // ยกเลิก timer ถ้ายังไม่ครบกำหนด
                typingTimer = setTimeout(function() {
                    document.getElementById('searchForm').submit(); // ส่งฟอร์มเมื่อหยุดพิมพ์แล้ว 1 วินาที
                }, doneTypingInterval);
            }
        </script>

        <div class="box-filter-home">
            <div data-bs-toggle="modal" data-bs-target="#exampleModal">
                <img class="icon-filterData" src="{{ URL::asset('/assets/image/welcome/filterData.png') }}">
            </div>
            <div data-bs-toggle="modal" data-bs-target="#exampleModal2">
                <img class="icon-filter" src="{{ URL::asset('/assets/image/welcome/filter.png') }}">
            </div>

            <a href="{{ url('search-favorites') }}">
                <div>

                    <img class="icon-filterLove" src="{{ URL::asset('/assets/image/welcome/filterLove.png') }}">
                </div>
            </a>


        </div>

        <div class="box-nav-link-home nav nav-tabs" id="myTab" role="tablist">
            <div class="box-link-manu-home active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                ส่วนเจ้าของ
            </div>
            <div class="box-link-manu-home" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                ส่วนโคเอเจ้นท์
            </div>
        </div>

    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal3_co" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body" style="margin-top: 8px">
                <p class="text-co-home"><img class="icon-co-home"
                        src="{{ URL::asset('/assets/image/welcome/A1.png') }}">มีทรัพย์เพิ่มใหม่ {{ $query_home }}
                    รายการ</p>
                <hr>
                <p class="text-co-home"><img class="icon-co-home"
                        src="{{ URL::asset('/assets/image/welcome/A2.png') }}">มีรีเควสเพิ่มจากลูกค้า และ co-agent
                    {{ $query_co }} รายการ</p>
                @if (Auth::user()->plans == '2')
                    <hr>
                    <p class="text-co-home"><img class="icon-co-home"
                            src="{{ URL::asset('/assets/image/welcome/A3.png') }}">มี co-agent
                        อยากช่วยคุณขายทรัพย์ {{ $co_agQuery_1 }} คน <img class="icon-co-premium"
                            src="{{ URL::asset('/assets/image/welcome/iconPremium.png') }}"></p>
                    <hr>
                    <p class="text-co-home"><img class="icon-co-home"
                            src="{{ URL::asset('/assets/image/welcome/A4.png') }}">ทรัพย์ที่กดเข้ารายการโปรด
                        ถูกขายไปแล้ว {{ $co_agQuery_2 }} รายการ <img class="icon-co-premium"
                            src="{{ URL::asset('/assets/image/welcome/iconPremium.png') }}"></p>
                @endif

            </div>

        </div>
    </div>
</div>
