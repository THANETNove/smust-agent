  {{-- ขาย  --}}
  {{--   <p class="text-content">{!! $home->details !!}</p> --}}
  <div class="mt-3">
      <p class="text-content-black margin-bottom-8">
          <img class="icon-content-2" src="{{ URL::asset('/assets/image/home/pajamas_sort-lowest.png') }}">
          ราคาขาย <span class="ml-8">{{ number_format($home->sell_price) }}
              บาท</span>
      </p>
      <div class="">
          <div class="w-100">
              <p class="text-content-black margin-bottom-8 ">
                  <span>
                      <img class="icon-content-2" src="{{ URL::asset('/assets/image/home/pajamas_sort-lowest.png') }}">
                      เงินจอง <span class="ml-8"> {{ number_format($home->reservation_amount_baht) }}
                          บาท</span>
                  </span>
              </p>
              <p class="text-content-black margin-bottom-8 ">
                  <span>
                      <img class="icon-content-2" src="{{ URL::asset('/assets/image/home/pajamas_sort-lowest.png') }}">
                      เงินดาวน์ <span class="ml-8"> {{ number_format($home->down_payment) }}
                          บาท</span>
                  </span>
              </p>

              @if ($home->down_payment_installments == 'ได้')
                  <p class="text-content-black margin-bottom-8 ">
                      <span><img class="icon-content-2"
                              src="{{ URL::asset('/assets/image/home/pajamas_sort-lowest.png') }}">
                          ผ่อนได้ <span class="ml-16">{{ $home->installments }} งวด</span></span>
                  </p>
              @endif
          </div>
          <div class="w-100">
              <p class="text-content-black margin-bottom-8">
                  @if ($home->down_payment_installments == 'ได้' || $home->installments || $home->each_installment)
                      <img class="icon-content-2" src="{{ URL::asset('/assets/image/home/check.png') }}">
                  @else
                      <img class="icon-content-close" src="{{ URL::asset('/assets/image/home/close.png') }}">
                  @endif

                  @if ($home->down_payment_installments)
                      ผ่อนดาวน์ {{ $home->down_payment_installments }}
                  @endif
                  @if ($home->installments || $home->each_installment)
                      ผ่อนดาวน์ ได้
                  @else
                      ผ่อนดาวน์ ไม่ได้
                  @endif

              </p>
              @if ($home->down_payment_installments == 'ได้' || $home->installments || $home->each_installment)
                  <p class="text-content-black margin-bottom-8">
                  <p class="text-content-black margin-bottom-8">
                      <img class="icon-content-2" src="{{ URL::asset('/assets/image/home/pajamas_sort-lowest.png') }}">
                      ผ่อนได้ <span class="ml-16">{{ number_format($home->installments) }} งวด/เดือน
                  </p>
                  <img class="icon-content-2" src="{{ URL::asset('/assets/image/home/pajamas_sort-lowest.png') }}">
                  งวดละ <span class="ml-16">{{ number_format($home->each_installment) }} บาท
                      </p>
              @endif
          </div>
      </div>


  </div>
