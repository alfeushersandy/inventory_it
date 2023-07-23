@extends('layouts.master')

@section('title')
    Input Data Maintenance
@endsection

@section('content')
    <div class="container-fluid">
        <div class="col-md-6" style="margin-top: 100px">
            <form action="{{route('maintenance.store')}}" method="POST">
                @csrf
                @method('post')
                <div class="mb-3">
                    <div class="row">
                        <label for="barang" class="form-label">Kode Barang</label>
                        <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="{{$barang->kode_barang}}">
                        <input type="hidden" class="form-control" id="id_serah" name="id_serah" value="{{$detail->serah_id}}">
                        <input type="hidden" class="form-control" id="id_barang" name="id_barang" value="{{$barang->id_barang}}">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal Service</label>
                    <input type="date" class="form-control" id="tanggal_service" name="tanggal_service" value="{{date('Y-m-d')}}">
                </div>
                <div class="mb-3">
                    <label for="ket" class="form-label">Keterangan</label>
                    <textarea class="form-control" id="ket" name="ket"></textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection