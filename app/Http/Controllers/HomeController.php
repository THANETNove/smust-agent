<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;






class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
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
                    $dataHomeQuery->where('rent_sell_home_details.property_type', $request->input('property_type'));
                }
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
                if ($request->has('sale_rent')) {
                    $priceRange = $request->input('price_range');

                    // ตรวจสอบประเภทการขายหรือเช่า
                    if ($request->input('sale_rent') == 'sale') {
                        $dataHomeQuery->where(function ($query) {
                            $query->where('rent_sell_home_details.rent_sell', 'ขาย')
                                ->orWhere('rent_sell_home_details.sell', 'ขาย');
                        });

                        if ($request->has('price_range')) {
                            // ตรวจสอบช่วงราคา
                            if (strpos($priceRange, '-') !== false) {
                                // แยกช่วงราคา
                                [$minPrice, $maxPrice] = explode('-', $priceRange);
                                $dataHomeQuery->whereBetween('rent_sell_home_details.sell_price', [$minPrice, $maxPrice]);
                            } elseif ($priceRange == '10000001') {
                                // ราคาเกิน 10 ล้าน
                                $dataHomeQuery->where('rent_sell_home_details.sell_price', '>', 10000000);
                            } else {
                                // น้อยกว่า 10,000 บาท
                                $dataHomeQuery->where('rent_sell_home_details.sell_price', '<', 10000);
                            }
                        }
                    } elseif ($request->input('sale_rent') == 'rent') {
                        $dataHomeQuery->where(function ($query) {
                            $query->where('rent_sell_home_details.rent_sell', 'เช่า')
                                ->orWhere('rent_sell_home_details.sell', 'เช่า');
                        });


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
                        // การเช่าจะทำงานแบบเดียวกันกับการขาย

                    } else {
                        // กรณีเลือกทั้งการขายและเช่า
                        if ($request->has('price_range')) {
                            if (strpos($priceRange, '-') !== false) {
                                [$minPrice, $maxPrice] = explode('-', $priceRange);
                                $dataHomeQuery->whereBetween('rent_sell_home_details.sell_price', [$minPrice, $maxPrice])
                                    ->orWhereBetween('rent_sell_home_details.rental_price', [$minPrice, $maxPrice]);
                            } elseif ($priceRange == '10000001') {
                                // เกิน 10 ล้าน
                                $dataHomeQuery->where('rent_sell_home_details.sell_price', '>', 10000000)
                                    ->orWhere('rent_sell_home_details.rental_price', '>', 10000000);
                            } else {
                                // น้อยกว่า 10,000 บาท
                                $dataHomeQuery->where('rent_sell_home_details.sell_price', '<', 10000)
                                    ->orWhere('rent_sell_home_details.rental_price', '<', 10000);
                            }
                        }
                    }
                }

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
                $dataHomeQuery->orderBy('rent_sell_home_details.id', 'DESC');
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



        // dd($request->all());

        // Apply authorization logic if needed
        $user = Auth::user();
        //$dataHomeQuery->where('code_admin', $user->code_admin);

        // Use caching if possible for better performance
        $dataCount = Cache::remember('dataHomeCount_with_code_admin', 0, function () use ($dataHomeQuery) {
            return (clone $dataHomeQuery)->whereNotNull('code_admin')->count();
        });

        $dataCount2 = Cache::remember('dataHomeCount_without_code_admin', 0, function () use ($dataHomeQuery) {
            return (clone $dataHomeQuery)->whereNull('code_admin')->count();
        });
        // Separate cache keys for dataHome and dataHome2 using the same base query
        $dataHome = Cache::remember('dataHomePage_with_code_admin', 0, function () use ($dataHomeQuery) {
            return (clone $dataHomeQuery)->whereNotNull('code_admin')->paginate(100)->appends(request()->all());
        });

        $dataHome2 = Cache::remember('dataHomePage_without_code_admin', 0, function () use ($dataHomeQuery) {
            return (clone $dataHomeQuery)->whereNull('code_admin')->paginate(100)->appends(request()->all());
        });

        // Cache provinces and train station data
        $data = Cache::remember('provincesData', 0, function () {
            return DB::table('provinces')->orderBy('name_th', 'ASC')->get();
        });

        $train_station = Cache::remember('trainStationData', 0, function () {
            return DB::table('train_station')
                ->select('train_station.id', 'train_station.station_name_th')
                ->orderBy('station_name_th', 'ASC')
                ->get();
        });



        return view('home', [
            'train_station' => $train_station,
            'data' => $data,
            'dataHome' => $dataHome,
            'dataHome2' => $dataHome2,
            'dataCount' => $dataCount,
            'dataCount2' =>  $dataCount2
        ]);
    }



    public function indexFavorites()
    {

        // Create base query
        $dataHomeQuery = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.status_home', 'on')
            ->where('rent_sell_home_details.user_id', Auth::user()->id)
            ->join('provinces', 'rent_sell_home_details.provinces', '=', 'provinces.id')
            ->join('amphures', 'rent_sell_home_details.districts', '=', 'amphures.id')
            ->join('districts', 'rent_sell_home_details.amphures', '=', 'districts.id')
            ->join('favorites', 'rent_sell_home_details.id', '=', 'favorites.id_product')
            ->select(
                'rent_sell_home_details.*',
                'provinces.name_th AS provinces_name_th',
                'districts.name_th AS districts_name_th',
                'amphures.name_th AS amphures_name_th'
            )->orderBy('rent_sell_home_details.id', 'DESC');



        // dd($request->all());

        // Apply authorization logic if needed
        $user = Auth::user();
        //$dataHomeQuery->where('code_admin', $user->code_admin);

        // Use caching if possible for better performance
        $dataCount = Cache::remember('dataHomeCount_with_code_admin', 0, function () use ($dataHomeQuery) {
            return (clone $dataHomeQuery)->whereNotNull('code_admin')->count();
        });

        $dataCount2 = Cache::remember('dataHomeCount_without_code_admin', 0, function () use ($dataHomeQuery) {
            return (clone $dataHomeQuery)->whereNull('code_admin')->count();
        });
        // Separate cache keys for dataHome and dataHome2 using the same base query
        $dataHome = Cache::remember('dataHomePage_with_code_admin', 0, function () use ($dataHomeQuery) {
            return (clone $dataHomeQuery)->whereNotNull('code_admin')->paginate(100)->appends(request()->all());
        });

        $dataHome2 = Cache::remember('dataHomePage_without_code_admin', 0, function () use ($dataHomeQuery) {
            return (clone $dataHomeQuery)->whereNull('code_admin')->paginate(100)->appends(request()->all());
        });

        // Cache provinces and train station data
        $data = Cache::remember('provincesData', 0, function () {
            return DB::table('provinces')->orderBy('name_th', 'ASC')->get();
        });

        $train_station = Cache::remember('trainStationData', 0, function () {
            return DB::table('train_station')
                ->select('train_station.id', 'train_station.station_name_th')
                ->orderBy('station_name_th', 'ASC')
                ->get();
        });



        return view('home', [
            'train_station' => $train_station,
            'data' => $data,
            'dataHome' => $dataHome,
            'dataHome2' => $dataHome2,
            'dataCount' => $dataCount,
            'dataCount2' =>  $dataCount2
        ]);
    }
    public function indexName(Request $request)
    {
        $search = $request->input('search_name'); // รับค่าที่ผู้ใช้พิมพ์
        // Create base query
        $dataHomeQuery = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.status_home', 'on')
            ->where('rent_sell_home_details.building_name', 'LIKE', "%$search%")
            ->join('provinces', 'rent_sell_home_details.provinces', '=', 'provinces.id')
            ->join('amphures', 'rent_sell_home_details.districts', '=', 'amphures.id')
            ->join('districts', 'rent_sell_home_details.amphures', '=', 'districts.id')
            ->select(
                'rent_sell_home_details.*',
                'provinces.name_th AS provinces_name_th',
                'districts.name_th AS districts_name_th',
                'amphures.name_th AS amphures_name_th'
            )->orderBy('rent_sell_home_details.id', 'DESC');



        // dd($request->all());

        // Apply authorization logic if needed
        $user = Auth::user();
        //$dataHomeQuery->where('code_admin', $user->code_admin);

        // Use caching if possible for better performance
        $dataCount = Cache::remember('dataHomeCount_with_code_admin', 0, function () use ($dataHomeQuery) {
            return (clone $dataHomeQuery)->whereNotNull('code_admin')->count();
        });

        $dataCount2 = Cache::remember('dataHomeCount_without_code_admin', 0, function () use ($dataHomeQuery) {
            return (clone $dataHomeQuery)->whereNull('code_admin')->count();
        });
        // Separate cache keys for dataHome and dataHome2 using the same base query
        $dataHome = Cache::remember('dataHomePage_with_code_admin', 0, function () use ($dataHomeQuery) {
            return (clone $dataHomeQuery)->whereNotNull('code_admin')->paginate(100)->appends(request()->all());
        });

        $dataHome2 = Cache::remember('dataHomePage_without_code_admin', 0, function () use ($dataHomeQuery) {
            return (clone $dataHomeQuery)->whereNull('code_admin')->paginate(100)->appends(request()->all());
        });

        // Cache provinces and train station data
        $data = Cache::remember('provincesData', 0, function () {
            return DB::table('provinces')->orderBy('name_th', 'ASC')->get();
        });

        $train_station = Cache::remember('trainStationData', 0, function () {
            return DB::table('train_station')
                ->select('train_station.id', 'train_station.station_name_th')
                ->orderBy('station_name_th', 'ASC')
                ->get();
        });



        return view('home', [
            'train_station' => $train_station,
            'data' => $data,
            'dataHome' => $dataHome,
            'dataHome2' => $dataHome2,
            'dataCount' => $dataCount,
            'dataCount2' =>  $dataCount2
        ]);
    }

    public function indexSearchData(Request $request)
    {



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

        // Apply authorization logic
        $user = Auth::user();
        $dataHomeQuery->where('code_admin', $user->code_admin);

        // Apply search filters


        $dataHomeQuery->orderBy('rent_sell_home_details.id', 'DESC');

        // Use caching if possible for better performance
        $dataCount = Cache::remember('dataHomeCount', 0, function () use ($dataHomeQuery) {
            return $dataHomeQuery->count();
        });

        $dataHome = Cache::remember('dataHomePage', 0, function () use ($dataHomeQuery, $request) {
            $searchProperty_type = $request->input('property_type');
            $searchRent_sell = $request->input('rent_sell');
            $searchProvinces = $request->input('provinces');
            $searchAmphures = $request->input('amphures');
            $searchDistricts = $request->input('districts');
            $trainName = $request->input('train_name');

            if ($trainName) {
                $dataHomeQuery->where('rent_sell_home_details.train_name', 'LIKE', "%$trainName%");
            } else {
                if ($searchProperty_type) {
                    $dataHomeQuery->where('rent_sell_home_details.property_type', $searchProperty_type);
                }
                if ($searchRent_sell) {
                    $dataHomeQuery->where('rent_sell_home_details.rent_sell', $searchRent_sell);
                }
                if ($searchProvinces) {
                    $dataHomeQuery->where('rent_sell_home_details.provinces', $searchProvinces);
                }
                if ($searchAmphures) {
                    $dataHomeQuery->where('rent_sell_home_details.amphures', $searchAmphures);
                }
                if ($searchDistricts) {
                    $dataHomeQuery->where('rent_sell_home_details.districts', $searchDistricts);
                }
            }
            return $dataHomeQuery->paginate(100)->appends($request->all());
        });

        $data = Cache::remember('provincesData', 0, function () {
            return DB::table('provinces')->orderBy('name_th', 'ASC')->get();
        });

        $train_station = Cache::remember('trainStationData', 0, function () {
            return DB::table('train_station')
                ->select('train_station.id', 'train_station.station_name_th')
                ->orderBy('station_name_th', 'ASC')
                ->get();
        });

        return view('home', [
            'train_station' => $train_station,
            'data' => $data,
            'dataHome' => $dataHome,
            'dataCount' => $dataCount
        ]);
    }



    public function show($id)
    {
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



        return view('detall.detall', ['dataHome' => $dataHome]);
    }
}