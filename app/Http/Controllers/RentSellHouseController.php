<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Str;
use App\Models\HasFactory;
use App\Models\RentSellHomeDetails;
use App\Models\User;

class RentSellHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
         $this->middleware('auth');
     }


    public function index()
    {

    }
    public function profileAdmin()
    {

        $user = DB::table('users')
        ->where('code', '!=', Auth::user()->code)
        ->where('code_admin',Auth::user()->code)
        ->get();

        return view('admin.profile',['user' =>  $user ]);//
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = DB::table('provinces')->orderBy('name_th','ASC')->get();
        $train_station = DB::table('train_station')->select('train_station.id', 'train_station.station_name_th')->get();
        return view('admin.create',['train_station' => $train_station,'data' => $data]);//
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'image.*' => ['required', 'image', 'image:jpg,png,jpeg,webp']
        ]);
        $randomText = Str::random(12);
        $member = new RentSellHomeDetails;
        $member->code_admin = Auth::user()->code;
        $member->building_name = $request['building_name'];
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
        if($request->hasFile('image')){
            $imagefile = $request->file('image');

            foreach ($imagefile as $image) {
              $data =   $image->move(public_path().'/img/product',$randomText."".$image->getClientOriginalName());
              $dateImg[] =  $randomText."".$image->getClientOriginalName();
            }
        }
    $member->image = json_encode($dateImg);
    $member->save();


    return redirect('home')->with('message', "บันทึกสำเร็จ" );
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
      /*   $dataProduct = RentSellHomeDetails::find($id); */

        $dataProduct = DB::table('rent_sell_home_details')
        ->where('id', $id)->get();


        $data = DB::table('provinces')
        ->orderBy('name_th','ASC')->get();
        $dataAmphures= DB::table('amphures')->where('id',$dataProduct[0]->districts)
        ->orderBy('name_th','ASC')
        ->get();
        $dataDistricts= DB::table('districts')->where('id',$dataProduct[0]->amphures)
        ->orderBy('name_th','ASC')->get();

        $train_station = DB::table('train_station')->select('train_station.id', 'train_station.station_name_th')->get();
        return view('admin.edit',['data' => $data,'train_station'=>$train_station ,'id'=>$id ,
        'dataProduct' => $dataProduct,'dataAmphures'=>$dataAmphures ,'dataDistricts'=>$dataDistricts]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'image.*' => ['required', 'image', 'image:jpg,png,jpeg,webp']
        ]);
        $randomText = Str::random(12);
        $member =  RentSellHomeDetails::find($id);
        $member->building_name = $request['building_name'];
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
        $member->thereVarious = is_array($request['thereVarious']) ? json_encode($request['thereVarious']) : NULL;


        $dateImg = [];
        if($request->hasFile('image')){


           $img = json_decode($member->image);

            foreach( $img as $image) {
                $image_path = public_path().'/img/product/'.$image;
                if (file_exists($image_path)) {
                    // ถ้ามีไฟล์อยู่จริง จึงลบ
                    unlink($image_path);
                }
            }

            $imagefile = $request->file('image');
            foreach ($imagefile as $image) {
              $data =   $image->move(public_path().'/img/product',$randomText."".$image->getClientOriginalName());
              $dateImg[] =  $randomText."".$image->getClientOriginalName();
            }
            $member->image = json_encode($dateImg);
        }


     $member->save();
    return redirect('home')->with('message', "บันทึกสำเร็จ" );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $member =  RentSellHomeDetails::find($id);
        $member->status_home = 'off';
        $member->save();
        return redirect('home')->with('message', "ยกเลิกสำเร็จ" );
    }
    public function destroyCode(string $id)
    {
        $member =  User::find($id);
        $member->code_admin = NULL;
        $member->save();
        return redirect('profile-admin')->with('message', " ลบสำเร็จ" );
    }
}