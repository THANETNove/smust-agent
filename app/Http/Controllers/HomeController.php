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
            ->where('status_home', 'on');


        if ($request->all()) {
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
                    $typeName = $request->input('property_type');
                    $dataHomeQuery->where('rent_sell_home_details.property_type', 'LIKE', "%$typeName%");
                }
                if ($request->has('usable_area')) {
                    $usableArea = $request->input('usable_area');
                    if ($usableArea) {
                        if ($usableArea === '29') {
                            $dataHomeQuery->where('rent_sell_home_details.room_width', '<', 30);
                        } elseif ($usableArea === '30-50') {
                            $dataHomeQuery->whereBetween('rent_sell_home_details.room_width', [30, 50]);
                        } elseif ($usableArea === '50-100') {
                            $dataHomeQuery->whereBetween('rent_sell_home_details.room_width', [50, 100]);
                        } elseif ($usableArea === '100-1000') {
                            $dataHomeQuery->whereBetween('rent_sell_home_details.room_width', [100, 1000]);
                        } elseif ($usableArea === '1000-5000') {
                            $dataHomeQuery->whereBetween('rent_sell_home_details.room_width', [1000, 5000]);
                        } elseif ($usableArea === '5001') {
                            $dataHomeQuery->where('rent_sell_home_details.room_width', '>', 5000);
                        }
                    }
                }
                if ($request->has('sale_rent')) {
                    $priceRange = $request->input('price_range');

                    if ($request->input('sale_rent') == 'sale') {
                        $dataHomeQuery->where(function ($query) {
                            $nameSale = "ขาย";
                            $query->where('rent_sell_home_details.rent_sell', 'LIKE', "%$nameSale%")
                                ->orWhere('rent_sell_home_details.sell', 'LIKE', "%$nameSale%");
                        });

                        if ($request->has('price_range')) {
                            if (strpos($priceRange, '-') !== false) {
                                [$minPrice, $maxPrice] = explode('-', $priceRange);
                                $dataHomeQuery->whereBetween('rent_sell_home_details.sell_price', [$minPrice, $maxPrice]);
                            } elseif ($priceRange == '10000001') {
                                $dataHomeQuery->where('rent_sell_home_details.sell_price', '>', 10000000);
                            } else {
                                $dataHomeQuery->where('rent_sell_home_details.sell_price', '<', 10000);
                            }
                        }
                    } elseif ($request->input('sale_rent') == 'rent') {
                        $dataHomeQuery->where(function ($query) {
                            $nameRent = "เช่า";
                            $query->where('rent_sell_home_details.rent_sell', 'LIKE', "%$nameRent%")
                                ->orWhere('rent_sell_home_details.sell', 'LIKE', "%$nameRent%");
                        });

                        if ($request->has('price_range')) {
                            if (strpos($priceRange, '-') !== false) {
                                [$minPrice, $maxPrice] = explode('-', $priceRange);
                                $dataHomeQuery->whereBetween('rent_sell_home_details.rental_price', [$minPrice, $maxPrice]);
                            } elseif ($priceRange == '10000001') {
                                $dataHomeQuery->where('rent_sell_home_details.rental_price', '>', 10000000);
                            } else {
                                $dataHomeQuery->where('rent_sell_home_details.rental_price', '<', 10000);
                            }
                        }
                    } else {
                        if ($request->has('price_range')) {
                            if (strpos($priceRange, '-') !== false) {
                                [$minPrice, $maxPrice] = explode('-', $priceRange);
                                $dataHomeQuery->whereBetween('rent_sell_home_details.sell_price', [$minPrice, $maxPrice])
                                    ->orWhereBetween('rent_sell_home_details.rental_price', [$minPrice, $maxPrice]);
                            } elseif ($priceRange == '10000001') {
                                $dataHomeQuery->where('rent_sell_home_details.sell_price', '>', 10000000)
                                    ->orWhere('rent_sell_home_details.rental_price', '>', 10000000);
                            } else {
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
                            $dataHomeQuery->whereDate('rent_sell_home_details.created_at', Carbon::today());
                            break;
                        case '2':
                            $dataHomeQuery->whereBetween('rent_sell_home_details.created_at', [Carbon::now()->startOfWeek(), Carbon::now()]);
                            break;
                        case '3':
                            $dataHomeQuery->whereBetween('rent_sell_home_details.created_at', [Carbon::now()->startOfMonth(), Carbon::now()]);
                            break;
                        case '4':
                            $dataHomeQuery->whereBetween('rent_sell_home_details.created_at', [Carbon::now()->subMonths(6), Carbon::now()]);
                            break;
                        case '5':
                            $dataHomeQuery->where('rent_sell_home_details.created_at', '<', Carbon::now()->subMonths(6));
                            break;
                    }
                }
            }
        } else {

            $dataHomeQuery->orderBy('rent_sell_home_details.id', 'DESC');
        }

        //! จัดเรียงตามน้อย - มาก/ มาก-น้อย
        if ($request->has('too_little')) {
            if ($request->too_little == 'price_min_max') {
                $dataHomeQuery->orderByRaw('
            CASE 
                WHEN COALESCE(GREATEST(rent_sell_home_details.rental_price, rent_sell_home_details.sell_price), 0) > 0 THEN 0
                ELSE 1
            END ASC,
            COALESCE(GREATEST(rent_sell_home_details.rental_price, rent_sell_home_details.sell_price), 0) ASC
        ');
            } elseif ($request->too_little == 'price_max_min') {
                $dataHomeQuery->orderByRaw('
            COALESCE(GREATEST(rent_sell_home_details.rental_price, rent_sell_home_details.sell_price), 0) DESC
        ');
            } elseif ($request->too_little == 'area_min_max') {
                $dataHomeQuery->orderBy('rent_sell_home_details.room_width', 'ASC');
            } elseif ($request->too_little == 'area_max_min') {
                $dataHomeQuery->orderBy('rent_sell_home_details.room_width', 'DESC');
            } elseif ($request->too_little == 'floors_min_max') {
                $dataHomeQuery->orderBy('rent_sell_home_details.number_floors', 'ASC');
            } elseif ($request->too_little == 'floors_max_min') {
                $dataHomeQuery->orderBy('rent_sell_home_details.number_floors', 'DESC');
            }
        }





        // Apply authorization logic if needed
        $user = Auth::user();

        $dataCount = (clone $dataHomeQuery)->where('status_admin', 0)->count();
        $dataCount2 = (clone $dataHomeQuery)->where('status_admin', 1)->count();

        // แยก cache keys สำหรับ $dataHome และ $dataHome2 โดยใช้ query base เดียวกัน
        /*   $dataHome = (clone $dataHomeQuery)->where('status_admin', 0)->paginate(100)->appends(request()->all());
        $dataHome2 = (clone $dataHomeQuery)->where('status_admin', 1)->paginate(100)->appends(request()->all()); */

        // Query สำหรับ status_admin = 0
        $dataHome = (clone $dataHomeQuery)
            ->where('status_admin', 0)
            ->orderBy('id', 'DESC')
            ->paginate(100);

        // Query สำหรับ status_admin = 1
        $dataHome2 = (clone $dataHomeQuery)
            ->where('status_admin', 1)
            ->orderBy('id', 'DESC')
            ->paginate(100);

        // ตรวจสอบและปรับข้อมูลสำหรับ $dataHome
        if ($dataHome instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            $dataHome->getCollection()->transform(function ($item) use ($provinces, $amphures, $districts) {
                $item->provinces_name_th = $provinces[$item->provinces] ?? null;
                $item->amphures_name_th = $amphures[$item->amphures] ?? null;
                $item->districts_name_th = $districts[$item->districts] ?? null;
                return $item;
            });
        } else {
            dd("The data for status_admin = 0 is not paginated.");
        }

        // ตรวจสอบและปรับข้อมูลสำหรับ $dataHome2
        if ($dataHome2 instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            $dataHome2->getCollection()->transform(function ($item) use ($provinces, $amphures, $districts) {
                $item->provinces_name_th = $provinces[$item->provinces] ?? null;
                $item->amphures_name_th = $amphures[$item->amphures] ?? null;
                $item->districts_name_th = $districts[$item->districts] ?? null;
                return $item;
            });
        } else {
            dd("The data for status_admin = 1 is not paginated.");
        }

        // เพิ่ม Query String สำหรับ Pagination
        $dataHome->appends($request->except('page'));
        $dataHome2->appends($request->except('page'));

        // Cache provinces and train station data
        $data = DB::table('provinces')->orderBy('name_th', 'ASC')->get();


        return view('home', [
            'request' => $request->all(),
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
            ->join('provinces', 'rent_sell_home_details.provinces', '=', 'provinces.id')
            ->join('amphures', 'rent_sell_home_details.districts', '=', 'amphures.id')
            ->join('districts', 'rent_sell_home_details.amphures', '=', 'districts.id')
            ->join('favorites', 'rent_sell_home_details.id', '=', 'favorites.id_product')
            ->where('favorites.user_id', Auth::user()->id)
            ->where('favorites.status_favorites', 1)
            ->select(
                'rent_sell_home_details.*',
                'provinces.name_th AS provinces_name_th',
                'districts.name_th AS districts_name_th',
                'amphures.name_th AS amphures_name_th',
                'favorites.id as favoritesId'
            )->orderBy('favorites.id', 'DESC');

        //dd($dataHomeQuery->get());

        // dd($request->all());

        // Apply authorization logic if needed
        $user = Auth::user();
        //$dataHomeQuery->where('code_admin', $user->code_admin);

        // Use caching if possible for better performance

        $dataCount = (clone $dataHomeQuery)->where('status_admin', 0)->count();
        $dataCount2 = (clone $dataHomeQuery)->where('status_admin', 1)->count();

        // แยก cache keys สำหรับ $dataHome และ $dataHome2 โดยใช้ query base เดียวกัน
        $dataHome = (clone $dataHomeQuery)->where('status_admin', 0)->paginate(100)->appends(request()->all());
        $dataHome2 = (clone $dataHomeQuery)->where('status_admin', 1)->paginate(100)->appends(request()->all());
        // Cache provinces and train station data
        $data = DB::table('provinces')->orderBy('name_th', 'ASC')->get();




        return view('home', [
            'data' => $data,
            'dataHome' => $dataHome,
            'dataHome2' => $dataHome2,
            'dataCount' => $dataCount,
            'dataCount2' =>  $dataCount2,
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

        $dataCount = (clone $dataHomeQuery)->where('status_admin', 0)->count();
        $dataCount2 = (clone $dataHomeQuery)->where('status_admin', 1)->count();

        // แยก cache keys สำหรับ $dataHome และ $dataHome2 โดยใช้ query base เดียวกัน
        $dataHome = (clone $dataHomeQuery)->where('status_admin', 0)->paginate(100)->appends(request()->all());
        $dataHome2 = (clone $dataHomeQuery)->where('status_admin', 1)->paginate(100)->appends(request()->all());
        // Cache provinces and train station data
        $data = DB::table('provinces')->orderBy('name_th', 'ASC')->get();




        return view('home', [

            'data' => $data,
            'dataHome' => $dataHome,
            'dataHome2' => $dataHome2,
            'dataCount' => $dataCount,
            'dataCount2' =>  $dataCount2
        ]);
    }





    public function show($id)
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



        $dataHome = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.id', $id)
            ->select(
                'rent_sell_home_details.*',
            )
            ->orderBy('rent_sell_home_details.id', 'DESC')
            ->get()
            ->map(function ($item) use ($provinces, $amphures, $districts) {
                $item->provinces_name_th = $provinces[$item->provinces] ?? null;
                $item->amphures_name_th = $amphures[$item->amphures] ?? null;
                $item->districts_name_th = $districts[$item->districts] ?? null;
                return $item;
            });


        $user = DB::table('users')
            ->where('code', $dataHome[0]->code_admin)
            ->select(
                'users.line_id',
                'users.facebook_id',
                'users.phone',
            )
            ->first();

        $dataHome = $dataHome->map(function ($item) use ($user) {
            $item->line_id = $user->line_id ?? null;
            $item->facebook_id = $user->facebook_id ?? null;
            $item->phone = $user->phone ?? null;
            return $item;
        });


        return view('detall.detall', ['dataHome' => $dataHome]);
    }



    public function newWealth(Request $request)
    {
        DB::table('rent_sell_home_details')
            ->update(['notifications' => 0]);
        return redirect()->back();
    }
    public function newCoAgent(Request $request)
    {
        DB::table('assets_customers_wants')
            ->update(['notifications' => 0]);
        return redirect()->back();
    }
    public function helpCoAgent(Request $request)
    {
        DB::table('favorites')
            ->where('status_favorites', 1)
            ->update(['status_favorites' => 0]);
        return redirect()->back();
    }
    public function deleteHelpCoAgent(Request $request)
    {
        DB::table('favorites')
            ->where('status_favorites', 2)
            ->update(['status_favorites' => 0]);
        return redirect()->back();
    }
}