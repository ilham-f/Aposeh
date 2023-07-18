<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
use App\Models\Member;
use App\Models\User;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use Illuminate\Http\Request;


class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::all();
        return view('manajemen.indexmember',compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manajemen.createmember',[
            'pegawai' => User::where("role","pegawai")->get()
        ]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $validator = $request->validate([
            'user_id' => 'required',
            'nama_member' => 'required',
            'notelp' => 'required|max:14|unique:members',
            'alamat' => 'required',
            'jk' => 'required',
        ]);

        $member = Member::create($validator);
         if ($member) {
            return redirect('/indexdatamember');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */

    public function edit($member)
    {
        return view('manajemen.editmember',[
            'pegawai' => User::where("role","pegawai")->get(),
            'member'=>Member::find($member)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMemberRequest  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request,  $member)
    {
        //
        $validator = $request->validate([
            'status' => 'required',
            'nama_member' => 'required',
            'notelp' => 'required|max:14',
            'alamat' => 'required',
            'jk' => 'required',
        ]);

        $Member = Member::find($member)->update($validator);
         if ($Member) {
             return redirect('/indexdatamember');
         }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
    }


}
