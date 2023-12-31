<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Member;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use App\Models\Chat;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function manajemen(Request $request){
        // Mendapatkan tahun yang dipilih dari request
        $selectedYear = $request->input('year', null);

        // Mengambil data jumlah pasien setiap user setiap bulan
        $data = Member::select(DB::raw('COUNT(*) as total, YEAR(members.created_at) as year, DATE_FORMAT(members.created_at, "%Y-%m") as month, users.nama'))
            ->join('users', 'members.user_id', '=', 'users.id')
            ->when($selectedYear, function ($query, $selectedYear) {
                return $query->whereYear('members.created_at', $selectedYear);
            })
            ->groupBy('members.user_id', 'year', 'month', 'users.nama')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Membentuk data untuk chart
        $chartData = [];
        $usernames = [];
        $years = [];

        foreach ($data as $row) {
            $chartData[$row->nama][$row->year][] = $row->total;
            if (!in_array($row->nama, $usernames)) {
                $usernames[] = $row->nama;
            }
            if (!in_array($row->year, $years)) {
                $years[] = $row->year;
            }
        }

        // Mengambil label bulan dari data yang tersedia
        $labels = Member::select(DB::raw('DISTINCT DATE_FORMAT(members.created_at, "%Y-%m") as month'))
            ->when($selectedYear, function ($query, $selectedYear) {
                return $query->whereYear('members.created_at', $selectedYear);
            })
            ->orderBy('month')
            ->pluck('month')
            ->toArray();

        // Ubah format label bulan menjadi nama bulan
        $labels = array_map(function ($label) {
            $date = Carbon::createFromFormat('Y-m', $label);
            return $date->format('F');
        }, $labels);


        return view('manajemen.manajemen', compact('chartData', 'labels', 'usernames', 'years'));
    }

    public function pegawai(Request $request){

        $selectedYear = $request->input('year', null);

        // Mengambil data jumlah pasien setiap user setiap bulan
        $data = Member::select(DB::raw('COUNT(*) as total, YEAR(created_at) as year, DATE_FORMAT(created_at, "%Y-%m") as month'))
            ->where('user_id',Auth::user()->id)
            ->when($selectedYear, function ($query, $selectedYear) {
                return $query->whereYear('created_at', $selectedYear);
            })
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Membentuk data untuk chart
        $usernames = [];
        $chartData = [];
        $years = [];

        foreach ($data as $row) {
            $chartData[$row->year][] = $row->total;
            if (!in_array($row->nama, $usernames)) {
                $usernames[] = $row->nama;
            }
            if (!in_array($row->year, $years)) {
                $years[] = $row->year;
            }
        }

        // Mengambil label bulan dari data yang tersedia
        $labels = Member::select(DB::raw('DISTINCT DATE_FORMAT(members.created_at, "%Y-%m") as month'))
            ->where('user_id',Auth::user()->id)
            ->when($selectedYear, function ($query, $selectedYear) {
                return $query->whereYear('members.created_at', $selectedYear);
            })
            ->orderBy('month')
            ->pluck('month')
            ->toArray();

        // Ubah format label bulan menjadi nama bulan
        $labels = array_map(function ($label) {
            $date = Carbon::createFromFormat('Y-m', $label);
            return $date->format('F');
        }, $labels);

        $activeMembers = Member::where('status','1')->get();
        $nonActiveMembers = Member::where('status','0')->get();

        return view('pegawai.pegawai',[
            'activeMembers' => $activeMembers,
            'nonActiveMembers' => $nonActiveMembers,
            'usernames' => $usernames,
            'chartData' => $chartData,
            'years' => $years,
            'labels' => $labels
        ]);
    }

    public function tambahdatapegawai(){
        $user = User::where('role','pegawai')->get();
        return view('manajemen.datapegawai',compact('user'));
    }


    public function historyChat(){
        return view('manajemen.historyChat',[
            'title' => 'Dashboard'
        ]);
    }

    public function member(){
        return view('pegawai.member',[
            'users' => Member::all()
        ]);
    }
    public function memberPeg(){
        return view('pegawai.create-member');
    }

    public function chatmasuk(){
        $chats = Chat::distinct()->pluck('no_pengirim');
        // $chatperorang = {};

        // dd($chats);
        return view('manajemen.chat-masuk',[
            'chats' => $chats,
            // 'chatorangmasuk' =>
            'manajemen' => Auth::user()
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

    public function history(){
        return view('manajemen.history',[
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
        return view('manajemen.create-datapegawai');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePegawaiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'password' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'notelp' => 'required|unique:users',
        ]);
        $validatedData['password']=bcrypt($validatedData['password']);

        User::create($validatedData);
        return redirect()->intended('/datapegawai')->withSuccess('Data berhasil disimpan');
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
