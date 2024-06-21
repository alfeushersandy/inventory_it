<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Masterbarang;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();

        $data = $kategori->map(function ($item) {
            return [
                'nama_kategori' => $item->nama_kategori,
                'total' => Masterbarang::where('kategori_id', $item->id_kategori)->count(),
                'tersedia' => Masterbarang::where('kategori_id', $item->id_kategori)->where('status', 'Tersedia')->count(),
                'digunakan' => Masterbarang::where('kategori_id', $item->id_kategori)->where('status', 'Digunakan')->count(),
                'onservice' => Masterbarang::where('kategori_id', $item->id_kategori)->where('status', 'Onservice')->count(),
                'rusak' => Masterbarang::where('kategori_id', $item->id_kategori)->where('status', 'Rusak')->count(),
            ];
        });

        return response()->json($data);
    }
}
