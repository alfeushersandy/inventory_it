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
                    <button onclick="addForm('{{ route('serah.store') }}')" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"></i> Tambah</button>
                </div>
                <div class="box-body table-responsive mt-4">
                    <table class="table table-striped table-bordered" id="table" style="text-align: center;">
                        <thead class="thead-dark">
                            <th>No</th>
                            <th>Kode Serah</th>
                            <th>User/Pemohon</th>
                            <th>Lokasi</th>
                            <th>Departemen</th>
                            <th>Jumlah Barang</th>
                            <th>Tanggal Serah</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@include('serah.form')
@include('serah.detail')
@endsection

@push('scripts')
<script>
    let table, table1

$(function () {
    table = $('#table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            url: '{{ route('serah.data') }}',
        },
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'kode_serah'},
            {data: 'user'},
            {data: 'nama_lokasi'},
            {data: 'departemen'},
            {data: 'jumlah_barang'},
            {data: 'tanggal_serah'},
            {data: 'tanggal_kembali'},
            {data: 'status'},
            {data: 'aksi'},

        ]
    });

    
    
})
table1 = $('#table-detail').DataTable({
    processing: true,
    bSort: false,
    dom: 'Brt',
    columns: [
        {data: 'kode_barang'},
        {data: 'kategori'},
        {data: 'merek'},
        {data: 'tipe'},
        {data: 'lokasi'},
        {data: 'user'},
        {data: 'tanggal_serah'},
        {data: 'tanggal_kembali'},
    ]
})

   

    function showDetail(url) {
            $('#modal_detail').modal('show');

            table1.ajax.url(url);
            table1.ajax.reload();
        }


    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah Mutasi Barang');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
    }

    function dept() {
            let lokasi = $('#lokasi').val();
            $.ajax({
                url: '/getlokasi/' + lokasi,
                type: 'GET',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    $('select[name="lokasi_id"]').empty();
                    $.each(data, function(key, departemen) {
                        $('select[name="lokasi_id"]').append('<option value="' + departemen.id_lokasi +
                            '">' + departemen.departemen + '</option>');
                    });
                }
            })
        }
</script>
@endpush