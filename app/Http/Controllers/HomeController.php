<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Obat;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(){
        return view('sign-in');
    }
}
