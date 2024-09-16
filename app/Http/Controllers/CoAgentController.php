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

            $dataHomeQuery = DB::table('rent_sell_home_details')
                ->where('rent_sell_home_details.status_home', 'on')
                ->where('rent_sell_home_details.code_admin', Auth::user()->code)
                ->join('provinces', 'rent_sell_home_details.provinces', '=', 'provinces.id')
                ->join('amphures', 'rent_sell_home_details.districts', '=', 'amphures.id')
                ->join('districts', 'rent_sell_home_details.amphures', '=', 'districts.id')
                ->select(
                    'rent_sell_home_details.*',
                    'provinces.name_th AS provinces_name_th',
                    'districts.name_th AS districts_name_th',
                    'amphures.name_th AS amphures_name_th'
                )->get();


            return view('co-agent.index', compact('dataHomeQuery'));
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
    public function coUsers()
    {

        $dataHomeQuery = DB::table('rent_sell_home_details')
            ->where('rent_sell_home_details.status_home', 'on')
            ->where('rent_sell_home_details.user_id', Auth::user()->id)
            ->join('favorites', 'rent_sell_home_details.id', '=', 'favorites.id_product')
            ->join('users', 'favorites.user_id', '=', 'users.id')
            ->select(
                'users.*',
            )->orderBy('users.id', 'DESC')->get();


        return view('co-agent.users_co_agent', ['dataHomeQuery' => $dataHomeQuery]);
    }
    public function submitData(Request $request)
    {

        $dataHomeQuery = DB::table('rent_sell_home_details')
            ->where('status_home', 'on');


        if ($request->has('propertyTypeCo')) {
            $typeName =   $request->input('propertyTypeCo');
            $dataHomeQuery->where('rent_sell_home_details.property_type',   'LIKE', "%$typeName%");
        }

        if ($request->input('typeNameHireSell') == null) {


            if ($request->has('typeNameSell') &&  $request->input('typeNameSell') != null) {
                $dataHomeQuery->where(function ($query) {
                    $nameSale = "ขาย";
                    $query->where('rent_sell_home_details.rent_sell',   'LIKE', "%$nameSale%")
                        ->orWhere('rent_sell_home_details.sell', 'LIKE', "%$nameSale%");
                });
            }
            if ($request->has('typeNameHire') &&  $request->input('typeNameHire') != null) {
                $dataHomeQuery->where(function ($query) {
                    $nameRent = "เช่า";
                    $query->where('rent_sell_home_details.rent_sell', 'LIKE', "%$nameRent%")
                        ->orWhere('rent_sell_home_details.sell', 'LIKE', "%$nameRent%");
                });
            }
        }
        if ($request->has('provincesId') ||  $request->input('provincesId') != "จังหวัด") {
            $dataHomeQuery->where('rent_sell_home_details.provinces', $request->input('provincesId'));
        }



        return response()->json(['message' => 'Data received', 'data' => $dataHomeQuery->count()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'image' => ['required'], // บังคับให้ต้องใส่ภาพอย่างน้อย 1 ภาพ
            'image.*' => ['image', 'mimes:jpg,png,jpeg,webp'], // ตรวจสอบรูปแบบไฟล์ภาพ
            'user_name' => 'required',
            'user_surname' => 'required',
            'user_phone' => 'required',
            'announcement_name' => ['nullable', 'max:255'],
            'url_video' => ['nullable', 'url'], // ตรวจสอบว่าเป็น URL ที่ถูกต้อง
            'url_gps' => ['url'],
        ], [
            'url_video' => 'รูปเเบบ  URL. Video Youtube  ไม่ถูกต้อง',
            'url_gps' => 'รูปเเบบ  URL. GPS ไม่ถูกต้อง',
        ]);






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
        $member->room_width = $request['size_sq_m'];  // ขนาด* (ตร.ว.)		
        $member->number_parking = $request['number_parking'];  //TODO: add จำนวนที่จอดรถ		
        $member->studio = $request['studio_name'];  //สตูดิโอ	
        $member->rental_price = $request['rent_baht_month'];  //TODO: add ค่าเช่า* (บาท/เดือน)	
        $member->month_advance_rent = $request['month_advance_rent'];  //TODO: add ค่าเช่าล่วงหน้า 1 เดือน
        $member->cash_pledge = $request['deposit_month'];  // เงินมัดจำ (เดือน)*
        $member->reservation_money = $request['reservation_money'];  // เงินจอง *
        $member->sell_price = $request['selling_price_baht'];  //ราคาขาย* (บาท)
        $member->reservation_amount_baht = $request['reservation_amount_baht'];  //จำนวนเงินจอง* (บาท) ขาย
        $member->down_payment = $request['down_payment_amount'];  //เงินดาวน์ (ขาย)	
        $member->installments = $request['many_installments'];  //ผ่อนได้กี่งวด* (เดือน)
        $member->each_installment = $request['each_installment_baht'];  //งวดละ* (บาท)
        $member->electricalAppliance = $request['electricalAppliance'];  //TODO: add สิ่งอำนวยความสะดวก
        $member->facilities = $request['facilities'];  //TODO: add เครื่องใช้ไฟฟ้า
        $member->furniture = $request['furniture'];  //TODO: add เฟอร์นิเจอร์
        $member->shopping_center = json_encode($request['shopping_center']);  //TODO: add สถานที่สำคัญใกล้เคียง
        $member->school = json_encode($request['school']);  //TODO: add สถานศึกษา
        $member->meters_store = $request['meters_store'];  //TODO: add ร้านสะดวกซื้อที่ใกล้ที่สุด
        $member->url_video = $request['url_video'];  //TODO: ลิงค์ video 
        $member->announcement_name = $request['announcement_name'];  //TODO: ชื่อประกาศ* 
        $member->url_gps = $request['url_gps'];  // ลิงค์ GPS 
        $member->details = $request['details'];  // details
        $member->user_name = $request['user_name'];  //TODO: add ชื่อ 
        $member->user_surname = $request['user_surname'];  //TODO: add นาสกุล  
        $member->user_phone = $request['user_phone'];  //TODO: add เบอร์โทร  
        $member->product_new = 1;  //TODO:  product ใหม่  
        $member->notifications = 1;  //TODO: เเจ้งเตื่อน


        $randomText  = time();


        $dateImg = [];
        if ($request->hasFile('image')) {

            $imagefile = $request->file('image');

            foreach ($imagefile as $image) {

                $data =   $image->move(public_path() . '/img/product/', $randomText . "" . $image->getClientOriginalName());
                $dateImg[] =   $randomText . "" . $image->getClientOriginalName();
            }
        }


        $member->image = json_encode($dateImg);
        // files

        if ($request->hasFile('files')) {
            $files = $request->file('files');


            $fileName = $randomText . '_' . $files->getClientOriginalName();

            // Move the file to the specified directory
            $files->move(public_path('assets/img/files'), $fileName);

            // Store or use $fileName as needed
            $filePaths = 'assets/img/files/' . $fileName; // Store paths to use or save in database

            $member->files = $filePaths;
        }
        $member->save();

        if (Auth::check()) {
            return redirect('home')->with('message', "บันทึกสำเร็จ");
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

        $data =  RentSellHomeDetails::find($id);


        $favorite = DB::table('favorites')
            ->where('status_favorites', $id)
            ->delete();

        if ($data->image) {
            $desImage = json_decode($data->image);
            foreach ($desImage as $imagePath) {
                // Assuming images are stored in public directory
                $imagePath = public_path($imagePath); // Adjust if stored differently

                if (file_exists($imagePath)) {


                    unlink($imagePath); // Delete the file from the server
                }
            }
        }
        if ($data->files) {

            // Assuming images are stored in public directory
            $filesPath = public_path($data->files); // Adjust if stored differently


            if (file_exists($filesPath)) {
                unlink($filesPath); // Delete the file from the server
            }
        }



        $data->delete();
        return redirect('co-agent')->with('message', "บันทึกสำเร็จ");
    }
}