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
        $lokasi =
            Lokasi::orderBy('id_lokasi', 'asc')
            ->get();
        $kategori = Kategori::all();
        $barang = Masterbarang::all()->count();
        return view('reporting.index', compact('lokasi', 'kategori', 'barang'));
    }

    public function getTotal(Request $request)
    {
        $lokasi = $request->query('lokasi');
        $kategori = $request->query('kategori');

        $query = Masterbarang::query();

        // Filter berdasarkan kategori jika kategori tidak kosong
        if ($kategori) {
            $query->where('kategori_id', $kategori);

            // Jika kategori tidak kosong, tambahkan filter berdasarkan lokasi untuk kategori tersebut
            if ($lokasi && $lokasi !== "All Lokasi") {
                $query->where('lokasi_id', $lokasi)->where('kategori_id', $kategori);
            }
        }

        $barang = $query->count();

        return response()->json($barang);
    }

    public function data($lokasi, $kategori)
    {

        $query = Masterbarang::query();

        // Filter berdasarkan kategori jika kategori tidak kosong
        if ($kategori) {
            $query->where('kategori_id', $kategori);

            // Jika kategori tidak kosong, tambahkan filter berdasarkan lokasi untuk kategori tersebut
            if ($lokasi && $lokasi !== "All Lokasi") {
                $query->where('lokasi_id', $lokasi)->where('kategori_id', $kategori);
            }
        }

        $barang = $query->get();

        return datatables()
            ->of($barang)
            ->addIndexColumn()
            ->addcolumn('kategori', function ($barang) {
                return $barang->nama_kategori;
            })
            ->addcolumn('lokasi', function ($barang) {
                return $barang->nama_lokasi;
            })
            ->addcolumn('departemen', function ($barang) {
                return $barang->departemen;
            })
            ->addcolumn('keyboard', function ($barang) {
                if ($barang->keyboard == true) {
                    return 'Ada';
                } else {
                    return 'Tidak ada';
                }
            })
            ->addcolumn('mouse', function ($barang) {
                if ($barang->mouse == true) {
                    return 'Ada';
                } else {
                    return 'Tidak ada';
                }
            })
            ->rawColumns(['kategori', 'lokasi', 'departemen'])
            ->make(true);
    }
}
