<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PostContent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostContentController extends Controller
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
        $dataPost = DB::table('post_contents')
            ->where('user_id', Auth::user()->id)
            ->orderBy('updated_at', 'DESC')
            ->get();
        return view('post_content.index', ['dataPost' => $dataPost]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post_content.create_post');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $member = new PostContent;
        $member->user_id = Auth::user()->id;
        if ($request->hasFile('image')) {


            $file = $request->file('image');
            $filename = date('i_d_m_Y') . '_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = '/assets/img/post/' . $filename;
            $file->move(public_path('/assets/img/post/'), $filename);
            $member->image = $filePath;
        }
        $member->name = $request['name'];
        $member->details_post = $request['details_post'];
        $member->save();
        return redirect('create_post')->with('success', "บันทึกสำเร็จ");
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
        $dataPost =  PostContent::find($id);

        return view('post_content.edit_post', ['dataPost'  => $dataPost]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $member =  PostContent::find($id);

        if ($request->hasFile('image')) {

            if ($member->image) {
                $existingImagePath = public_path($member->image);

                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath);
                }
            }

            $file = $request->file('image');
            $filename = date('i_d_m_Y') . '_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = '/assets/img/post/' . $filename;
            $file->move(public_path('/assets/img/post/'), $filename);
            $member->image = $filePath;
        }
        $member->name = $request['name'];
        $member->details_post = $request['details_post'];
        $member->save();
        return redirect('create_post')->with('success', "บันทึกสำเร็จ");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $flight =  PostContent::find($id);
        $flight->delete();
        return redirect('create_post')->with('success', "บันทึกสำเร็จ");
    }
}