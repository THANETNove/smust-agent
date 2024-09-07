<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;




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
            )
            ->orderBy('rent_sell_home_details.id', 'DESC');

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
            return (clone $dataHomeQuery)->whereNotNull('code_admin')->paginate(100);
        });

        $dataHome2 = Cache::remember('dataHomePage_without_code_admin', 0, function () use ($dataHomeQuery) {
            return (clone $dataHomeQuery)->whereNull('code_admin')->paginate(100);
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