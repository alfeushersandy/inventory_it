@extends('layouts.master')


@section('title')
    Barang Kembali
@endsection

@section('content')

@include('sweetalert::alert')


    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-body table-responsive mt-4">
                    <table class="table table-striped table-bordered" style="text-align: center;">
                        <thead class="thead-dark">
                            <th>No</th>
                            <th>Nomor Serah</th>
                            <th>Kode Barang</th>
                            <th>Merek</th>
                            <th>Tipe</th>
                            <th>User</th>
                            <th>Tanggal Serah</th>
                            <th>Status</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                        <tbody>
                            @foreach ($master as $barang)
                                <tr>
                                    <td>1</td>
                                    <td>{{$barang->serah[0]->nomor_serah}}</td>
                                    <td>{{$barang->barang[0]->kode_barang}}</td>
                                    <td>{{$barang->barang[0]->merek}}</td>
                                    <td>{{$barang->barang[0]->tipe}}</td>
                                    <td>{{$barang->barang[0]->user}}</td>
                                    <td>{{$barang->tanggal_serah}}</td>
                                    <td>{{$barang->status}}</td>
                                    <td>
                                            <a class="btn btn-warning" href="{{route('kembali.selesai', $barang->id_serah_detail)}}">Selesai</a>
                                            <a class="btn btn-warning mt-2" href="{{route('kembali.rusak', $barang->id_serah_detail)}}"> Rusak </a>
                                    </td>
                                </tr>  
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        let table;
        $(function(){
            table = $('.table').DataTable();
        })
        function addFormKembali(url) {
            $('#modalkembali').modal('show');
            $('#modalkembali .modal-title').text('Pengembalian Barang');
            $('#modalkembali form').attr('action', url);
        }

    </script>
@endpush