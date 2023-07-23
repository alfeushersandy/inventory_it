<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Maintenance;
use App\Models\Masterbarang;
use App\Models\Serah_terima_detail;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maintenance = Maintenance::with(['lokasi', 'barang', 'serah'])->get();
        return view('maintenance.index', compact('maintenance'));
    }

    public function form(){
        $barang = Masterbarang::all();
        return view('maintenance.form', compact('barang'));
    }

    public function formKembali(Serah_terima_detail $detail){
        $detail = $detail;
        $barang = Masterbarang::find($detail->barang_id);
        return view('maintenance.formkembali', compact('barang', 'detail'));
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
        $barang = Masterbarang::find($request->id_barang);

        $maintenance = new Maintenance();
        $maintenance->serah_id = $request->id_serah;
        $maintenance->barang_id = $barang->id_barang;
        $maintenance->lokasi_id = $barang->lokasi_id;
        $maintenance->pic = '';
        $maintenance->tanggal_service = $request->tanggal_service;
        $maintenance->ket = $request->ket;
        $maintenance->status = "Submited";
        $maintenance->save();

        return redirect()->route('maintenance.index');
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

    public function tindakLanjut(Request $request, Maintenance $maintenance) {
        $maintenance->pic = $request->pic;
        $maintenance->status = 'On Service';
        $maintenance->update();

        $barang = Masterbarang::find($maintenance->barang_id);
        $barang->status = 'On Service';
        $barang->update();

        return redirect()->route('maintenance.index');

    }

    public function selesai(Request $request, Maintenance $maintenance){
        $maintenance->status = "Selesai";
        $maintenance->tanggal_selesai_service = $request->tanggal_selesai;
        $maintenance->biaya = $request->biaya;
        $maintenance->update();

        $barang = Masterbarang::find($maintenance->barang_id);
        if($barang->user !== ""){
            $barang->status = "Digunakan";
            $barang->update();
        }else{
            $barang->status = "Tersedia";
            $barang->update();
        }

        return redirect()->route('maintenance.index');

    }
}
