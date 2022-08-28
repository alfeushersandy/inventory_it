<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\Masterbarang;
use Illuminate\Http\Request;

class MasterbarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all()->pluck('nama_kategori', 'id_kategori');
        $lokasi = Lokasi::select('nama_lokasi')->groupBy('nama_lokasi')   
                    ->orderBy('id_lokasi', 'asc')
                    ->get();
        $barang = Masterbarang::with(['kategori', 'lokasi'])->get();
        return view('master_barang.index', compact('kategori', 'lokasi', 'barang'));
    }

    public function getDept($lokasi){
        $dept = Lokasi::where('nama_lokasi', $lokasi)->get();
        return response()->json($dept);
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
            ->rawColumns(['kategori', 'lokasi', 'departemen'])
            ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kategori = $request->kategori_id;
        $barang = Masterbarang::where('kategori_id', $kategori)->latest()->first() ?? new Masterbarang();
        if($kategori == 4 || $kategori == 3){
            $kode_barang1 = substr($barang->kode_barang,2);
        }else if($kategori == 1){
            $kode_barang1 = substr($barang->kode_barang,1);
        }else{
            $kode_barang1 = $barang->kode_barang;
        }
        $kode_barang = (int) $kode_barang1 + 1 ;

        $master_barang = new Masterbarang();

        if($kategori == 1){
            $master_barang->kode_barang = 'P'. tambah_nol_didepan($kode_barang,3);
            $master_barang->keyboard = false;
            $master_barang->mouse = false;
        }else if($kategori == 2){
            $master_barang->kode_barang = tambah_nol_didepan($kode_barang,4);
        }else if($kategori == 3){
            $master_barang->kode_barang = 'NB'. tambah_nol_didepan($kode_barang,3);
        }else{
            $master_barang->kode_barang = 'MT'. tambah_nol_didepan($kode_barang,3);
            $master_barang->keyboard = false;
            $master_barang->mouse = false;
        }

        $master_barang->kode_barang_lama = $request->kode_barang_lama;
        $master_barang->kategori_id = $kategori;
        $master_barang->merek = $request->merek;
        $master_barang->tipe = $request->tipe;
        $master_barang->lokasi_id = $request->lokasi_id;
        $master_barang->user = $request->user;
        $master_barang->mainboard = $request->mainboard;
        $master_barang->prosesor = $request->prosesor;
        $master_barang->memori = $request->memori . 'GB';
        $master_barang->vga = $request->vga;
        $master_barang->sound = $request->sound;
        $master_barang->network = $request->network;
        $master_barang->os = $request->os;
        if($request->lokasi_id == 18){
            $master_barang->status = "Tersedia";
        }else{
            $master_barang->status = "Digunakan";
        }
        $master_barang->save();

        toast('Data Barang Berhasil Ditambahkan', 'success');

        return redirect()->route('barang.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
