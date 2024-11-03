<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AssetsCustomersWant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;


class AssetsCustomersWantController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*   public function __construct()
    {
        $this->middleware('auth');
    } */


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::check()) {

            $query = DB::table('assets_customers_wants')
                ->where('assets_customers_wants.status', 1)
                ->leftJoin('users', 'assets_customers_wants.user_id', '=', 'users.id')
                ->join('provinces', 'assets_customers_wants.provinces', '=', 'provinces.id')
                ->join('amphures', 'assets_customers_wants.districts', '=', 'amphures.id')
                ->join('districts', 'assets_customers_wants.amphures', '=', 'districts.id')
                ->leftJoin('train_station', 'assets_customers_wants.station', '=', 'train_station.id')
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

            /*   if ($request->all()) {

                $query->when($request->area_station == "area", function ($query) use ($request) {
                    // Filter by province, district, and amphure if area is selected
                    $query->when($request->has('provinces'), function ($q) use ($request) {
                        $q->where('assets_customers_wants.provinces', $request->input('provinces'));
                    });

                    $query->when($request->has('districts'), function ($q) use ($request) {
                        $q->where('assets_customers_wants.districts', $request->input('districts'));
                    });

                    $query->when($request->has('amphures'), function ($q) use ($request) {
                        $q->where('assets_customers_wants.amphures', $request->input('amphures'));
                    });
                }, function ($query) use ($request) {
                    $query->when($request->has('stations'), function ($q) use ($request) {
                        $q->where('assets_customers_wants.station_name', $request->input('stations'));
                    });
                });

                $query->when($request->has('sale_rent') && $request->input('sale_rent') !== 'sale_rent', function ($query) use ($request) {
                    $query->where('assets_customers_wants.sale_rent', $request->input('sale_rent'));
                });

                if ($request->has('options') && !empty($request->input('options'))) {
                    foreach ($request->input('options') as $option) {
                        $query->whereRaw('JSON_CONTAINS(assets_customers_wants.options, ?)', [json_encode($option)]);
                    }
                }
            } */
            if ($request->all()) {


                $query->when($request->area_station == "area", function ($query) use ($request) {
                    // Filter by province, district, and amphure if area is selected
                    $query->when($request->has('provinces'), function ($q) use ($request) {
                        $q->where('assets_customers_wants.provinces', $request->input('provinces'));
                    });

                    $query->when($request->has('districts'), function ($q) use ($request) {
                        $q->where('assets_customers_wants.districts', $request->input('districts'));
                    });

                    $query->when($request->has('amphures'), function ($q) use ($request) {
                        $q->where('assets_customers_wants.amphures', $request->input('amphures'));
                    });
                }, function ($query) use ($request) {

                    // Filter by station if area is not selected
                    $query->when($request->has('stations'), function ($q) use ($request) {

                        $q->where('assets_customers_wants.station_name', $request->input('stations'));
                    });
                });

                // Filter by sale or rent status
                $query->when($request->has('sale_rent') && $request->input('sale_rent') !== 'sale_rent', function ($query) use ($request) {
                    $query->where('assets_customers_wants.sale_rent', $request->input('sale_rent'));
                });

                // Filter by options if provided
                if ($request->has('options') && !empty($request->input('options'))) {


                    foreach ($request->input('options') as $option) {
                        $query->whereRaw('JSON_CONTAINS(assets_customers_wants.options, ?)', [json_encode($option)]);
                    }
                }
            }




            // แยกข้อมูลที่ status เป็น NULL และ ไม่เป็น NULL


            $currentDate = Carbon::now(); // วันและเวลาปัจจุบัน
            $userCreatedDate = Carbon::parse(Auth::user()->created_at); // วันที่ของผู้ใช้
            $createdDate = $userCreatedDate->lessThan($currentDate->subDays(3));
            $authCount = (Auth::user()->plans == 0 && $createdDate) ? 1 : 2;
            //dd($authCount);

            // สร้างสำเนาของ query สำหรับแยกข้อมูลที่ user_id เป็น NULL
            $queryForNullStatus = clone $query;
            $wantsNullStatus = $queryForNullStatus->whereNull('assets_customers_wants.user_id')->paginate(100)->appends($request->all());

            // สร้างสำเนาของ query สำหรับแยกข้อมูลที่ user_id ไม่เป็น NULL
            $queryForNotNullStatus = clone $query;
            $wantsNotNullStatus = $queryForNotNullStatus->whereNotNull('assets_customers_wants.user_id')->paginate(100)->appends($request->all());





            return view('assetsCustomer.assets_customer', [
                'wants' => $wantsNullStatus,
                'wants2' => $wantsNotNullStatus,
                'createdDate' => $createdDate,
                'authCount' => $authCount
            ]);
        } else {
            return redirect('/login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $train = DB::table('train_station')
            ->where('status', 1)
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
        $member->notifications = 1;

        if ($request->has('station') && $request['station'] != null) {
            $train = DB::table('train_station')
                ->where('status', 1)
                ->where('id', $request['station'])
                ->get();

            $member->station_name = $train[0]->station_name_th;
            $member->station = $request['station'];
        } else {
            $member->station_name = NULL;
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

        if (Auth::check()) {
            return redirect('assets-customer')->with('message', "บันทึกสำเร็จ");
        } else {
            return redirect('/')->with('message', "บันทึกสำเร็จ");
        }
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
