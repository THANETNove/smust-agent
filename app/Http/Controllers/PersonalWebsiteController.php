<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PersonalWebsite;
use Illuminate\Support\Facades\DB;

class PersonalWebsiteController extends Controller
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
        return view('personalWebsite.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $personal = DB::table('personal_websites')
            ->where('user_id', Auth::user()->id)
            ->first();



        return view('personalWebsite.create_personal', ['personal' => $personal]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {




        $member = new PersonalWebsite;
        $member->user_id = Auth::user()->id;
        if ($request->hasFile('image')) {


            $file = $request->file('image');
            $filename = date('i_d_m_Y') . '_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = '/assets/img/history_work/' . $filename;
            $file->move(public_path('/assets/img/history_work/'), $filename);
            $member->imageHade = $filePath;
        }
        $member->history_work = $request['history_work'];
        $member->save();
        return redirect('create-personal')->with('message', "บันทึกสำเร็จ");
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
        $member =  PersonalWebsite::find($id);

        if ($request->hasFile('image')) {
            if ($member->imageHade) {
                $existingImagePath = public_path($member->imageHade);
                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath);
                }
            }

            $file = $request->file('image');
            $filename = date('i_d_m_Y') . '_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = '/assets/img/history_work/' . $filename;
            $file->move(public_path('/assets/img/history_work/'), $filename);
            $member->imageHade = $filePath;
        }
        $member->history_work = $request['history_work'];
        $member->save();
        return redirect('create-personal')->with('success', "บันทึกสำเร็จ");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
