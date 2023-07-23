<?php

namespace App\Http\Controllers;

use App\Models\Masterbarang;
use App\Models\Serah_terima;
use App\Models\Serah_terima_detail;
use Illuminate\Http\Request;

class BarangkembaliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master = Serah_terima_detail::with('barang', 'serah')->where('status', 1)->get();
        return view('kembali.index', compact('master'));
    }

    public function kembali_selesai(Serah_terima_detail $detail){
        $detail->status = 0;
        $detail->tanggal_kembali = now();
        $detail->update();

        $master_barang = Masterbarang::find($detail->barang_id);
        $master_barang->lokasi_id = 7;
        $master_barang->user = "";
        $master_barang->status = "Tersedia";
        $master_barang->update();

        $serah_by_id = Serah_terima_detail::where('serah_id', $detail->serah_id)->count();
        $serah = Serah_terima_detail::where('serah_id', $detail->serah_id)->where('status', 0)->count();
        $serah_terima = Serah_terima::find($detail->serah_id);
        if($serah !== $serah_by_id){
            return redirect()->route('serah.index');
        }else{
            $serah_terima->tanggal_kembali = now();
            $serah_terima->status = "Seluruh Barang Sudah Dikembalikan";
            $serah_terima->update();
            return redirect()->route('serah.index');
        }

    }

    public function kembali_rusak(Serah_terima_detail $detail){
        return redirect()->route('maintenance.formkembali', $detail->id_serah_detail);
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
        //
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
