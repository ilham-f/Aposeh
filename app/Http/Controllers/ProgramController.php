<?php

namespace App\Http\Controllers;

<<<<<<< Updated upstream:app/Http/Controllers/ProgramController.php
<<<<<<< Updated upstream:app/Http/Controllers/ProgramController.php
use App\Models\Program;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
=======
use App\Models\Member;
use App\Models\User;

use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use Illuminate\Http\Request;
>>>>>>> Stashed changes:app/Http/Controllers/MemberController.php
=======
use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
>>>>>>> Stashed changes:app/Http/Controllers/MemberController.php

class ProgramController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProgramRequest  $request
     * @return \Illuminate\Http\Response
     */
<<<<<<< Updated upstream:app/Http/Controllers/ProgramController.php
    public function store(StoreProgramRequest $request)
=======
    public function store(Request $request)
>>>>>>> Stashed changes:app/Http/Controllers/MemberController.php
    {
        // dd($request);
        $validator = $request->validate([

            'user_id' => 'required',
            'nama_member' => 'required',
            'notelp' => 'required|max:14',
            'alamat' => 'required',
            'keluhan' => 'required',
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
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
<<<<<<< Updated upstream:app/Http/Controllers/ProgramController.php
    public function edit(Program $program)
=======
    public function edit($member)
>>>>>>> Stashed changes:app/Http/Controllers/MemberController.php
    {
        
        return view('manajemen.editmember',[
            'pegawai' => User::where("role","pegawai")->get(),
            'member'=>Member::find($member)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProgramRequest  $request
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
<<<<<<< Updated upstream:app/Http/Controllers/ProgramController.php
    public function update(UpdateProgramRequest $request, Program $program)
=======
    public function update(Request $request, $member)
>>>>>>> Stashed changes:app/Http/Controllers/MemberController.php
    {
        //
        $validator = $request->validate([
            'status' => 'required',
            'nama_member' => 'required',
            'notelp' => 'required|max:14',
            'alamat' => 'required',
            'keluhan' => 'required',
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
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        //
    }

    
}
