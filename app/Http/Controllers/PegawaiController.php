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

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function manajemen(){
        $years = [2020,2021,2022,2023];
        $chartData = [];
        $usernames = [];
        $labels = [];
        return view('manajemen.manajemen', compact('chartData', 'labels', 'usernames', 'years'));
    }

    public function grafik(Request $request)
    {
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

    public function pegawai(){
        return view('pegawai.pegawai',[
            'title' => 'Dashboard'
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
            'email' => 'required|unique:users',
            'password' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'notelp' => 'required|unique:users',
        ]);
        $validatedData['role']='pegawai';
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

    public function keaktifan() 
    {
        $user = User::where('role','pegawai')->get();
        return view('manajemen.keaktifanpegawai',compact('user'));
    }
    public function detailkeaktifan($id) 
    {
        $tahunMember = DB::table('members as m')
        ->select(DB::raw('YEAR(m.created_at) as year'))
        ->where('user_id',$id)
        ->groupBy('year')
        ->get();
        $memberThisMonth = Member::where('user_id',$id)->whereMonth('created_at',date('m'))->count();
        $memberThisYear = Member::where('user_id',$id)->whereYear('created_at',date('Y'))->count();
        return view('manajemen.detailkeaktifanpegawai',compact('memberThisMonth','memberThisYear','id','tahunMember'));
    }
    public function getKeaktifanTahunan(Request $request) 
    {
        $yearlyData = Member::selectRaw("DATE_FORMAT(created_at, '%Y') AS year, COUNT(*) AS count")
        ->where('user_id',$request->user)
        ->groupBy('year')
        ->orderByRaw("YEAR(created_at)")
        ->get();
        $year = $yearlyData->pluck('year')->toArray();
        $dataTahunan = $yearlyData->pluck('count')->toArray();
        return response()->json(['year'=>$year,'dataTahunan'=>$dataTahunan]);
    }
    function getKeaktifanBulanan(Request $request) {
      
        $monthlyData = Member::selectRaw("DATE_FORMAT(created_at, '%M') AS month, COUNT(*) AS count")
        ->whereYear('created_at', $request->year)
        ->where('user_id',$request->user)
        ->groupBy('month')
        ->orderByRaw("MONTH(created_at)")
        ->get();
       
        $bulan = $monthlyData->pluck('month')->toArray();
        $dataBulanan = $monthlyData->pluck('count')->toArray();
        return response()->json(['month'=>$bulan,'dataBulanan'=>$dataBulanan]);
      }
}
