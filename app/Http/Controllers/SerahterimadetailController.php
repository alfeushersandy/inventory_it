<?php

namespace App\Http\Controllers;

use App\Models\Masterbarang;
use App\Models\Serah_terima;
use App\Models\Serah_terima_detail;
use Illuminate\Http\Request;

class SerahterimadetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_serah = session('id_serah');
        $serah_barang = Serah_terima_detail::where('serah_id', $id_serah)->get('barang_id');
        $barang = Masterbarang::leftjoin('kategori', 'kategori.id_kategori', '=', 'master_barang.kategori_id')
                            ->where('status', 'Tersedia')
                            ->whereNotIn('id_barang', $serah_barang)
                            ->get();
        $serah_terima = Serah_terima::find($id_serah);

        if(!$serah_terima){
            abort(404);
        }

        return view('serah_detail.index', [
            'barang' => $barang,
            'id_serah' => $id_serah,
            'serah_terima' => $serah_terima
        ]);
    }

    public function data($id){
        $detail = Serah_terima_detail::leftjoin('master_barang', 'master_barang.id_barang', '=', 'serah_terima_detail.barang_id')
                ->leftjoin('lokasi', 'lokasi.id_lokasi', '=', 'master_barang.lokasi_id')
                ->where('serah_id', $id)
                ->get();

        return datatables()
                ->of($detail)
                ->addIndexColumn()
                ->addColumn('lokasi_awal', function($detail){
                    return $detail->nama_lokasi;
                })
                ->addColumn('departemen', function($detail){
                    return $detail->departemen;
                })
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
    public function store($id)
    {
        $barang = Masterbarang::where('id_barang', $id)->first();
        if (! $barang) {
            toast('barang belum terpilih', 'error');
        }

        $serah_terima = Serah_terima::find(session('id_serah'));


        $detail = new Serah_terima_detail();
        $detail->serah_id = $serah_terima->id_serah;
        $detail->kode_serah_terima = $serah_terima->nomor_serah;
        $detail->barang_id = $barang->id_barang;
        $detail->lokasi_awal_id = $barang->lokasi_id;
        $detail->lokasi_tujuan_id = $serah_terima->lokasi_id;
        $detail->user = $serah_terima->user;
        $detail->tanggal_serah = $serah_terima->tanggal_serah;
        $detail->tanggal_kembali = null;
        $detail->status = true;
        $detail->save();


        return redirect()->route('detail.index');
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
