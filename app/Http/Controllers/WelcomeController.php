<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    function houseCondo(Request $request)
    {


        // Create base query
        $dataHomeQuery = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.status_home', 'on')
            ->join('provinces', 'rent_sell_home_details.provinces', '=', 'provinces.id')
            ->join('amphures', 'rent_sell_home_details.districts', '=', 'amphures.id')
            ->join('districts', 'rent_sell_home_details.amphures', '=', 'districts.id')
            ->select(
                'rent_sell_home_details.*',
                'provinces.name_th AS provinces_name_th',
                'districts.name_th AS districts_name_th',
                'amphures.name_th AS amphures_name_th'
            );

        // ตรวจสอบค่าที่รับจาก request
        if ($request->all()) {

            //! คันหา
            if ($request->area_station == 'area' || $request->area_station == 'station') {

                if ($request->area_station == 'area') {

                    if ($request->has('provinces')) {
                        $dataHomeQuery->where('rent_sell_home_details.provinces', $request->input('provinces'));
                    }
                    if ($request->has('amphures')) {
                        $dataHomeQuery->where('rent_sell_home_details.amphures', $request->input('amphures'));
                    }
                    if ($request->has('districts')) {
                        $dataHomeQuery->where('rent_sell_home_details.districts', $request->input('districts'));
                    }
                } else {
                    if ($request->has('stations')) {

                        $dataHomeQuery->where('rent_sell_home_details.train_name', $request->input('stations'));
                    }
                }

                if ($request->has('property_type')) {
                    $typeName =   $request->input('property_type');
                    $dataHomeQuery->where('rent_sell_home_details.property_type',   'LIKE', "%$typeName%");
                }

                if ($request->has('sale_rent')) {
                    $priceRange = $request->input('price_range');

                    // ตรวจสอบประเภทการขายหรือเช่า
                    if ($request->input('sale_rent') == 'sale') {

                        $dataHomeQuery->where(function ($query) {
                            $nameSale = "ขาย";
                            $query->where('rent_sell_home_details.rent_sell',   'LIKE', "%$nameSale%")
                                ->orWhere('rent_sell_home_details.sell', 'LIKE', "%$nameSale%");
                        });
                    } elseif ($request->input('sale_rent') == 'rent') {
                        $dataHomeQuery->where(function ($query) {

                            $nameRent = "เช่า";
                            $query->where('rent_sell_home_details.rent_sell', 'LIKE', "%$nameRent%")
                                ->orWhere('rent_sell_home_details.sell', 'LIKE', "%$nameRent%");
                        });
                    } else {
                        // กรณีเลือกทั้งการขายและเช่า
                        if ($request->has('price_range')) {
                            if (strpos($priceRange, '-') !== false) {
                                [$minPrice, $maxPrice] = explode('-', $priceRange);
                                $dataHomeQuery->whereBetween('rent_sell_home_details.sell_price', [$minPrice, $maxPrice])
                                    ->orWhereBetween('rent_sell_home_details.rental_price', [$minPrice, $maxPrice]);
                            }
                        }
                    }
                }
                $dataHomeQuery->orderBy('rent_sell_home_details.id', 'DESC');
            }
            //! ขนาดพื้นที่
            if ($request->has('usable_area')) {

                $usableArea = $request->input('usable_area');

                if ($usableArea) {
                    if ($usableArea === '29') {
                        // ค่าที่เลือกคือ 'น้อยกว่า 30 ตร.ม.'
                        $dataHomeQuery->where('rent_sell_home_details.room_width', '<', 30);
                    } elseif ($usableArea === '30-50') {
                        // ค่าที่เลือกคือ '30-50 ตร.ม.'
                        $dataHomeQuery->whereBetween('rent_sell_home_details.room_width', [30, 50]);
                    } elseif ($usableArea === '50-100') {
                        // ค่าที่เลือกคือ '50-100 ตร.ม.'
                        $dataHomeQuery->whereBetween('rent_sell_home_details.room_width', [50, 100]);
                    } elseif ($usableArea === '100-1000') {
                        // ค่าที่เลือกคือ '100-1,000 ตร.ม.'
                        $dataHomeQuery->whereBetween('rent_sell_home_details.room_width', [100, 1000]);
                    } elseif ($usableArea === '1000-5000') {
                        // ค่าที่เลือกคือ '1,000-5,000 ตร.ม.'
                        $dataHomeQuery->whereBetween('rent_sell_home_details.room_width', [1000, 5000]);
                    } elseif ($usableArea === '5001') {
                        // ค่าที่เลือกคือ 'มากกว่า 5,000 ตร.ม.'
                        $dataHomeQuery->where('rent_sell_home_details.room_width', '>', 5000);
                    }
                }
            }


            //! ช่วงราคา
            if ($request->has('price_range')) {
                if (strpos($priceRange, '-') !== false) {
                    [$minPrice, $maxPrice] = explode('-', $priceRange);
                    $dataHomeQuery->whereBetween('rent_sell_home_details.rental_price', [$minPrice, $maxPrice]);
                } elseif ($priceRange == '10000001') {
                    // ราคาเช่าเกิน 10 ล้าน
                    $dataHomeQuery->where('rent_sell_home_details.rental_price', '>', 10000000);
                } else {
                    // น้อยกว่า 10,000 บาท
                    $dataHomeQuery->where('rent_sell_home_details.rental_price', '<', 10000);
                }
            }

            //! วันที่โพสต์วันนี
            if ($request->has('date_posted')) {
                $datePosted = $request->input('date_posted');

                switch ($datePosted) {
                    case '1':
                        // โพสต์วันนี้
                        $dataHomeQuery->whereDate('rent_sell_home_details.created_at', Carbon::today());
                        break;
                    case '2':
                        // โพสต์ในสัปดาห์นี้
                        $dataHomeQuery->whereBetween('rent_sell_home_details.created_at', [Carbon::now()->startOfWeek(), Carbon::now()]);
                        break;
                    case '3':
                        // โพสต์ในเดือนนี้
                        $dataHomeQuery->whereBetween('rent_sell_home_details.created_at', [Carbon::now()->startOfMonth(), Carbon::now()]);
                        break;
                    case '4':
                        // โพสต์ภายใน 1-6 เดือนที่ผ่านมา
                        $dataHomeQuery->whereBetween('rent_sell_home_details.created_at', [Carbon::now()->subMonths(6), Carbon::now()]);
                        break;
                    case '5':
                        // โพสต์มากกว่า 6 เดือนที่ผ่านมา
                        $dataHomeQuery->where('rent_sell_home_details.created_at', '<', Carbon::now()->subMonths(6));
                        break;
                }
            }


            //! เรียงตามน้อย - มาก/ มาก-น้อย
            if ($request->has('too_little')) {


                //TODO ราคา
                if ($request->too_little == 'price_min_max') {
                    $dataHomeQuery->orderBy('rent_sell_home_details.rental_price', 'ASC')
                        ->orderBy('rent_sell_home_details.sell_price', 'ASC');
                }
                if ($request->too_little == 'price_max_min') {
                    $dataHomeQuery->orderBy('rent_sell_home_details.rental_price', 'DESC')
                        ->orderBy('rent_sell_home_details.sell_price', 'DESC');
                }
                //TODO พื้นที่
                if ($request->too_little == 'area_min_max') {
                    $dataHomeQuery->orderBy('rent_sell_home_details.room_width', 'ASC');
                }
                if ($request->too_little == 'area_max_min') {
                    $dataHomeQuery->orderBy('rent_sell_home_details.room_width', 'DESC');
                }
                //TODO จํานวนชั้น
                if ($request->too_little == 'area_min_max') {
                    $dataHomeQuery->orderBy('rent_sell_home_details.number_floors', 'ASC');
                }
                if ($request->too_little == 'area_max_min') {
                    $dataHomeQuery->orderBy('rent_sell_home_details.number_floors', 'DESC');
                }
            }
        } else {

            $dataHomeQuery->orderBy('rent_sell_home_details.id', 'DESC');
        }


        $weData = $dataHomeQuery->paginate(100)->appends(request()->except('page'));





        return view('house_condo', compact('weData'));
    }
    function houseCondoDetails($id)
    {


        // Create base query
        $dataHome = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.id', $id)
            ->leftJoin('provinces', 'rent_sell_home_details.provinces', '=', 'provinces.id')
            ->leftJoin('amphures', 'rent_sell_home_details.districts', '=', 'amphures.id') //เขต/ ตำบล
            ->leftJoin('districts', 'rent_sell_home_details.amphures', '=', 'districts.id') //เขต/ อำเภอ
            ->select(
                'rent_sell_home_details.*',
                'provinces.name_th AS provinces_name_th',
                'districts.name_th AS districts_name_th',
                'amphures.name_th AS amphures_name_th'
            )
            ->orderBy('rent_sell_home_details.id', 'DESC')
            ->get();

        return view('house_condo_details', compact('dataHome'));
    }
}