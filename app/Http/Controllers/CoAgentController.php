<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $request->validate([
            'product_name' => 'required',
            'price' => 'required',
            'image.*' => ['required', 'image', 'image:jpg,png,jpeg,webp'],
            'check_manu' => 'required',
            'link_lazada' => ['nullable', 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?(\?.*)?$/'],
            'link_shopee' => ['nullable', 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?(\?.*)?$/'],
            'other_links' => ['nullable', 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?(\?.*)?$/'],
        ], [
            'link_lazada.url' => 'The link Lazada must be a valid URL.',
            'link_shopee.url' => 'The link Shopee must be a valid URL.',
            'other_links.url' => 'The link Other_links must be a valid URL.',
        ]);
        dd($request->all());
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