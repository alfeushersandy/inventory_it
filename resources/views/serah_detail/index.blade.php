@extends('layouts.master')


@section('title')
    Mutasi Barang
@endsection

@section('content')

@include('sweetalert::alert')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <table>
                    <tr>
                        <td>Kode Permintaan</td>
                        <td>: {{$serah_terima->kode_serah}}</td>
                    </tr>
                    <tr>
                        <td>User/pemohon</td>
                        <td>: {{$serah_terima->user}}</td>
                    </tr>
                    <tr>
                        <td>Hari,Tanggal</td>
                        <td>: {{ tanggal_indonesia(date('Y-m-d')) }}</td>
                    </tr>
                    <tr>
                        <td>Tujuan</td>
                        <td>: {{$serah_terima->lokasi[0]->nama_lokasi}}</td>
                    </tr>
                    <tr>
                        <td>Departemen</td>
                        <td>: {{$serah_terima->lokasi[0]->departemen}}</td>
                    </tr>
                </table>
            </div>
            <div class="box-body mt-4">
                    
                <form class="form-produk mb-4">
                    @csrf
                    <div class="form-group row">
                        <label for="kode_produk" class="col-lg-2">Kode Barang :</label>
                        <div class="col-lg-2">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button onclick="tampilBarang()" class="btn btn-info btn-flat" type="button">barang</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-stiped table-bordered table-pembelian">
                        <thead class="table-primary">
                            <th width="5%">No</th>
                            <th>kode Barang</th>
                            <th>Merek</th>
                            <th>Type</th>
                            <th>Lokasi Sekarang</th>
                            <th>Departemen</th>
                        </thead>
                    </table>
                </div>

                <div class="row"> 
                    <div class="col-lg-4">
                        <form action="{{route('serah.update')}}" class="form-detail" method="post">
                            @csrf
                            <input type="hidden" name="id_serah" value="{{$id_serah}}">
                        </form>
                    </div>
                </div>
            </div>

            <div class="box-footer d-flex flex-row-reverse">
                <button type="submit" class="btn btn-primary btn-sm btn-flat pull-right btn-simpan"><i class="fa fa-floppy-o"></i> Simpan Transaksi</button>
            </div>
        </div>
    </div>
</div>
@include('serah_detail.barang')
@endsection

@push('scripts')
<script>
    let table, table2;

$(function () {
    table = $('.table-pembelian').DataTable({
        searching:false,
        paging:false,
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            url: '{{ route('serah_detail.data', $id_serah) }}',
        },
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'kode_barang', sortable: false},
            {data: 'merek', sortable: false},
            {data: 'tipe', sortable: false},
            {data: 'lokasi_awal', sortable: false},
            {data: 'departemen', sortable: false},
        ]
    });

    table2 = $('.table-barang').DataTable();

    $('.btn-simpan').on('click', function () {
            $('.form-detail').submit();
        });

})

    function tampilBarang() {
           $('#modal-barang').modal('show');
        }


    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah Mutasi Barang');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
    }
</script>
@endpush