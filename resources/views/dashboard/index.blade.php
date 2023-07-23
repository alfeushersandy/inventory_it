@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container">
    @foreach ($kategori as $item)
        <div class="row">
            <div class="col-12">
                <h2 class="content-title">{{$item->nama_kategori}}</h2>
            </div>
            @php
                $total  = DB::table('master_barang')->where('kategori_id', $item->id_kategori)->count();
                $tersedia = DB::table('master_barang')->where('kategori_id', $item->id_kategori)->where('status', 'Tersedia')->count();
                $digunakan = DB::table('master_barang')->where('kategori_id', $item->id_kategori)->where('status', 'Digunakan')->count();
                $onservice = DB::table('master_barang')->where('kategori_id', $item->id_kategori)->where('status', 'Onservice')->count();
                $rusak = DB::table('master_barang')->where('kategori_id', $item->id_kategori)->where('status', 'Rusak')->count();
            @endphp

            <div class="row">
                <div class="col-12 col-md-6 col-lg-2">
                    <div class="statistics-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h5 class="content-desc">Total</h5>
                                <h3 class="statistics-value">{{$total}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-2">
                    <div class="statistics-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h5 class="content-desc">Tersedia</h5>
                                <h3 class="statistics-value">{{$tersedia}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-2">
                    <div class="statistics-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h5 class="content-desc">Digunakan</h5>
                                <h3 class="statistics-value">{{$digunakan}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-2">
                    <div class="statistics-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h5 class="content-desc">On Service</h5>
                                <h3 class="statistics-value">{{$onservice}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-2">
                    <div class="statistics-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h5 class="content-desc">Rusak</h5>
                                <h3 class="statistics-value">{{$rusak}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div> 
@endsection