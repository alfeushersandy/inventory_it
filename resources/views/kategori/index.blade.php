@extends('layouts.master')


@section('title')
    Master Kategori
@endsection

@section('content')

@include('sweetalert::alert')


    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header with-border">
                    <button onclick="addForm('{{ route('kategori.store') }}')" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"></i> Tambah</button>
                </div>
                <div class="box-body table-responsive mt-2">
                    <table class="table table-striped table-bordered" style="text-align: center;">
                        <thead class="thead-dark">
                            <th>No</th>
                            <th>Nama Kategori</th>
                            {{-- <th width="15%"><i class="fa fa-cog"></i></th> --}}
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@include('kategori.form')
@endsection

@push('scripts')
<script>
    let table;

$(function () {
    table = $('.table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            url: '{{ route('kategori.data') }}',
        },
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'nama_kategori'},
        ]
    });

})




    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah Kategori');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
    }
</script>
@endpush