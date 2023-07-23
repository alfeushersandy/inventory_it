<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;

class DepartemenController extends Controller
{
    public function index()
    {
        return view('departemen.index');
    }

    public function data(){
        $dept = Departemen::all();
        return datatables()
            ->of($dept)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        $dept = new Departemen();
        $dept->nama_departemen = $request->nama_departemen;
        $dept->save();

        toast('data Departemen berhasil ditambahkan', 'success');

        return redirect()->route('departemen.index');
    }
}
