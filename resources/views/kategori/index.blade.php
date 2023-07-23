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
                            <th>Kode Kategori</th>
                            <th>Nama Kategori</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
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
            {data: 'kode_kategori'},
            {data: 'nama_kategori'},
            {data: 'aksi'},
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

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Barang');

        $('#modal-form form')[0].reset();
        $('#modal-form [name=_method]').val('put');

        $.get(url)
            .done((response) => {
                $('#modal-form form').attr('action', 'kategori/'+response.id_kategori);
                $('#kode_kategori').val(response.kode_kategori)
                $('#nama_kategori').val(response.nama_kategori)
            }) 
            .fail((errors) => {
                alert('Tidak dapat menampilkan data');
                return;
            });

    }

    function deleteData(url) {
        if (confirm('Yakin ingin menghapus data terpilih?')) {
            $.post(url, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'delete'
                })
                .done((response) => {
                    table.ajax.reload();
                })
                .fail((errors) => {
                    alert('Tidak dapat menghapus data');
                    return;
                });
        }
    }
</script>
@endpush