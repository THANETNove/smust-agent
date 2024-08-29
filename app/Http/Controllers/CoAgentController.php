<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\RentSellHomeDetails;
use App\Models\User;

class CoAgentController extends Controller
{
    /*  public function __construct()
    {
        $this->middleware('auth');
    } */
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            return view('co-agent.index');
        } else {
            return redirect('login');
        }
    }


    public function districts($id)
    {

        $data = DB::table('amphures')
            ->where('amphures.province_id', $id)
            ->orderBy('name_th', 'ASC')
            ->get();

        return response()->json($data);
    }
    public function amphures($id)
    {


        $data = DB::table('districts')
            ->where('amphure_id', $id)
            ->orderBy('name_th', 'ASC')
            ->get();

        return response()->json($data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $electricalAppliance = DB::table('electrical_appliances')->get();
        $facilities = DB::table('facilities')->get();
        $furniture = DB::table('furniture')->get();

        return view('co-agent.create_co', compact('electricalAppliance', 'facilities', 'furniture'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        /* $request->validate([
            'image.*' => ['required', 'image', 'image:jpg,png,jpeg,webp'],
            'user_name' => 'required',
            'user_surname' => 'required',
            'user_phone' => 'required',
            'url_video' => ['nullable', 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?(\?.*)?$/'],
            'url_gps' => ['nullable', 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?(\?.*)?$/'],
        ], [
            'url_video.url' => 'The link Video must be a valid URL.',
            'url_gps.url' => 'The link GPS must be a valid URL.',
        ]); */
        dd($request->all());





        $member = new RentSellHomeDetails;

        if (Auth::check()) {
            $member->code_admin = Auth::user()->code;
            $member->user_id = Auth::user()->id; // add
        }
        $member->cross = $request['cross']; //TODO:  add ข้ามการกรอกข้อมูลใหม

        $member->sell = $request['type_name_sell']; //TODO: add ขาย
        $member->rent_sell = $request['type_name_hire_sell']; // เช่าซื้อ/ขายผ่อน
        $member->rent = $request['type_name_hire']; //TODO: add  เช่า
        $member->property_type = $request['property_type']; // ประเภททรัพย์ 
        $member->name_have =  $request['name_have']; //TODO: add โฉนดมีภาระหนี้หรือไม่
        $member->minimum_rent = $request['minimum_rent']; //  เช่าขั้นต่ำ*
        $member->start_date = $request['start_date']; //TODO: add เริ่มให้เช่าได้ตั้งแต่
        $member->address = $request['house_number']; // บ้านเลขที่
        $member->building_name = $request['house_name']; // โครงการ เช่น ชื่อหมู่บ้าน
        $member->provinces = $request['provinces']; // จังหวัด
        $member->districts = $request['districts']; // อำเภอ
        $member->amphures = $request['amphures'];  // ตำบล
        $member->road = $request['road'];  //TODO: add ถนน
        $member->alley = $request['alley'];  //TODO: add ซอย
        $member->train_name = $request['stations'];  // ชื่อสถานีรถไฟ	
        $member->bedroom = $request['number_bedrooms'];  // จำนวนห้องนอน	
        $member->bathroom = $request['number_bathrooms'];  // จำนวนห้องน้ำ		
        $member->number_floors = $request['number_floors'];  // จำนวนห้องน้ำ		
        $member->number_parking = $request['number_parking'];  //TODO: add จำนวนที่จอดรถ		
        $member->studio = $request['studio_name'];  //สตูดิโอ	
        $member->rent_baht_month = $request['rent_baht_month'];  //TODO: add ค่าเช่า* (บาท/เดือน)	
        $member->month_advance_rent = $request['month_advance_rent'];  //TODO: add ค่าเช่าล่วงหน้า 1 เดือน
        $member->cash_pledge = $request['deposit_month'];  // เงินมัดจำ (เดือน)*
        $member->reservation_money = $request['reservation_money'];  // เงินจอง *
        $member->sell_price = $request['selling_price_baht'];  //ราคาขาย* (บาท)
        $member->reservation_amount_baht = $request['reservation_amount_baht'];  //จำนวนเงินจอง* (บาท)
        $member->down_payment = $request['down_payment_amount'];  //เงินดาวน์ (ขาย)	
        $member->installments = $request['many_installments'];  //ผ่อนได้กี่งวด* (เดือน)
        $member->each_installment = $request['each_installment_baht'];  //งวดละ* (บาท)
        $member->electricalAppliance = $request['electricalAppliance'];  //TODO: add สิ่งอำนวยความสะดวก
        $member->facilities = $request['facilities'];  //TODO: add เครื่องใช้ไฟฟ้า
        $member->furniture = $request['furniture'];  //TODO: add เฟอร์นิเจอร์
        $member->shopping_center = json_encode($request['shopping_center']);  //TODO: add สถานที่สำคัญใกล้เคียง
        $member->school = json_encode($request['school']);  //TODO: add สถานศึกษา
        $member->meters_store = $request['meters_store'];  //TODO: add ร้านสะดวกซื้อที่ใกล้ที่สุด
        $member->image = $request['image'];  //ภาพ
        $member->url_video = $request['url_video'];  //TODO: ลิงค์ video 
        $member->announcement_name = $request['announcement_name'];  //TODO: ชื่อประกาศ* 
        $member->url_gps = $request['url_gps'];  // ลิงค์ GPS 
        $member->files = $request['files'];  //TODO: add files  



        /*  $member->building_name = $request['building_name'];
        $member->property_type = $request['property_type'];
        $member->rent_sell = $request['rent_sell'];
        $member->rental_price = $request['rental_price'];
        $member->sell_price = $request['sell_price'];
        $member->url_gps = $request['url_gps'];
        $member->time_arrive = $request['time_arrive'];
        $member->train_name = $request['train_name'];
        $member->bedroom = $request['bedroom'];
        $member->bathroom = $request['bathroom'];
        $member->room_width = $request['room_width'];
        $member->studio = $request['studio'];
        $member->number_floors = $request['number_floors'];
        $member->decoration = $request['decoration'];
        $member->address = $request['address'];
        $member->provinces = $request['provinces'];
        $member->districts = $request['districts'];
        $member->amphures = $request['amphures'];
        $member->zip_code = $request['zip_code'];
        $member->details = $request['details'];
        $member->minimum_rent = $request['minimum_rent'];
        $member->deposit = $request['deposit'];
        $member->cash_pledge = $request['cash_pledge'];
        $member->advance_rent = $request['advance_rent'];
        $member->reservation_money = $request['reservation_money'];
        $member->down_payment = $request['down_payment'];
        $member->down_payment_installments = $request['down_payment_installments'];
        $member->installments = $request['installments'];
        $member->each_installment = $request['each_installment'];
        $member->kitchen = $request['kitchen'];
        $member->bed = $request['bed'];
        $member->fitness = $request['fitness'];
        $member->wardrobe = $request['wardrobe'];
        $member->parking = $request['parking'];
        $member->air_conditioner = $request['air_conditioner'];
        $member->make_appointment_location = $request['make_appointment_location'];
        $member->send_customers = $request['send_customers'];
        $member->ask_more = $request['ask_more'];
        $member->contact_number = $request['contact_number'];
        $member->status_home = "on";
        $member->thereVarious = is_array($request['thereVarious']) ? json_encode($request['thereVarious']) : NULL;


        $dateImg = [];
        if ($request->hasFile('image')) {
            $imagefile = $request->file('image');

            foreach ($imagefile as $image) {
                $data =   $image->move(public_path() . '/img/product', $randomText . "" . $image->getClientOriginalName());
                $dateImg[] =  $randomText . "" . $image->getClientOriginalName();
            }
        }
        $member->image = json_encode($dateImg); */
        // $member->save();


        return redirect('home')->with('message', "บันทึกสำเร็จ");
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