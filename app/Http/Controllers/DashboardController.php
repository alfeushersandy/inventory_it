<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Masterbarang;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $kategori = Kategori::all(); 
        return view('dashboard.index', compact('kategori'));
    }
}