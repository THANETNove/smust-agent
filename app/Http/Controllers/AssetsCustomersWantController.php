<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AssetsCustomersWant;
use Illuminate\Support\Facades\Auth;

class AssetsCustomersWantController extends Controller
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
     * Display a listing of the resource.
     */
    public function index()
    {

        $wantsData = DB::table('assets_customers_wants')
            ->where('assets_customers_wants.status', 1)
            ->leftJoin('users', 'assets_customers_wants.user_id', '=', 'users.id')
            ->leftJoin('provinces', 'assets_customers_wants.provinces', '=', 'provinces.id')
            ->leftJoin('amphures', 'assets_customers_wants.districts', '=', 'amphures.id')
            ->leftJoin('districts', 'assets_customers_wants.amphures', '=', 'districts.id')
            ->leftJoin('train_station', 'assets_customers_wants.station', '=', 'train_station.id') // เชื่อมกับตาราง train_station
            ->select(
                'assets_customers_wants.*',
                'users.first_name',
                'users.last_name',
                'users.phone',
                'users.image',
                'users.line_id',
                'users.facebook_id',
                'provinces.name_th AS provinces_name_th',
                'districts.name_th AS districts_name_th',
                'amphures.name_th AS amphures_name_th',
                'train_station.line_code',
                'train_station.station_code',
                'train_station.station_name_th'
            )
            ->orderBy('assets_customers_wants.created_at', 'DESC');

        // Clone the query for each condition
        $wants = (clone $wantsData)->whereNull('assets_customers_wants.user_id')->paginate(100);
        $wants2 = (clone $wantsData)->whereNotNull('assets_customers_wants.user_id')->paginate(100);






        return view('assetsCustomer.assets_customer', compact('wants', 'wants2'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $train = DB::table('train_station')
            ->get();
        $train = DB::table('train_station')
            ->get();

        return view('assetsCustomer.create_assets_customer', compact('train'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (isset($_POST['options'])) {
            $options = $_POST['options']; // $options จะเป็น array ที่มีค่าที่ผู้ใช้เลือก
        } else {
            $options = NULL; // กำหนดค่าเป็น array ว่างถ้าคีย์ 'options' ไม่มีอยู่
        }
        $member = new AssetsCustomersWant;


        $member->sale_rent = $request['sale_rent'];
        $member->property_type = $request['property_type'];
        $member->price_start = $request['price_start'];
        $member->price_end = $request['price_end'];
        $member->provinces = $request['provinces'];
        $member->districts = $request['districts'];
        $member->amphures = $request['amphures'];
        if ($request->has('station') && $request['station'] != 'null') {
            $member->station = $request['station'];
        } else {
            $member->station = NULL; // หรือกำหนดค่าอื่นตามที่คุณต้องการ
        }
        if ($request->has('options')) {
            $member->options = json_encode($options);
        } else {
            $member->options = NULL; // หรือกำหนดค่าอื่นตามที่คุณต้องการ
        }

        $member->message_customer = $request['message_customer'];
        $member->status = 1;
        if (Auth::check()) {
            $member->user_id = Auth::user()->id;
        } else {
            $member->user_id = NULL;
            $member->webName = $request['webName'];
            $member->webPhone = $request['webPhone'];
            $member->webLine = $request['webLine'];
            $member->webFacebook = $request['webFacebook'];
        }

        $member->save();
        return redirect('assets-customer')->with('message', "บันทึกสำเร็จ");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}