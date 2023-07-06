<?php

namespace App\Http\Controllers;

<<<<<<< Updated upstream:app/Http/Controllers/ProgramController.php
use App\Models\Program;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
=======
use App\Models\Obat;
use Illuminate\Http\Request;
use App\Http\Requests\StoreObatRequest;
use App\Http\Requests\UpdateObatRequest;
>>>>>>> Stashed changes:app/Http/Controllers/ObatController.php

class ProgramController extends Controller
{
    //menampilkan data dinphpmyadmin/database ke halaman obat(index utama)
    public function obat(){
        $obat = Obat::all();
        return view('manajemen.obat',compact(['obat']));
        // return view('manajemen.obat', [
        //     "obat" => $obat
        // ]);
    }
    public function print(){
        $obat = Obat::all();
        return view('manajemen.cetak',compact(['obat']));
        // return view('manajemen.obat', [
        //     "obat" => $obat
        // ]);
    }

    //meanmpilkan riwayat arsip data
    public function arc(){
        $obat = Obat::all();
        return view('manajemen.riwayat',compact(['obat']));
    }

<<<<<<< Updated upstream:app/Http/Controllers/ProgramController.php
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProgramRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProgramRequest $request)
    {
        //
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
=======

    //membat
    public function create(){
        return view('manajemen.create');
    }

    public function store(Request $request){
        // dd($request->except(['_token','submit']));
        Obat::create($request->except(['_token','submit']));
        return back();
    }

    public function edit($id){
        $obat = Obat::find($id);
        return view('manajemen.edit',compact(['obat']));

    }

    public function update($id,Request $request){
        $obat = Obat::find($id);
        $obat->update($request->except(['_token','submit']));
        return back();
    }

>>>>>>> Stashed changes:app/Http/Controllers/ObatController.php
}
