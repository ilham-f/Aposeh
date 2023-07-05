<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manajemen(){
        return view('manajemen.manajemen',[
            'title' => 'Dashboard'
        ]);
    }

    public function pegawai(){
        return view('pegawai.pegawai',[
            'title' => 'Dashboard'
        ]);
    }
    public function historyChat(){
        return view('manajemen.historyChat',[
            'title' => 'Dashboard'
        ]);
    }

    public function member(){
        return view('pegawai.member',[
            'title' => 'Dashboard'
        ]);
    }

    public function pasien(){
        return view('manajemen.pasien');
    }

    public function form(){
        return view('manajemen.form',[
            'title' => ''
        ]);
    }

    public function rekap(){
        return view('manajemen.rekaptransaksi',[
            'title' => ''
        ]);
    }

    public function charts(){
        $jumlahPasien = Member::select(DB::raw('COUNT(*) as jumlahPasien'))
                                ->groupBy(DB::raw('MONTH(created_at)'))
                                ->pluck('jumlahPasien');


        $bulan = Member::select(DB::raw('MONTHNAME(created_at) as bulan'))
                            ->groupBy(DB::raw('MONTHNAME(created_at)'))
                            ->pluck('bulan');

        return view('pegawai.pegawai', compact('jumlahPasien', 'bulan'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePegawaiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePegawaiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePegawaiRequest  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePegawaiRequest $request, Pegawai $pegawai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        //
    }
}
