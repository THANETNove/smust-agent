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

        $wants = DB::table('assets_customers_wants')
            ->leftJoin('users', 'assets_customers_wants.user_id', 'users.id')
            ->select('assets_customers_wants.*', 'users.first_name','users.last_name','users.phone','users.phone')
            ->orderBy('assets_customers_wants.id', 'DESC')
            ->paginate(100);


        return view('assetsCustomer.assets_customer', compact('wants'));
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
        $options = $_POST['options']; // $options จะเป็น array ที่มีค่าที่ผู้ใช้เลือก


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