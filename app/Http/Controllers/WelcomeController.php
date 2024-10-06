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

        $welcomeQuery = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.status_home', 'on')
            ->where('rent_sell_home_details.provinces', $dataHome[0]->provinces)
            ->join('provinces', 'rent_sell_home_details.provinces', '=', 'provinces.id')
            ->join('amphures', 'rent_sell_home_details.districts', '=', 'amphures.id')
            ->join('districts', 'rent_sell_home_details.amphures', '=', 'districts.id')
            ->select(
                'rent_sell_home_details.*',
                'provinces.name_th AS provinces_name_th',
                'districts.name_th AS districts_name_th',
                'amphures.name_th AS amphures_name_th'
            )
            ->orderBy('rent_sell_home_details.id', 'DESC')
            ->limit(13) // จำกัดผลลัพธ์เป็น 12 รายการ
            ->get();

        $favoritesQuery = DB::table('favorites')
            ->where('favorites.id_product', $id)
            ->where('users.plans', '>', 0)
            ->leftJoin('users', 'favorites.user_id', '=', 'users.id')
            ->leftJoin('personal_websites', 'favorites.user_id', '=', 'personal_websites.user_id')
            ->select(
                'users.*',
                'personal_websites.history_work'
            )
            ->orderBy('users.plans', 'DESC')
            ->orderBy('favorites.id', 'ASC')
            ->limit(4) // จำกัดผลลัพธ์เป็น 12 รายการ
            ->get();

        return view('house_condo_details', compact('dataHome', 'welcomeQuery', 'favoritesQuery'));
    }

    function skilledBrokers()
    {

        $userQuery = DB::table('users')
            /* ->where('users.plans', '>', 0) */
            ->count();
        $provincesQuery = DB::table('provinces')

            ->get();

        $favoritesQuery = DB::table('users')
            ->where('plans', '>', 1)
            ->leftJoin('personal_websites', 'users.id', '=', 'personal_websites.user_id')
            ->limit(12) // จำกัดผลลัพธ์เป็น 12 รายการ
            ->select(
                'users.*',
                'personal_websites.history_work',

            )
            ->get();

        return view('skilled_brokers', compact('userQuery', 'provincesQuery', 'favoritesQuery'));
    }
    function contactPremium(Request $request)
    {



        $provincesQuery = DB::table('provinces')
            ->get();

        $userQuery = DB::table('users')
            ->where('users.plans', '>', 0)
            ->leftJoin('personal_websites', 'users.id', '=', 'personal_websites.user_id')
            ->select(
                'users.*',
                'personal_websites.history_work',

            );

        if ($request->all()) {


            // กรณีใช้เงื่อนไขแบบ and
            $userQuery1 = (clone $userQuery)
                ->where('contract_type', $request->sale_rent)
                ->where('property_type', $request->property_type)  // สมมติว่ามีฟิลด์ `property_type`
                ->where('provinces', $request->province)
                ->where('characteristics', $request->characteristics)
                ->get();

            // ดึง id ทั้งหมดจาก $userQuery1 เพื่อไม่แสดงใน $userQuery
            $idsToExclude = $userQuery1->pluck('id')->toArray();

            // กรณีใช้เงื่อนไขแบบ or แต่ไม่เอา id ที่มีอยู่ใน $userQuery1 มาแสดง
            $userQuery = (clone $userQuery)
                ->whereNotIn('id', $idsToExclude)  // ไม่เอา id ที่มีอยู่ใน $userQuery1
                ->where(function ($query) use ($request) {
                    $query->where('contract_type', 'LIKE', "%$request->sale_rent%")
                        ->orWhere('property_type',  'LIKE', "%$request->property_type%")
                        ->orWhere('provinces', 'LIKE', "%$request->province%")
                        ->orWhere('characteristics', 'LIKE', "%$request->characteristics%");
                })
                ->get();
            $statusShow = true;
        } else {
            $userQuery = (clone $userQuery)->orderBy('plans', 'DESC')
                ->get();
            $userQuery1 = collect();
            $statusShow = false;
        }


        return view('contactPremiumAll', compact('userQuery', 'provincesQuery', 'userQuery1', 'statusShow'));
    }
    function premiumAgentHome($id)
    {

        $userQuery = DB::table('users')
            ->where('users.id', $id)
            ->leftJoin('personal_websites', 'users.id', '=', 'personal_websites.user_id')
            ->select(
                'users.*',
                'personal_websites.history_work',
                'personal_websites.image_1',
                'personal_websites.name_1',
                'personal_websites.details_1',
                'personal_websites.image_2',
                'personal_websites.name_2',
                'personal_websites.details_2',
                'personal_websites.image_3',
                'personal_websites.name_3',
                'personal_websites.details_3',
            )
            ->get();




        $welcomeQuery = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.code_admin', $userQuery[0]->code)
            ->where('rent_sell_home_details.status_home', 'on')
            ->join('provinces', 'rent_sell_home_details.provinces', '=', 'provinces.id')
            ->join('amphures', 'rent_sell_home_details.districts', '=', 'amphures.id')
            ->join('districts', 'rent_sell_home_details.amphures', '=', 'districts.id')
            ->select(
                'rent_sell_home_details.*',
                'provinces.name_th AS provinces_name_th',
                'districts.name_th AS districts_name_th',
                'amphures.name_th AS amphures_name_th'
            )
            ->orderBy('rent_sell_home_details.id', 'DESC')
            ->limit(13) // จำกัดผลลัพธ์เป็น 12 รายการ
            ->get();


        $countRentQuery = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.code_admin', $userQuery[0]->code)
            ->where(function ($query) {
                $query->where('rent_sell_home_details.rent_sell', "ขาย")
                    ->orWhere('rent_sell_home_details.sell', "ขาย");
            })
            ->count();
        $countSellQuery = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.code_admin', $userQuery[0]->code)
            ->where(function ($query) {
                $query->where('rent_sell_home_details.rent_sell', "เช่า")
                    ->orWhere('rent_sell_home_details.rent', "เช่า");
            })
            ->count();
        $countSellRentQuery = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.code_admin', $userQuery[0]->code)
            ->where(function ($query) {
                $query->where('rent_sell_home_details.rent_sell', "เช่าซื้อ/ขายผ่อน")
                    ->orWhere('rent_sell_home_details.rent_sell', "เช่า/ขาย");
            })
            ->count();
        $countRent =  $countRentQuery + $countSellRentQuery;
        $countSell =  $countSellQuery + $countSellRentQuery;



        $postQuery = DB::table('post_contents')
            ->where('user_id', $id)
            ->orderBy('updated_at', 'DESC')
            ->get();

        return view('premiumAgentHome', compact('userQuery', 'welcomeQuery', 'countRent', 'countSell', 'postQuery'));
    }
    function viewAllAssets($id)
    {

        $userQuery = DB::table('users')
            ->where('users.id', $id)
            ->leftJoin('personal_websites', 'users.id', '=', 'personal_websites.user_id')
            ->select(
                'users.*',
                'personal_websites.history_work',
                'personal_websites.image_1',
                'personal_websites.name_1',
                'personal_websites.details_1',
                'personal_websites.image_2',
                'personal_websites.name_2',
                'personal_websites.details_2',
                'personal_websites.image_3',
                'personal_websites.name_3',
                'personal_websites.details_3',
            )
            ->get();


        $welcomeQuery = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.code_admin', $userQuery[0]->code)
            ->where('rent_sell_home_details.status_home', 'on')
            ->join('provinces', 'rent_sell_home_details.provinces', '=', 'provinces.id')
            ->join('amphures', 'rent_sell_home_details.districts', '=', 'amphures.id')
            ->join('districts', 'rent_sell_home_details.amphures', '=', 'districts.id')
            ->select(
                'rent_sell_home_details.*',
                'provinces.name_th AS provinces_name_th',
                'districts.name_th AS districts_name_th',
                'amphures.name_th AS amphures_name_th'
            )
            ->orderBy('rent_sell_home_details.id', 'DESC')
            ->get();

        return view('viewAllAssets', compact('userQuery', 'welcomeQuery'));
    }
    function interestedMore()
    {
        $asked = DB::table('frequently_asked_questions')
            ->get();
        $words = DB::table('words_smust_users')
            ->get();

        return view('InterestedMoreDetails', compact('asked', 'words'));
    }
}