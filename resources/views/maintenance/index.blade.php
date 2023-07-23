@extends('layouts.master')


@section('title')
    Maintenance Barang
@endsection

@section('content')

@include('sweetalert::alert')


    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header with-border">
                    <a href="{{route('maintenance.form')}}" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"></i> Tambah</a>
                </div>
                <div class="box-body table-responsive mt-4">
                    <table class="table table-striped table-bordered" style="text-align: center;">
                        <thead class="thead-dark">
                            <th>No</th>
                            <th>Kode Serah</th>
                            <th>Lokasi</th>
                            <th>Barang</th>
                            <th>PIC</th>
                            <th>Tanggal Service</th>
                            <th>Tanggal Selesai</th>
                            <th>Biaya</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                        <tbody>
                            @foreach ($maintenance as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    @if ($item->serah_id)
                                        <td>{{$item->serah[0]->nomor_serah}}</td>
                                    @else
                                        <td></td>
                                    @endif
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
                                    <td>
                                        @if ($item->status == 'Submited')
                                            <button onclick="showPic('{{route('maintenance.service', $item->id_maintenance)}}')" class="btn btn-primary">Proses</button>
                                        @elseif ($item->status == "On Service")
                                            <button onclick="selesai('{{route('maintenance.selesai', $item->id_maintenance)}}')" class="btn btn-success">Selesai</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('maintenance.pic')
    @include('maintenance.selesai')
@endsection
@push('scripts')
<script>
    let table, table1;
    $(function(){
        table = $('.table').DataTable();
        
    })



    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah Master Barang');
    
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
    }

    function showPic(url) {
        $('#modal-pic').modal('show');
        $('#modal-pic .modal-title').text('Pelaksana');

        $('#modal-pic form')[0].reset();
        $('#modal-pic form').attr('action', url);
    }

    function selesai(url) {
        $('#modal-selesai').modal('show');
        $('#modal-selesai .modal-title').text('Service Selesai');

        $('#modal-selesai form')[0].reset();
        $('#modal-selesai form').attr('action', url);
    }

    
</script>
@endpush