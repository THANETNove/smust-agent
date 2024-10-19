<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Auth;

class OwnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request['search'];
        if ($search) {
            $user = DB::table('users')
                ->where('status', '!=', '3')
                ->where(function ($query) use ($search) {
                    $query->where('email', 'like', "%$search%")
                        ->orWhere('first_name', 'like', "%$search%");
                })
                ->get();
        } else {
            $user = DB::table('users')
                ->where('status', '!=', "3")
                ->get();
        }

        return view('owner.index', ['user' => $user]);
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
    public function changeAdmin($id)
    {
        $user = DB::table('users')
            ->where('id', $id)
            ->first(); // ใช้ first() แทน get() เพื่อให้ได้แค่ผลลัพธ์เดียว

        $member = User::find($id);

        if ($user && $user->code_admin == null) {
            $member->code_admin = $user->code;
        }

        $member->status = "1";
        $member->save();
        return redirect('add-admin')->with('message', "เปลี่ยนสำเร็จ");
    }


    public function cancelAdmin($id)
    {


        $member = User::find($id);
        $member->status = "0";
        $member->save();
        return redirect('add-admin')->with('message', "ยกเลิกลสำเร็จ");
    }


    public function store(Request $request)
    {
        //
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