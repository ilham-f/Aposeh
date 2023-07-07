<?php

namespace App\Http\Controllers;

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

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manajemen.indexmember');
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
    public function edit(Program $program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProgramRequest  $request
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProgramRequest $request, Program $program)
    {
        //
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
