<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\Maintenance;
use App\Models\Masterbarang;
use App\Models\Serah_terima_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;

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

    public function getDept($lokasi)
    {
        $dept = DB::table('lokasi')
            ->leftJoin('departemen', 'departemen.id_dept', '==', 'lokasi.departemen')
            ->where('nama_lokasi', '=', $lokasi)
            ->select('nama_departemen')
            ->get();
        dd($dept);
    }

    public function getKode($kategori)
    {
        $kategori_final = Kategori::where('id_kategori', $kategori)->latest()->first();
        $barang = Masterbarang::where('kategori_id', $kategori)->latest()->first();
        $tahun = date('Y');
        $sub_tahun = substr($tahun, 2);

        if ($barang) {
            $kode_barang = $barang->kode_barang;
            $exp_kode_barang = explode('/', $kode_barang);
            if ($sub_tahun == $exp_kode_barang[1]) {
                $kode_barang_akhir1 = substr($exp_kode_barang[0], 3);
                $kode_barang_final = (int) $kode_barang_akhir1 + 1;
                $kode_barang_db = $kategori_final->kode_kategori . '-' . tambah_nol_didepan($kode_barang_final, 3) . '/' . $exp_kode_barang[1];
            } else {
                $kode_barang_db =  $kategori_final->kode_kategori . '-' . '001' . '/' . $sub_tahun;
            }
        } else {
            $kode_barang_db =  $kategori_final->kode_kategori . '-' . '001' . '/' . $sub_tahun;
        }

        return response()->json($kode_barang_db);
    }

    public function data()
    {
        $barang = Masterbarang::leftjoin('kategori', 'kategori.id_kategori', '=', 'master_barang.kategori_id')
            ->leftjoin('lokasi', 'lokasi.id_lokasi', '=', 'master_barang.lokasi_id')
            ->orderBy('id_barang', 'desc')
            ->get();

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
            ->addcolumn('select_all', function ($barang) {
                return '
                    <input type="checkbox" name="id_barang[]" value="' . $barang->id_barang . '">
                ';
            })
            ->addColumn('aksi', function ($barang) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`' . route('barang.edit', $barang->id_barang) . '`)" class="btn btn-xs btn-info btn-flat"><i class="bi bi-pencil-square"></i></button>
                    <button type="button" onclick="deleteData(`' . route('barang.destroy', $barang->id_barang) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="bi bi-trash3-fill"></i></button>
                </div>
                ';
            })
            ->rawColumns(['select_all', 'kategori', 'lokasi', 'departemen', 'aksi'])
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
        $kategori_final = Kategori::where('id_kategori', $kategori)->latest()->first();
        $barang = Masterbarang::where('kategori_id', $kategori)->latest()->first();
        $tahun = date('Y');
        $sub_tahun = substr($tahun, 2);

        if ($barang) {
            $kode_barang = $barang->kode_barang;
            $exp_kode_barang = explode('/', $kode_barang);
            if ($sub_tahun == $exp_kode_barang[1]) {
                $kode_barang_akhir1 = substr($exp_kode_barang[0], 3);
                $kode_barang_final = (int) $kode_barang_akhir1 + 1;
                $kode_barang_db = $kategori_final->kode_kategori . '-' . tambah_nol_didepan($kode_barang_final, 3) . '/' . $exp_kode_barang[1];
            } else {
                $kode_barang_db =  $kategori_final->kode_kategori . '-' . '001' . '/' . $sub_tahun;
            }
        } else {
            $kode_barang_db =  $kategori_final->kode_kategori . '-' . '001' . '/' . $sub_tahun;
        }

        $master_barang = new Masterbarang();
        $master_barang->kode_barang_lama = $request->kode_barang_lama;
        $master_barang->kategori_id = $kategori;
        $master_barang->merek = $request->merek;
        $master_barang->tipe = $request->tipe;
        $master_barang->lokasi_id = $request->lokasi_id;
        $master_barang->user = $request->user;
        $master_barang->mainboard = $request->mainboard;
        $master_barang->prosesor = $request->prosesor;
        $master_barang->memori = $request->memori . 'GB';
        $master_barang->hardisk = $request->hardisk;
        $master_barang->ssd = $request->ssd;
        $master_barang->vga = $request->vga;
        $master_barang->sound = $request->sound;
        $master_barang->network = $request->network;
        $master_barang->keyboard = $request->keyboard;
        $master_barang->mouse = $request->mouse;
        $master_barang->os = $request->os;
        $master_barang->status = $request->status;

        $cek_barang = Masterbarang::where('kode_barang', $request->kode_barang)->latest()->first();
        if ($cek_barang) {
            $master_barang->kode_barang = $kode_barang_db;
            $master_barang->save();

            alert()->success('Success', 'Kode Barang Sudah Digunakan, Kode Barang Anda Menjadi ' . $kode_barang_db);

            return redirect()->route('barang.index');
        } else {
            $master_barang->kode_barang = $request->kode_barang;
            $master_barang->save();

            alert()->success('Success', 'Data Barang Berhasil Ditambahkan');

            return redirect()->route('barang.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $kode_barang = $request->query('kode_barang');
        $barang = Masterbarang::with(['lokasi', 'kategori'])->where('kode_barang', $kode_barang)->first();
        $mutasi = Serah_terima_detail::where('barang_id', $barang->id_barang)->get();
        $service = Maintenance::with('serah')->where('barang_id', $barang->id_barang)->get();
        return view('master_barang.detail', [
            'barang' => $barang,
            'mutasi' => $mutasi,
            'service' => $service
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = Masterbarang::with('lokasi')->find($id);

        return response()->json($produk);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Masterbarang $barang)
    {
        if ($barang->user) {
            $barang->kode_barang_lama = $request->kode_barang_lama;
            $barang->kategori_id = $request->kategori_id;
            $barang->merek = $request->merek;
            $barang->tipe = $request->tipe;
            $barang->mainboard = $request->mainboard;
            $barang->prosesor = $request->prosesor;
            $barang->memori = $request->memori . 'GB';
            $barang->hardisk = $request->hardisk;
            $barang->ssd = $request->ssd;
            $barang->vga = $request->vga;
            $barang->sound = $request->sound;
            $barang->network = $request->network;
            $barang->keyboard = $request->keyboard;
            $barang->mouse = $request->mouse;
            $barang->os = $request->os;
            if ($request->lokasi_id == 7 && $request->user == null) {
                $barang->status = "Tersedia";
            } else {
                $barang->status = $request->status;
            }
            $barang->kode_barang = $request->kode_barang;
            $barang->update();
        } else {
            $barang->kode_barang_lama = $request->kode_barang_lama;
            $barang->kategori_id = $request->kategori_id;
            $barang->merek = $request->merek;
            $barang->tipe = $request->tipe;
            $barang->lokasi_id = $request->lokasi_id;
            $barang->user = $request->user;
            $barang->mainboard = $request->mainboard;
            $barang->prosesor = $request->prosesor;
            $barang->memori = $request->memori . 'GB';
            $barang->hardisk = $request->hardisk;
            $barang->ssd = $request->ssd;
            $barang->vga = $request->vga;
            $barang->sound = $request->sound;
            $barang->network = $request->network;
            $barang->keyboard = $request->keyboard;
            $barang->mouse = $request->mouse;
            $barang->os = $request->os;
            if ($request->lokasi_id == 7 && $request->user == null) {
                $barang->status = "Tersedia";
            } else {
                $barang->status = $request->status;
            }
            $barang->kode_barang = $request->kode_barang;
            $barang->update();
        }
        // $barang->kode_barang_lama = $request->kode_barang_lama;
        // $barang->kategori_id = $request->kategori_id;
        // $barang->merek = $request->merek;
        // $barang->tipe = $request->tipe;
        // $barang->lokasi_id = $request->lokasi_id;
        // $barang->user = $request->user;
        // $barang->mainboard = $request->mainboard;
        // $barang->prosesor = $request->prosesor;
        // $barang->memori = $request->memori . 'GB';
        // $barang->hardisk = $request->hardisk;
        // $barang->ssd = $request->ssd;
        // $barang->vga = $request->vga;
        // $barang->sound = $request->sound;
        // $barang->network = $request->network;
        // $barang->keyboard = $request->keyboard;
        // $barang->mouse = $request->mouse;
        // $barang->os = $request->os;
        // if($request->lokasi_id == 7 && $request->user == null){
        //     $barang->status = "Tersedia";
        // }else{
        //     $barang->status = "Digunakan";
        // }
        // $barang->kode_barang = $request->kode_barang;
        // $barang->update();

        alert()->success('Success', 'Edit data berhasil');

        return redirect()->route('barang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $databarang = Masterbarang::find($id);

        $databarang->delete();

        return response(null, 204);
    }

    public function generateQr(Request $request)
    {
        $databarang = array();
        foreach ($request->id_barang as $id) {
            $barang = Masterbarang::find($id);
            $qrcode[] = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate($barang->kode_barang));
            $databarang[] = $barang;
        }

        $no  = 1;
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('master_barang.qrcode', compact('databarang', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('barang.pdf');
    }
}
