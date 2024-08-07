<div class="home-head">
    <div class="col-12">
        <div class="box-head-home">
            @include('layouts.offcanvasManu')
            <div>
                <p class="p-login">ทรัพย์ของฉัน ({{ $dataCount }}) </p>
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
