@extends('layouts.master')

@section('title')
    Transaksi Selesai
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-body">
                <div class="alert alert-success alert-dismissible">
                    <i class="fa fa-check icon"></i>
                    Data Mutasi Barang Dept. IT Berhasil ditambahkan
                </div>
            </div>
            <div class="box-footer">
                <a target="_blank" class="btn btn-primary btn-flat" href="{{route('serah.cetak')}}">Cetak Serah Terima</a>
                <a href="{{ route('serah.index') }}" class="btn btn-primary btn-flat">Kembali Ke Daftar Permintaan Barang</a>
            </div>
        </div>
    </div>
</div>
@endsection