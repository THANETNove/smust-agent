<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profile.profile');
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
        $member =  User::find($id);


        $validated = $request->validate([
            'card_image' => [
                $member->card_image ? 'sometimes' : 'required',
                'image',
                'mimes:jpg,png,jpeg,webp'
            ],
            'facebook' => ['nullable', 'url']
        ]);


        if ($request->hasFile('image')) {

            if ($member->image !==  null) {
                $existingImagePath = public_path($member->image);

                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath);
                }
            }


            $file = $request->file('image');
            $filename = date('i_d_m_Y') . '_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = '/assets/img/profile/' . $filename;
            $file->move(public_path('/assets/img/profile/'), $filename);
            $member->image = $filePath;
        }
        if ($request->hasFile('card_image')) {

            if ($member->card_image) {
                $existingImagePath2 = public_path($member->card_image);

                if (file_exists($existingImagePath2)) {
                    unlink($existingImagePath2);
                }
            }

            $file2 = $request->file('card_image');
            $filename2 = date('i_d_m_Y') . '_' . time() . '.' . $file2->getClientOriginalExtension();
            $filePathCard = '/assets/img/card_image/' . $filename2;
            $file2->move(public_path('/assets/img/card_image/'), $filename2);
            $member->card_image = $filePathCard;
        }
        $member->phone = $request['phone'];
        $member->id_card_number = $request['id_card_number'];
        $member->line_id = $request['line_id'];
        $member->facebook_id = $request['facebook'];
        $member->provinces = $request['provinces'];
        $member->contract_type = $request['contract_type'];
        $member->property_type = $request['property_type'];
        $member->characteristics = $request['characteristics'];


        $member->save();
        return redirect()->back()->with('success', 'ข้อมูลถูกบันทึกเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}