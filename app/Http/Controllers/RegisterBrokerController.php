<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterBrokerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        return view('auth.register_broker', ['id' => $id]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        if (isset($request['code_admin'])) {
            $number = DB::table('users')
                ->where('code', '!=', $request['code_admin'])
                ->where('code_admin', $request['code_admin'])
                ->get(); // ใช้ exists() เพื่อตรวจสอบว่ามีข้อมูลหรือไม่
            $owner = DB::table('users')
                ->where('code', $request['code_admin'])
                ->get(); // ใช้ exists() เพื่อตรวจสอบว่ามีข้อมูลหรือไม่

            if (count($number) > 10 && $owner[0]->status != "3") {
                return redirect()->back()->with('error', "สมัครไม่สำเร็จ จำนวนที่เป็นสมาชิกของ Admin เเล้ว");
            }
        }

        $randomText = Str::random(10);

        $code = 'SMUSET-' . $randomText;

        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'regex:/^[0-9]+$/'],
            'id_card_number' => ['required', 'string', 'max:255', 'regex:/^[0-9]+$/'],
            'provinces' => ['required', 'string', 'max:255'],
        ]);

        $filePath = NULL;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = date('i_d_m_Y') . '_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = '/assets/img/profile' . $filename;
            $file->move(public_path('/assets/img/profile/'), $filename);
        }

        User::create([
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'prefix' => $request['prefix'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone' => $request['phone'],
            'id_card_number' => $request['id_card_number'],
            'provinces' => $request['provinces'],
            'contract_type' => $request['contract_type'],
            'property_type' => $request['property_type'],
            'characteristics' => $request['characteristics'],
            'code_admin' => $request['code_admin'],
            'image' => $filePath, // Save file path to the database
            'code' => $code,
            'status' => "0",
        ]);

        $user = User::latest()->first(); // หรือ $user = User::orderBy('created_at', 'desc')->first();
        Auth::login($user);

        return redirect('/home');
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
