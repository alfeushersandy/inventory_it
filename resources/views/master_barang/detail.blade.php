@extends('layouts.master')

@section('title')
    Detail Barang
@endsection

@section('content')
<div class="accordion" id="accordionExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Detail Barang
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <table>
                        <tr>
                            <td><b>Kode Barang</b></td>
                            <td>:</td>
                            <td>{{$barang->kode_barang}}</td>
                        </tr>
                        <tr>
                            <td>Kode Barang Lama</td>
                            <td>:</td>
                            <td>{{$barang->kode_barang_lama}}</td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td>:</td>
                            <td>{{$barang->kategori[0]->nama_kategori}}</td>
                        </tr>
                        <tr>
                            <td>Lokasi</td>
                            <td>:</td>
                            <td>{{$barang->lokasi}}</td>
                        </tr>
                        <tr>
                            <td>Departemen</td>
                            <td>:</td>
                            <td>{{$barang->lokasi}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table>
                        <tr>
                            <td>Merk</td>
                            <td>:</td>
                            <td>{{$barang->merek}}</td>
                        </tr>
                        <tr>
                            <td>Tipe</td>
                            <td>:</td>
                            <td>{{$barang->tipe}}</td>
                        </tr>
                        <tr>
                            <td>User</td>
                            <td>:</td>
                            <td>{{$barang->user}}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td>{{$barang->status}}</td>
                        </tr>
                    </table>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          History Service
        </button>
      </h2>
      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <div class="box-body table-responsive mt-4">
                <table class="table table-striped table-bordered" style="text-align: center;">
                    <thead class="thead-dark">
                        <th>Kode Serah</th>
                        <th>Lokasi</th>
                        <th>Barang</th>
                        <th>PIC</th>
                        <th>Tanggal Service</th>
                        <th>Tanggal Selesai</th>
                        <th>Biaya</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @foreach ($service as $item)
                        <tr>
                            <td>{{$item->serah[0]->kode_serah}}</td>
                            <td>{{$item->lokasi[0]->nama_lokasi}}</td>
                            <td>{{$item->barang[0]->tipe}}</td>
                            <td>{{$item->pic}}</td>
                            <td>{{tanggal_indonesia($item->tanggal_service, false)}}</td>
                            @if ($item->tanggal_selesai_service)
                                <td>{{tanggal_indonesia($item->tanggal_selesai_service, false)}}</td>
                            @else
                                <td>{{$item->tanggal_selesai_service}}</td>
                            @endif
                            <td>{{$item->biaya}}</td>
                            <td>{{$item->ket}}</td>
                            <td>{{$item->status}}</td>
                        </tr>
                    @endforeach      
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          History Transfer Barang
        </button>
      </h2>
      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <div class="box-body table-responsive mt-4">
                <table class="table table-striped table-bordered" style="text-align: center;">
                    <thead class="thead-dark">
                        <th>Kode Serah</th>
                        <th>Merek</th>
                        <th>Tipe</th>
                        <th>User</th>
                        <th>Lokasi</th>
                        <th>Tanggal Serah</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @foreach ($mutasi as $mutasi)
                                <tr>
                                    <td>{{$mutasi->serah[0]->kode_serah}}</td>
                                    <td>{{$mutasi->barang[0]->merek}}</td>
                                    <td>{{$mutasi->barang[0]->tipe}}</td>
                                    <td>{{$mutasi->user}}</td>
                                    <td>{{$mutasi->lokasi_tujuan_id}}</td>
                                    <td>{{tanggal_indonesia($mutasi->tanggal_serah, false)}}</td>
                                    @if ($mutasi->tanggal_kembali)
                                        <td>{{tanggal_indonesia($mutasi->tanggal_kembali, false)}}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    @if ($mutasi->status == 0)
                                        <td>Sudah Kembali</td>
                                    @else
                                        <td>Belum Kembali</td>
                                    @endif
                                    
                                </tr>  
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection