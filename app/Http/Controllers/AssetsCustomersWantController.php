<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AssetsCustomersWant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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
    public function index(Request $request)
    {

        $wantsData = Cache::remember("wantsData_", 60, function () use ($request) {
            $query = DB::table('assets_customers_wants')
                ->where('assets_customers_wants.status', 1)
                ->leftJoin('users', 'assets_customers_wants.user_id', '=', 'users.id')
                ->leftJoin('provinces', 'assets_customers_wants.provinces', '=', 'provinces.id')
                ->leftJoin('amphures', 'assets_customers_wants.districts', '=', 'amphures.id')
                ->leftJoin('districts', 'assets_customers_wants.amphures', '=', 'districts.id')
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

            if ($request->all()) {
                $query->when($request->area_station == "area", function ($query) use ($request) {
                    $query->when($request->has('provinces'), function ($q) use ($request) {
                        $q->where('assets_customers_wants.provinces', $request->input('provinces'));
                    })
                        ->when($request->has('districts'), function ($q) use ($request) {
                            $q->where('assets_customers_wants.districts', $request->input('districts'));
                        })
                        ->when($request->has('amphures'), function ($q) use ($request) {
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
            }

            return $query->get(); // ดึงข้อมูลทั้งหมดในรูปแบบ Collection
        });

        // แยกข้อมูลที่ status เป็น NULL และ ไม่เป็น NULL
        $wantsNullStatus = $wantsData->filter(function ($item) {
            return is_null($item->user_id);
        });

        $wantsNotNullStatus = $wantsData->filter(function ($item) {
            return !is_null($item->user_id);
        });

        // สร้าง Paginator สำหรับ $wantsNullStatus
        // สร้าง Paginator สำหรับ $wantsNullStatus
        $wantsNullStatusPaginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $wantsNullStatus->forPage($request->input('page_null_status', 1), 100),
            $wantsNullStatus->count(),
            100,
            $request->input('page_null_status', 1),
            ['path' => $request->url(), 'pageName' => 'page_null_status']
        );

        // สร้าง Paginator สำหรับ $wantsNotNullStatus
        $wantsNotNullStatusPaginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $wantsNotNullStatus->forPage($request->input('page_not_null_status', 1), 100),
            $wantsNotNullStatus->count(),
            100,
            $request->input('page_not_null_status', 1),
            ['path' => $request->url(), 'pageName' => 'page_not_null_status']
        );


        return view('assetsCustomer.assets_customer', [
            'wants' => $wantsNullStatusPaginator,
            'wants2' => $wantsNotNullStatusPaginator,
        ]);
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
            $train = DB::table('train_station')
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