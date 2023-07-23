<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\Masterbarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $lokasi = Lokasi::select('nama_lokasi')->groupBy('nama_lokasi')   
        ->orderBy('id_lokasi', 'asc')
        ->get();
        $kategori = Kategori::all();
        $barang = Masterbarang::all()->count();
        return view('reporting.index', compact('lokasi', 'kategori', 'barang'));
    }

    public function getTotal(Request $request){
        $lokasi = $request->query('lokasi');
        return response()->json($lokasi);

        // if($lokasi == "All Lokasi"){
        //     $barang = Masterbarang::all()->count();
        //     return response()->json($barang);
        // }
    }

    public function data(){
        $barang = Masterbarang::leftjoin('kategori', 'kategori.id_kategori', '=', 'master_barang.kategori_id')
        ->leftjoin('lokasi', 'lokasi.id_lokasi', '=', 'master_barang.lokasi_id')
        ->orderBy('id_barang', 'desc')        
        ->get();

        return datatables()
            ->of($barang)
            ->addIndexColumn()
            ->addcolumn('kategori', function($barang){
                return $barang->nama_kategori;
            })
            ->addcolumn('lokasi', function($barang){
                return $barang->nama_lokasi;
            })
            ->addcolumn('departemen', function($barang){
                return $barang->departemen;
            })
            ->addcolumn('keyboard', function($barang){
                if($barang->keyboard == true){
                    return 'Ada';
                }else{
                    return 'Tidak ada';
                }
            })
            ->addcolumn('mouse', function($barang){
                if($barang->mouse == true){
                    return 'Ada';
                }else{
                    return 'Tidak ada';
                }
            })
            ->addcolumn('select_all', function($barang){
                return '
                    <input type="checkbox" name="id_barang[]" value="'. $barang->id_barang .'">
                ';
            })
            ->rawColumns(['select_all','kategori', 'lokasi', 'departemen'])
            ->make(true);
            }
}
