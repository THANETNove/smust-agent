<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;


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


         $searchData = count($request->all());
         $searchProperty_type = $request['property_type'];
         $searchRent_sell = $request['rent_sell'];
         $searchProvinces = $request['provinces'];
         $searchAmphures = $request['amphures'];
         $searchDistricts = $request['districts'];
         $trainName = $request['train_name'];


        $dataHome = DB::table('rent_sell_home_details');

        if( Auth::user()->status < 3){ //admin  นายหน้า

            if ($searchData > 0) {



                $dataHome = $dataHome
                            ->where('code_admin', Auth::user()->code_admin)
                            ->where('rent_sell_home_details.status_home', 'on')
                            ->leftJoin('provinces', 'rent_sell_home_details.provinces', '=', 'provinces.id')
                            ->leftJoin('amphures', 'rent_sell_home_details.districts', '=', 'amphures.id')
                            ->leftJoin('districts', 'rent_sell_home_details.amphures', '=', 'districts.id');


                        if ($trainName) {

                            $dataHome->where('rent_sell_home_details.train_name', 'LIKE', "%$trainName%" );
                        }else {

                            if ($searchProperty_type) {
                                $dataHome->where('rent_sell_home_details.property_type', $searchProperty_type);
                            }

                            if ($searchRent_sell) {
                                $dataHome->where('rent_sell_home_details.rent_sell', $searchRent_sell);
                            }

                            if ($searchProvinces) {
                                $dataHome->where('rent_sell_home_details.provinces', $searchProvinces);
                            }

                            if ($searchAmphures) {
                                $dataHome->where('rent_sell_home_details.amphures', $searchAmphures);
                            }

                            if ($searchDistricts) {
                                $dataHome->where('rent_sell_home_details.districts', $searchDistricts);
                            }
                        }

                        $dataHome = $dataHome
                            ->select(
                                'rent_sell_home_details.*',
                                'provinces.name_th AS provinces_name_th',
                                'districts.name_th AS districts_name_th',
                                'amphures.name_th AS amphures_name_th'
                            )
                            ->orderBy('rent_sell_home_details.id', 'DESC');



            }else{

                $dataHome =  $dataHome
                ->where('code_admin', Auth::user()->code_admin)
                ->where('rent_sell_home_details.status_home', 'on')
                ->leftJoin('provinces', 'rent_sell_home_details.provinces', '=', 'provinces.id')
                ->leftJoin('amphures', 'rent_sell_home_details.districts', '=', 'amphures.id') //เขต/ ตำบล
                ->leftJoin('districts', 'rent_sell_home_details.amphures', '=', 'districts.id') //เขต/ อำเภอ
                ->select('rent_sell_home_details.*', 'provinces.name_th AS provinces_name_th',
                'districts.name_th AS districts_name_th' ,'amphures.name_th AS amphures_name_th')
                ->orderBy('rent_sell_home_details.id','DESC');

            }

        }else { // owner

            if ($searchData > 0) {

                $dataHome = $dataHome
                ->where('rent_sell_home_details.status_home', 'on')
                ->where('code_admin', Auth::user()->code_admin)
                ->leftJoin('provinces', 'rent_sell_home_details.provinces', '=', 'provinces.id')
                ->leftJoin('amphures', 'rent_sell_home_details.districts', '=', 'amphures.id')
                ->leftJoin('districts', 'rent_sell_home_details.amphures', '=', 'districts.id');


            if ($trainName) {

                $dataHome->where('rent_sell_home_details.train_name', 'LIKE', "%$trainName%" );
            }else{

                if ($searchProperty_type) {
                    $dataHome->where('rent_sell_home_details.property_type', $searchProperty_type);
                }

                if ($searchRent_sell) {
                    $dataHome->where('rent_sell_home_details.rent_sell', $searchRent_sell);
                }

                if ($searchProvinces) {
                    $dataHome->where('rent_sell_home_details.provinces', $searchProvinces);
                }

                if ($searchAmphures) {
                    $dataHome->where('rent_sell_home_details.amphures', $searchAmphures);
                }

                if ($searchDistricts) {
                    $dataHome->where('rent_sell_home_details.districts', $searchDistricts);
                }
            }

            $dataHome = $dataHome
                ->select(
                    'rent_sell_home_details.*',
                    'provinces.name_th AS provinces_name_th',
                    'districts.name_th AS districts_name_th',
                    'amphures.name_th AS amphures_name_th'
                )
                ->orderBy('rent_sell_home_details.id', 'DESC');

            }else{


                $dataHome =  $dataHome
                ->where('rent_sell_home_details.status_home', 'on')
                ->where('code_admin', Auth::user()->code_admin)
                ->leftJoin('provinces', 'rent_sell_home_details.provinces', '=', 'provinces.id')
                ->leftJoin('amphures', 'rent_sell_home_details.districts', '=', 'amphures.id') //เขต/ ตำบล
                ->leftJoin('districts', 'rent_sell_home_details.amphures', '=', 'districts.id') //เขต/ อำเภอ
                ->select('rent_sell_home_details.*', 'provinces.name_th AS provinces_name_th',
                 'districts.name_th AS districts_name_th' ,'amphures.name_th AS amphures_name_th')
                 ->orderBy('rent_sell_home_details.id','DESC');

            }


        }
        $dataCount =  $dataHome->count();
        $dataHome =  $dataHome->paginate(100);

        $data = DB::table('provinces')->orderBy('name_th','ASC')->get();

        $train_station = DB::table('train_station')->select('train_station.id', 'train_station.station_name_th')
        ->orderBy('station_name_th','ASC')->get();


        return view('home',['train_station' => $train_station, "data" =>  $data , 'dataHome' => $dataHome,'dataCount' => $dataCount]);
    }

    public function districts($id)
    {

        $data = DB::table('amphures')
        ->where('amphures.province_id',$id)
        ->orderBy('name_th','ASC')
        ->get();

        return response()->json($data);

    }
    public function amphures($id)
    {


        $data = DB::table('districts')
        ->where('amphure_id', $id)
        ->orderBy('name_th','ASC')
        ->get();

        return response()->json($data);

    }
    public function show($id)
    {
        $dataHome = DB::table('rent_sell_home_details')
        ->where('rent_sell_home_details.id', $id)
        ->leftJoin('provinces', 'rent_sell_home_details.provinces', '=', 'provinces.id')
        ->leftJoin('amphures', 'rent_sell_home_details.districts', '=', 'amphures.id') //เขต/ ตำบล
        ->leftJoin('districts', 'rent_sell_home_details.amphures', '=', 'districts.id') //เขต/ อำเภอ
        ->select('rent_sell_home_details.*', 'provinces.name_th AS provinces_name_th',
        'districts.name_th AS districts_name_th' ,'amphures.name_th AS amphures_name_th')
        ->orderBy('rent_sell_home_details.id','DESC')
        ->get();



        return view('detall.detall', ['dataHome' => $dataHome]);

    }



}
