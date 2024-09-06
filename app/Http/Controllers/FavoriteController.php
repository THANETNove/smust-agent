<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class FavoriteController extends Controller
{
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
    
        $data = DB::table('favorites')
            ->where('id_product', $id)
            ->where('user_id',  Auth::user()->id);
        $dataCount =  $data->count();


        if ($dataCount == 0) {
            $member = new Favorite;
            $member->user_id = Auth::user()->id; // add

            $member->id_product = $id;
            $member->status_favorites = 1;
            $member->status = 0;
            $member->save();
            return redirect()->back()->with('message', "เพิ่มเข้ารายการโปรดสำเร็จ");
        } else {

            $da =  $data->first();
            $member =  Favorite::find($da->id);
            if ($da->status_favorites == 0) {
                $member->status_favorites = 1;
                $mess = "เพิ่มเข้ารายการโปรดสำเร็จ";
            } else {
                $member->status_favorites = 0;
                $mess = "ยกเลิกรายการโปรดสำเร็จ";
            }


            $member->save();


            return redirect()->back()->with('message',  $mess);
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