<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


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
      /*   $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'regex:/^[0-9]+$/'],
            'id_card_number' => ['required', 'string', 'max:255', 'regex:/^[0-9]+$/'],
            'provinces' => ['required', 'string', 'max:255'],
        ]);


        $validator->errors()->add('status', 'There must be only one authority or boss.');


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
 */
        return view('auth.resetNewPassword');

     
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'regex:/^[0-9]+$/'],
            'id_card_number' => ['required', 'string', 'max:255', 'regex:/^[0-9]+$/'],
            'provinces' => ['required', 'string', 'max:255'],
        ]);
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