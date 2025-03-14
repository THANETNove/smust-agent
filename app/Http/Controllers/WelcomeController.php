<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;


use App\Models\Province;
use App\Models\Amphure;
use App\Models\District;

class WelcomeController extends Controller
{
    function houseCondo(Request $request)
    {

        $search = $request->input('search_name');
        // Create base query
        /* $dataHomeQuery = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.status_home', 'on')
            ->join('provinces', 'rent_sell_home_details.provinces', '=', 'provinces.id')
            ->join('amphures', 'rent_sell_home_details.districts', '=', 'amphures.id')
            ->join('districts', 'rent_sell_home_details.amphures', '=', 'districts.id')
            ->select(
                'rent_sell_home_details.*',
                'provinces.name_th AS provinces_name_th',
                'districts.name_th AS districts_name_th',
                'amphures.name_th AS amphures_name_th'
            ); */

        $provinces = Cache::remember('provinces', 60 * 60, function () {
            return DB::table('provinces')->pluck('name_th', 'id');
        });

        $amphures = Cache::remember('amphures', 60 * 60, function () {
            return DB::table('amphures')->pluck('name_th', 'id');
        });

        $districts = Cache::remember('districts', 60 * 60, function () {
            return DB::table('districts')->pluck('name_th', 'id');
        });

        $dataHomeQuery = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.building_name', 'LIKE', "%$search%")
            ->where('status_home', 'on');



        //  dd($request->all());
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
                $priceRange = $request->input('price_range');
                if (strpos($priceRange, '-') !== false) {
                    [$minPrice, $maxPrice] = explode('-', $priceRange);

                    $dataHomeQuery->where(function ($query) use ($minPrice, $maxPrice) {
                        $query->whereBetween('rent_sell_home_details.rent_sell', [$minPrice, $maxPrice])
                            ->orWhereBetween('rent_sell_home_details.rental_price', [$minPrice, $maxPrice]);
                    });
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

        $weData = $dataHomeQuery
            ->orderBy('id', 'DESC')
            ->paginate(100);

        // ตรวจสอบว่า $weData เป็น Instance ของ Paginator
        if ($weData instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            $weData->getCollection()->transform(function ($item) use ($provinces, $amphures, $districts) {
                $item->provinces_name_th = $provinces[$item->provinces] ?? null;
                $item->amphures_name_th = $amphures[$item->amphures] ?? null;
                $item->districts_name_th = $districts[$item->districts] ?? null;
                return $item;
            });
        } else {
            // กรณีที่ $weData ไม่ใช่ Paginator อาจต้องแสดงข้อความหรือจัดการข้อมูล
            dd("The data is not paginated.");
        }



        // เพิ่ม Query String สำหรับ Pagination
        $weData->appends($request->except('page'));



        $request = $request->all();


        return view('house_condo', compact('weData', 'request'));
    }
    function houseCondoDetails($id)
    {


        $provinces = Cache::remember('provinces', 60 * 60, function () {
            return DB::table('provinces')->pluck('name_th', 'id');
        });

        $amphures = Cache::remember('amphures', 60 * 60, function () {
            return DB::table('amphures')->pluck('name_th', 'id');
        });

        $districts = Cache::remember('districts', 60 * 60, function () {
            return DB::table('districts')->pluck('name_th', 'id');
        });

        $dataHomeQuery = DB::table('rent_sell_home_details')
            ->where('status_home', 'on');


        // Create base query
        $dataHome = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.id', $id)

            ->select(
                'rent_sell_home_details.*'
            )
            ->orderBy('rent_sell_home_details.id', 'DESC')
            ->get()
            ->map(function ($item) use ($provinces, $amphures, $districts) {
                $item->provinces_name_th = $provinces[$item->provinces] ?? null;
                $item->amphures_name_th = $amphures[$item->amphures] ?? null;
                $item->districts_name_th = $districts[$item->districts] ?? null;
                return $item;
            });

        $welcomeQuery = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.status_home', 'on')
            ->where('rent_sell_home_details.provinces', $dataHome[0]->provinces)
            ->select(
                'rent_sell_home_details.*'
            )
            ->orderBy('rent_sell_home_details.id', 'DESC')
            ->limit(13) // จำกัดผลลัพธ์เป็น 12 รายการ
            ->get()
            ->map(function ($item) use ($provinces, $amphures, $districts) {
                $item->provinces_name_th = $provinces[$item->provinces] ?? null;
                $item->amphures_name_th = $amphures[$item->amphures] ?? null;
                $item->districts_name_th = $districts[$item->districts] ?? null;
                return $item;
            });

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



            // กรณีใช้เงื่อนไขแบบ or แต่ไม่เอา id ที่มีอยู่ใน $userQuery1 มาแสดง
            $userQuery = (clone $userQuery)
                ->where(function ($query) use ($request) {
                    // ตรวจสอบและเพิ่มเงื่อนไขทีละตัว
                    if (!empty($request->sale_rent)) {
                        $query->orWhere('users.contract_type', 'LIKE', "%$request->sale_rent%");
                    }
                    if (!empty($request->property_type)) {
                        $query->orWhere('users.property_type', 'LIKE', "%$request->property_type%");
                    }
                    if (!empty($request->province)) {
                        $query->orWhere('users.provinces', 'LIKE', "%$request->province%");
                    }
                    if (!empty($request->characteristics)) {
                        $query->orWhere('users.characteristics', 'LIKE', "%$request->characteristics%");
                    }
                })
                ->get();


            $statusShow = true;
            $sale_rent = $request->sale_rent;
            $property_type = $request->property_type;
            $province =  $request->province;
            $characteristics = $request->characteristics;
        } else {

            $userQuery = (clone $userQuery)->orderBy('plans', 'DESC')
                ->get();
            $statusShow = false;
            $sale_rent = null;
            $property_type = null;
            $province =  null;
            $characteristics = null;
        }


        return view('contactPremiumAll', compact('userQuery', 'provincesQuery',  'statusShow', 'sale_rent', 'property_type', 'province', 'characteristics'));
    }
    function premiumAgentHome($id)
    {

        $userQuery = DB::table('users')
            ->where('users.id', $id)
            ->leftJoin('personal_websites', 'users.id', '=', 'personal_websites.user_id')
            ->select(
                'users.*',
                'personal_websites.imageHade',
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



        $provinces = Cache::remember('provinces', 60 * 60, function () {
            return DB::table('provinces')->pluck('name_th', 'id');
        });

        $amphures = Cache::remember('amphures', 60 * 60, function () {
            return DB::table('amphures')->pluck('name_th', 'id');
        });

        $districts = Cache::remember('districts', 60 * 60, function () {
            return DB::table('districts')->pluck('name_th', 'id');
        });

        $userId = DB::table('users')->where('code', $userQuery[0]->code)->value('id');
        $favoritesProductIds = DB::table('favorites')
            ->where('status_favorites', 1)
            ->where('user_id', $userId)
            ->pluck('id_product') // ดึงแค่ค่า id_product
            ->toArray(); // แปลงเป็น array


        $welcomeQuery = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.status_home', 'on')
            ->where(function ($query) use ($favoritesProductIds, $userQuery) {
                if (!empty($favoritesProductIds)) {
                    // ดึงเฉพาะรายการที่อยู่ใน Favorites
                    $query->whereIn('rent_sell_home_details.id', $favoritesProductIds);
                }

                if (!empty($userQuery[0]->code)) {
                    // กรอง ID ที่อยู่ใน Favorites ออก ก่อนดึงรายการที่มี code_admin ตรงกัน
                    $query->orWhere(function ($subQuery) use ($favoritesProductIds, $userQuery) {
                        $subQuery->where('rent_sell_home_details.code_admin', $userQuery[0]->code);

                        if (!empty($favoritesProductIds)) {
                            $subQuery->whereNotIn('rent_sell_home_details.id', $favoritesProductIds);
                        }
                    });
                }
            })
            ->select(
                'rent_sell_home_details.*'
            )
            ->orderBy('rent_sell_home_details.id', 'DESC')
            ->limit(13) // จำกัดผลลัพธ์เป็น 12 รายการ
            ->get()
            ->map(function ($item) use ($provinces, $amphures, $districts) {
                $item->provinces_name_th = $provinces[$item->provinces] ?? null;
                $item->amphures_name_th = $amphures[$item->amphures] ?? null;
                $item->districts_name_th = $districts[$item->districts] ?? null;
                return $item;
            });






        // นับเฉพาะรายการที่มี id_product อยู่ใน favorites



        $countSellQuery = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.code_admin', $userQuery[0]->code)
            ->where('rent_sell_home_details.status_home', 'on')
            ->where(function ($query) {
                $query->where('rent_sell_home_details.rent_sell', "ขาย")
                    ->orWhere('rent_sell_home_details.sell', "ขาย");
            })
            ->when(!empty($favoritesProductIds), function ($query) use ($favoritesProductIds) {
                return $query->whereNotIn('rent_sell_home_details.id', $favoritesProductIds);
            }) // เอา ID ที่อยู่ใน Favorites ออกไป
            ->count();

        $countSellQueryFavorites = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.status_home', 'on')
            ->where(function ($query) {
                $query->where('rent_sell_home_details.rent_sell', "ขาย")
                    ->orWhere('rent_sell_home_details.sell', "ขาย");
            })
            ->whereIn('rent_sell_home_details.id', $favoritesProductIds) // เช็คว่ามีอยู่ใน favorites หรือไม่
            ->count();

        $countRentQuery = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.code_admin', $userQuery[0]->code)
            ->where('rent_sell_home_details.status_home', 'on')
            ->where(function ($query) {
                $query->where('rent_sell_home_details.rent_sell', "เช่า")
                    ->orWhere('rent_sell_home_details.rent', "เช่า");
            })
            ->when(!empty($favoritesProductIds), function ($query) use ($favoritesProductIds) {
                return $query->whereNotIn('rent_sell_home_details.id', $favoritesProductIds);
            }) // เอา ID ที่อยู่ใน Favorites ออกไป
            ->count();
        $countRentQueryFavorites = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.status_home', 'on')
            ->where(function ($query) {
                $query->where('rent_sell_home_details.rent_sell', "เช่า")
                    ->orWhere('rent_sell_home_details.rent', "เช่า");
            })
            ->whereIn('rent_sell_home_details.id', $favoritesProductIds) // เช็คว่ามีอยู่ใน favorites หรือไม่
            ->count();

        $countSellRentQuery = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.code_admin', $userQuery[0]->code)
            ->where('rent_sell_home_details.status_home', 'on')
            ->where(function ($query) {
                $query->where('rent_sell_home_details.rent_sell', "เช่าซื้อ/ขายผ่อน")
                    ->orWhere('rent_sell_home_details.rent_sell', "เช่า/ขาย");
            })
            ->when(!empty($favoritesProductIds), function ($query) use ($favoritesProductIds) {
                return $query->whereNotIn('rent_sell_home_details.id', $favoritesProductIds);
            }) // เอา ID ที่อยู่ใน Favorites ออกไป
            ->count();

        $countSellRentQueryFavorites = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.status_home', 'on')
            ->where(function ($query) {
                $query->where('rent_sell_home_details.rent_sell', "เช่าซื้อ/ขายผ่อน")
                    ->orWhere('rent_sell_home_details.rent_sell', "เช่า/ขาย");
            })
            ->whereIn('rent_sell_home_details.id', $favoritesProductIds) // เช็คว่ามีอยู่ใน favorites หรือไม่
            ->count();

        $countRent =  $countRentQuery + $countSellRentQuery + $countRentQueryFavorites + $countSellRentQueryFavorites;
        $countSell =  $countSellQuery + $countSellRentQuery + $countSellQueryFavorites + $countSellRentQueryFavorites;

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
                'personal_websites.imageHade',
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
        $provinces = Cache::remember('provinces', 60 * 60, function () {
            return DB::table('provinces')->pluck('name_th', 'id');
        });

        $amphures = Cache::remember('amphures', 60 * 60, function () {
            return DB::table('amphures')->pluck('name_th', 'id');
        });

        $districts = Cache::remember('districts', 60 * 60, function () {
            return DB::table('districts')->pluck('name_th', 'id');
        });

        $userId = DB::table('users')->where('code', $userQuery[0]->code)->value('id');
        $favoritesProductIds = DB::table('favorites')
            ->where('status_favorites', 1)
            ->where('user_id', $userId)
            ->pluck('id_product')
            ->toArray(); // แปลงเป็น array

        $welcomeQuery = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.status_home', 'on')
            ->where(function ($query) use ($favoritesProductIds, $userQuery) {
                if (!empty($favoritesProductIds)) {
                    // ดึงเฉพาะรายการที่อยู่ใน Favorites
                    $query->whereIn('rent_sell_home_details.id', $favoritesProductIds);
                }

                if (!empty($userQuery[0]->code)) {
                    // กรอง ID ที่อยู่ใน Favorites ออก ก่อนดึงรายการที่มี code_admin ตรงกัน
                    $query->orWhere(function ($subQuery) use ($favoritesProductIds, $userQuery) {
                        $subQuery->where('rent_sell_home_details.code_admin', $userQuery[0]->code);

                        if (!empty($favoritesProductIds)) {
                            $subQuery->whereNotIn('rent_sell_home_details.id', $favoritesProductIds);
                        }
                    });
                }
            })
            ->select('rent_sell_home_details.*')
            ->orderBy('rent_sell_home_details.id', 'DESC')
            ->paginate(100);




        if ($welcomeQuery instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            $welcomeQuery->getCollection()->transform(function ($item) use ($provinces, $amphures, $districts) {
                $item->provinces_name_th = $provinces[$item->provinces] ?? null;
                $item->amphures_name_th = $amphures[$item->amphures] ?? null;
                $item->districts_name_th = $districts[$item->districts] ?? null;
                return $item;
            });
        } else {
            dd("The data for status_admin = 0 is not paginated.");
        }



        return view('viewAllAssets', compact('userQuery', 'welcomeQuery', 'id'));
    }


    function viewAllAssetsId(Request $request)
    {


        $userQuery = DB::table('users')
            ->where('users.id', $request->id)
            ->leftJoin('personal_websites', 'users.id', '=', 'personal_websites.user_id')
            ->select(
                'users.*',
                'personal_websites.history_work',
                'personal_websites.imageHade',
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
        $provinces = Cache::remember('provinces', 60 * 60, function () {
            return DB::table('provinces')->pluck('name_th', 'id');
        });

        $amphures = Cache::remember('amphures', 60 * 60, function () {
            return DB::table('amphures')->pluck('name_th', 'id');
        });

        $districts = Cache::remember('districts', 60 * 60, function () {
            return DB::table('districts')->pluck('name_th', 'id');
        });

        $userId = DB::table('users')->where('code', $userQuery[0]->code)->value('id');
        $favoritesProductIds = DB::table('favorites')
            ->where('status_favorites', 1)
            ->where('user_id', $userId)
            ->pluck('id_product')
            ->toArray(); // แปลงเป็น array

        $welcomeQuery = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.status_home', 'on')
            ->when(!empty($favoritesProductIds), function ($query) use ($favoritesProductIds) {
                return $query->whereIn('rent_sell_home_details.id', $favoritesProductIds);
            }, function ($query) use ($userQuery) {
                return $query->where('rent_sell_home_details.code_admin', $userQuery[0]->code);
            })
            ->select('rent_sell_home_details.*');

        if ($request->all()) {

            //! คันหา
            if ($request->area_station == 'area' || $request->area_station == 'station') {

                if ($request->area_station == 'area') {

                    if ($request->has('provinces')) {
                        $welcomeQuery->where('rent_sell_home_details.provinces', $request->input('provinces'));
                    }
                    if ($request->has('amphures')) {
                        $welcomeQuery->where('rent_sell_home_details.amphures', $request->input('amphures'));
                    }
                    if ($request->has('districts')) {
                        $welcomeQuery->where('rent_sell_home_details.districts', $request->input('districts'));
                    }
                } else {
                    if ($request->has('stations')) {

                        $welcomeQuery->where('rent_sell_home_details.train_name', $request->input('stations'));
                    }
                }

                if ($request->has('property_type')) {
                    $typeName =   $request->input('property_type');
                    $welcomeQuery->where('rent_sell_home_details.property_type',   'LIKE', "%$typeName%");
                }

                if ($request->has('sale_rent')) {

                    $priceRange = $request->input('price_range');

                    // ตรวจสอบประเภทการขายหรือเช่า
                    if ($request->input('sale_rent') == 'sale') {

                        $welcomeQuery->where(function ($query) {
                            $nameSale = "ขาย";
                            $query->where('rent_sell_home_details.rent_sell',   'LIKE', "%$nameSale%")
                                ->orWhere('rent_sell_home_details.sell', 'LIKE', "%$nameSale%");
                        });
                    } elseif ($request->input('sale_rent') == 'rent') {
                        $welcomeQuery->where(function ($query) {

                            $nameRent = "เช่า";
                            $query->where('rent_sell_home_details.rent_sell', 'LIKE', "%$nameRent%")
                                ->orWhere('rent_sell_home_details.sell', 'LIKE', "%$nameRent%");
                        });
                    } else {
                        // กรณีเลือกทั้งการขายและเช่า
                        if ($request->has('price_range')) {
                            if (strpos($priceRange, '-') !== false) {
                                [$minPrice, $maxPrice] = explode('-', $priceRange);
                                $welcomeQuery->whereBetween('rent_sell_home_details.sell_price', [$minPrice, $maxPrice])
                                    ->orWhereBetween('rent_sell_home_details.rental_price', [$minPrice, $maxPrice]);
                            }
                        }
                    }
                }
                $welcomeQuery->orderBy('rent_sell_home_details.id', 'DESC');
            }
        }




        $welcomeQuery = $welcomeQuery->orderBy('rent_sell_home_details.id', 'DESC')
            ->paginate(100);

        if ($welcomeQuery instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            $welcomeQuery->getCollection()->transform(function ($item) use ($provinces, $amphures, $districts) {
                $item->provinces_name_th = $provinces[$item->provinces] ?? null;
                $item->amphures_name_th = $amphures[$item->amphures] ?? null;
                $item->districts_name_th = $districts[$item->districts] ?? null;
                return $item;
            });
        } else {
            dd("The data for status_admin = 0 is not paginated.");
        }

        $welcomeQuery = $welcomeQuery->appends($request->except('page'));
        $id =   $request->id;

        $request = $request->all();

        return view('viewAllAssets', compact('userQuery', 'welcomeQuery', 'id', 'request'));
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
