<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
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


        /*     $validated = $request->validate([
            'card_image' => ['required', 'image', 'image:jpg,png,jpeg,webp'],
            'facebook' => ['nullable', 'url']

        ]);
 */

        $member =  User::find($id);

        if ($request->hasFile('image')) {

            /*   $existingImagePath = public_path($member->image);

            if (file_exists($existingImagePath)) {
                unlink($existingImagePath);
            }
 */
            $file = $request->file('image');
            $filename = date('i_d_m_Y') . '_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = '/assets/img/profile/' . $filename;
            $file->move(public_path('/assets/img/profile/'), $filename);
            $member->image = $filePath;
        }
        if ($request->hasFile('card_image')) {

          /*   $existingImagePath2 = public_path($member->card_image);

            if (file_exists($existingImagePath2)) {
                unlink($existingImagePath2);
            }
 */

            $file2 = $request->file('card_image');
            $filename2 = date('i_d_m_Y') . '_' . time() . '.' . $file2->getClientOriginalExtension();
            $filePathCard = '/assets/img/card_image/' . $filename2;
            $file2->move(public_path('/assets/img/card_image/'), $filename2);
            $member->image = $filePathCard;
        }

        dd("aa");
        /*   $dateImg = [];
        if ($request->hasFile('image')) {


            $img = json_decode($member->image);

            foreach ($img as $image) {
                $image_path = public_path() . '/img/product/' . $image;
                if (file_exists($image_path)) {
                    // ถ้ามีไฟล์อยู่จริง จึงลบ
                    unlink($image_path);
                }
            }

            $imagefile = $request->file('image');
            foreach ($imagefile as $image) {
                $data =   $image->move(public_path() . '/img/product', $randomText . "" . $image->getClientOriginalName());
                $dateImg[] =  $randomText . "" . $image->getClientOriginalName();
            }
            $member->image = json_encode($dateImg);
        }


        $member->save(); */
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}