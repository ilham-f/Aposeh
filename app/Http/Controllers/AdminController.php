<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Category;
use App\Models\Keluhan;

class AdminController extends Controller
{
    public function index(){
        return view('manajemen.manajemen',[
            'title' => 'Dashboard'
        ]);
    }
    public function tes(){
        return view('manajemen.test',[
            'title' => ''
        ]);
    }
    public function form(){
        return view('manajemen.form',[
            'title' => ''
        ]);
    }

    public function tabelobat(){
        return view('manajemen.obat', [
            'obats' => Obat::all(),
            'categories' => Category::all(),
            'title' => 'Tabel Obat',
            'keluhan' => Keluhan::all()
        ]);
    }

    // public function tambahobat(){
    //     return view('manajemen.tambahobat', [
    //         'title' => 'Tambah Obat'
    //     ]);
    // }

    public function tabelkategori(){
        return view('manajemen.kategori',[
            'categories' => Category::all(),
            'title' => 'Tabel Kategori'
        ]);
    }

    // public function tambahkategori(){
    //     return view('manajemen.tambahkategori',[
    //         'title' => 'Tambah Kategori'
    //     ]);
    // }

    public function tabelkeluhan(){
        return view('manajemen.keluhan',[
            'keluhans' => Keluhan::all(),
            'title' => 'Tabel Keluhan'
        ]);
    }

    // public function tambahkeluhan(){
    //     return view('manajemen.tambahkeluhan',[
    //         'title' => 'Tambah Keluhan'
    //     ]);
    // }

}

