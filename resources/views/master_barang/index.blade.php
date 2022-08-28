@extends('layouts.master')


@section('title')
    Master Barang
@endsection

@section('content')
    @include('sweetalert::alert')


    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header with-border">
                    <button onclick="addForm('{{ route('barang.store') }}')" class="btn btn-success btn-xs btn-flat"><i
                            class="fa fa-plus-circle"></i> Tambah</button>
                </div>
                <div class="box-body table-responsive mt-2">
                    <table class="table table-striped table-bordered" style="text-align: center;">
                        <thead class="thead-dark">
                            <th>#</th>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Kategori</th>
                            <th>Merek</th>
                            <th>Tipe</th>
                            <th>Lokasi</th>
                            <th>Departemen</th>
                            <th>User</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('master_barang.form')
@endsection

@push('scripts')
    <script>
        function format(d) {
            // `d` is the original data object for the row
                return (
                    '<table class="table table-bordered" cellspacing="0" border="0" style="padding-left:50px;">' +
                    '<tr>' +
                        '<td colspan="6">Mainboard:</td>' +
                        '<td colspan="6">' + d.mainboard + '</td>' +
                    '</tr>' +
                    '<tr>' +
                        '<td colspan="6">Prosesor:</td>' +
                        '<td colspan="6">' + d.prosesor + '</td>' +
                    '</tr>' +
                    '<tr>' +
                        '<td colspan="6">Memori:</td>' +
                        '<td colspan="6">'+ d.memori + '</td>' +
                    '</tr>' +
                    '<tr>' +
                        '<td colspan="6">VGA:</td>' +
                        '<td colspan="6">'+ d.vga + '</td>' +
                    '</tr>' +
                    '<tr>' +
                        '<td colspan="6">Sound:</td>' +
                        '<td colspan="6">'+ d.sound + '</td>' +
                    '</tr>' +
                    '<tr>' +
                        '<td colspan="6">Network:</td>' +
                        '<td colspan="6">'+ d.network + '</td>' +
                    '</tr>' +
                    '<tr>' +
                        '<td colspan="6">Keyboard:</td>' +
                        '<td colspan="6">'+ d.keyboard + '</td>' +
                    '</tr>' +
                    '<tr>' +
                        '<td colspan="6">Mouse:</td>' +
                        '<td colspan="6">'+ d.mouse + '</td>' +
                    '</tr>' +
                    '<tr>' +
                        '<td colspan="6">Operating System:</td>' +
                        '<td colspan="6">'+ d.os + '</td>' +
                    '</tr>' +
                    '</table>'
                );
        }

        let table;

        $(function() {
        table = $('.table').DataTable({
            ajax: {
                url: '{{ route('barang.data') }}',
            },
            columns: [{
                    className: 'dt-control',
                    data: null,
                    sortable: false,
                    orderable: false,
                    defaultContent: '',
                },
                {
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'kode_barang'
                },
                {
                    data: 'kategori'
                },
                {
                    data: 'merek'
                },
                {
                    data: 'tipe'
                },
                {
                    data: 'lokasi'
                },
                {
                    data: 'departemen'
                },
                {
                    data: 'user'
                },
                {
                    data: 'status'
                },
            ],
        });
        // Add event listener for opening and closing details
        $('.table tbody').on('click', 'td.dt-control', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        });
        });



        function kategori() {
            let kategori = $('.kategori').val();
            if (kategori == 2 || kategori == 3) {
                $('.form-it').css('display', 'block');
            } else {
                $('.form-it').css('display', 'none');
            }
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


        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Master Barang');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
            $('.form-it').css('display', 'none')
        }
    </script>
@endpush
