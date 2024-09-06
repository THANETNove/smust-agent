<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Caption;
use Illuminate\Support\Facades\Auth;

class CaptionController extends Controller
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
    public function store(Request $request) {}

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

        $data = DB::table('captions')
            ->where('id_product', $id)
            ->where('user_id',  Auth::user()->id);
        $dataCount =  $data->count();


        if ($dataCount == 0) {
            $member = new Caption;
            $member->user_id = Auth::user()->id; // add

            $member->id_product = $id;
            $member->details = $request['details'];
            $member->save();
            return redirect()->back()->with('message', "บันทึกสำเร็จ");
        } else {

            $da =  $data->first();
            $member =  Caption::find($da->id);
            $member->details = $request['details'];
            $member->save();

            return redirect()->back()->with('message', "เเก้ไขสำเร็จ");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
