<?php

namespace App\Http\Controllers;

use App\Models\ReportPropertySold;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportPropertySoldController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        $member = new ReportPropertySold;

        if (Auth::check()) {

            $member->user_id = Auth::user()->id; // add
        }

        $member->id_product = $id;
        $member->report = json_encode($request['report']);
        $member->save();


        return redirect()->back()->with('message', "รายงานสำเร็จ");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
