<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjam;

class LandingPageController extends Controller
{
     public function index()
    {
        $pinjams = Peminjam::all(); // ambil semua data
        return view('landing.peminjam', compact('pinjams'));
    }
}
