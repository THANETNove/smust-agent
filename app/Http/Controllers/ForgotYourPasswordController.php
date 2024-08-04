<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class ForgotYourPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.resetPassword');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }
    public function resetCheck(Request $request)
    {
        $validator = Validator::make($request->all(), []);



        $queryStatus1 = DB::table('users')->where('prefix', $request->prefix)->where('first_name', $request->first_name)->count();
        $queryStatus2 = DB::table('users')->where('first_name', $request->first_name)->count();
        $queryStatus3 = DB::table('users')->where('last_name', $request->last_name)->count();
        $queryStatus4 = DB::table('users')->where('phone', $request->phone)->count();
        $queryStatus5 = DB::table('users')->where('id_card_number', $request->id_card_number)->count();


        if ($queryStatus1 == 0) {
            $validator->after(function ($validator) {
                $validator->errors()->add('prefix', 'The prefix doest match.');
            });
        }
        if ($queryStatus2 == 0) {
            $validator->after(function ($validator) {
                $validator->errors()->add('first_name', 'The first_name doest match.');
            });
        }
        if ($queryStatus3 == 0) {
            $validator->after(function ($validator) {
                $validator->errors()->add('last_name', 'The last_name doest match.');
            });
        }

        if ($queryStatus4 == 0) {
            $validator->after(function ($validator) {
                $validator->errors()->add('phone', 'The phone doest match.');
            });
        }
        if ($queryStatus5 == 0) {
            $validator->after(function ($validator) {
                $validator->errors()->add('id_card_number', 'The id_card_number doest match.');
            });
        }



        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        $query = DB::table('users')
            ->where('prefix', $request->prefix)
            ->where('first_name', $request->first_name)
            ->where('last_name', $request->last_name)
            ->where('phone', $request->phone)
            ->where('id_card_number', $request->id_card_number)
            ->get();


        return view('auth.resetNewPassword', compact('query'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {




        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8'],
        ]);


        $confirmation =  $request->password == $request->password_confirmation;

        if (!$confirmation) {
            $validator->after(function ($validator) {
                $validator->errors()->add('password_confirmation', 'Password does not match');
            });
        }

        if ($validator->fails()) {
            return redirect()->route('reset-check-password', $id)->withErrors($validator)->withInput();
        }


        $data =  User::find($id);

        $data->password = Hash::make($request->password);
        $data->save();

        return redirect('login')->with('message', "เปลี่ยน password สำเร็จ");;
        // Save the new password logic here

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
        $query = DB::table('users')
            ->where('id', $id)
            ->get();


        return view('auth.resetNewPassword', compact('query'));
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
