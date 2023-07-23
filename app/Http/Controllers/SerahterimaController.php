<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Masterbarang;
use App\Models\Serah_terima;
use App\Models\Serah_terima_detail;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class SerahterimaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lokasi = Lokasi::select('nama_lokasi')->groupBy('nama_lokasi')   
                    ->orderBy('id_lokasi', 'asc')
                    ->get();
        return view('serah.index', [
            'lokasi' => $lokasi,
        ]);
    }

    public function getDept($lokasi){
        $dept = Lokasi::where('nama_lokasi', $lokasi)->get();
        return response()->json($dept);
    }

    public function data(){
        $permintaan = DB::table('serah_terima')
                        ->leftJoin('lokasi', 'lokasi.id_lokasi', '=', 'serah_terima.lokasi_id')
                        ->get();
        
        return datatables()
                ->of($permintaan)
                ->addIndexColumn()
                ->addColumn('tanggal_serah', function($permintaan){
                    return tanggal_indonesia($permintaan->tanggal_serah, false);
                })
                ->addColumn('tanggal_kembali', function($permintaan){
                    if($permintaan->tanggal_kembali){
                        return tanggal_indonesia($permintaan->tanggal_kembali, false);
                    }else{
                        return '';
                    }
                })
                ->addColumn('aksi', function($permintaan){
                    if($permintaan->status == 'Submited'){
                        return '
                            <a href="'. route('serah.diambil', $permintaan->id_serah) .'">diambil</a>
                            <button class="btn btn-sm btn-primary" onClick="showDetail(`'. route('serah.detail', $permintaan->id_serah) .'`)"><i class="bi bi-eye-fill"></i></button>
                            ';
                    }else{
                        return '
                            <button class="btn btn-sm btn-primary" onClick="showDetail(`'. route('serah.detail', $permintaan->id_serah) .'`)"><i class="bi bi-eye-fill"></i></button>
                            ';
                    }
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        $date = date('Y-m-d');
        $explode = explode('-', $date);
        $permintaan = Serah_terima::latest()->first() ?? new Serah_terima();
        $nomor_permintaan = $permintaan->nomor_serah;

            if($nomor_permintaan){
                $exp_nomor_permintaan = explode('/', $nomor_permintaan);
                 if(getRomawi($explode[1]) == $exp_nomor_permintaan[2] && $explode[0] ==$exp_nomor_permintaan[3]  ){
                     $nomor_serah_baru = (int) $exp_nomor_permintaan[0] + 1 ;
                    $nomor_serah = tambah_nol_didepan($nomor_serah_baru, 3) . "/" . "IT-INV" . "/" . $exp_nomor_permintaan[2] . "/" . $exp_nomor_permintaan[3];
                 }else{
                    $nomor_serah = "001" . "/" . "IT-INV" . "/" . getRomawi($explode[1]) . "/" . $explode[0];
                 }
            }else{
           $nomor_serah = "001" . "/" . "IT-INV" . "/" . getRomawi($explode[1]) . "/" . $explode[0];
        }

        $kode_permintaan1 = substr($permintaan->kode_serah,2);
        $kode_permintaan = (int) $kode_permintaan1 + 1;

        

        $permintaan = new Serah_terima();
        $permintaan->tanggal_input = now();
        $permintaan->kode_serah = 'PM'  . tambah_nol_didepan($kode_permintaan, 3);
        $permintaan->nomor_serah = $nomor_serah;
        $permintaan->user = $request->user;
        $permintaan->lokasi_id = $request->lokasi_id;
        $permintaan->jumlah_barang = 0; 
        $permintaan->tanggal_serah = $request->tanggal_serah;
        $permintaan->tanggal_kembali = null;
        $permintaan->status = 'Submited';
        $permintaan->save();

        session(['id_serah' => $permintaan->id_serah]);        
        return redirect()->route('detail.index');
    }

    public function detail(Serah_terima $detail){
        $detail = Serah_terima_detail::with(['barang', 'lokasi2', 'barang.kategori'])->where('serah_id', $detail->id_serah)  
                ->get();
        return datatables()
                ->of($detail)
                ->addIndexColumn()
                ->addColumn('kode_barang', function($detail){
                    return $detail->barang[0]->kode_barang;
                })
                ->addColumn('merek', function($detail){
                    return $detail->barang[0]->merek;
                })
                ->addColumn('tipe', function($detail){
                    return $detail->barang[0]->tipe;
                })
                ->addColumn('lokasi', function($detail){
                    return $detail->lokasi2->nama_lokasi;
                })
                ->addColumn('kategori', function($detail){
                    return $detail->barang[0]->kategori[0]->nama_kategori;
                })
                ->rawColumns(['kode_barang', 'merek', 'tipe', 'lokasi', 'kategori'])
                ->make(true);
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
    public function update(Request $request)
    {
        $permintaan = Serah_terima::findorfail($request->id_serah);
        $detail = Serah_terima_detail::leftjoin('serah_terima', 'serah_terima.id_serah', '=', 'serah_terima_detail.serah_id')
                ->where('id_serah', $permintaan->id_serah)->get();


        $permintaan->jumlah_barang = $detail->count();
        $permintaan->update();

        
        foreach ($detail as $item) {

            $barang = Masterbarang::find($item->barang_id);
            $barang->lokasi_id = $item->lokasi_tujuan_id;
            $barang->user = $item->user;
            $barang->status = 'Digunakan';
            $barang->update();
            
        }

        return redirect()->route('serah.selesai');
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

    public function selesai(){
        $id_serah = session('id_serah');
        return view('serah.selesai', ['id_serah' => $id_serah]);
    }

    public function cetak(){
        $id_serah = Session('id_serah');
        $serah_terima = Serah_terima::with(['lokasi'])->where('id_serah', $id_serah)->get();
        $detail = Serah_terima_detail::leftjoin('master_barang', 'master_barang.id_barang', '=', 'serah_terima_detail.barang_id')
                ->leftjoin('kategori', 'kategori.id_kategori', 'master_barang.kategori_id')
                ->with(['lokasi1', 'lokasi2'])
                ->where('serah_id', $id_serah)->get();


        $pdf = PDF::loadview('serah.pdf', ['detail' => $detail, 'serah_terima' => $serah_terima]);
        return $pdf->stream();
    }

    public function diambil(Serah_terima $serah){
        $permintaan = $serah;
        $permintaan->status = 'Barang Sudah Diambil';
        $permintaan->update();

        return redirect()->route('serah.index');
    }
}
