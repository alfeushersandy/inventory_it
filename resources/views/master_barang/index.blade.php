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
                    <button onclick="cetakBarcode('{{route('barang.generate')}}')" class="btn btn-info btn-xs btn-flat" style="margin-left: 10px">Generate QR</button>
                </div>
                <div class="box-body table-responsive mt-2">
                    <form action="" method="post" class="form-barang">
                    @csrf
                        <table class="table table-striped table-bordered" style="text-align: center;">
                            <thead class="thead-dark">
                                <th width="5%">
                                    <input type="checkbox" name="select_all" id="select_all">
                                </th>
                                <th>#</th>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Kode Barang lama</th>
                                <th>Kategori</th>
                                <th>Merek</th>
                                <th>Tipe</th>
                                <th>Lokasi</th>
                                <th>Departemen</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('master_barang.form')
    {{-- @include('master_barang.kembali') --}}
@endsection

@push('scripts')
    <script>
        function format(d) {
            // `d` is the original data object for the row
            if(d.kategori_id == 3 || d.kategori_id == 4){
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
                        '<td colspan="6">Hardisk:</td>' +
                        '<td colspan="6">'+ d.hardisk + '</td>' +
                    '</tr>' +
                    '<tr>' +
                        '<td colspan="6">SSD:</td>' +
                        '<td colspan="6">'+ d.ssd + '</td>' +
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
            }else{
                return 'No Data To Show';
            }
        }

        let table;

        $(function() {
        table = $('.table').DataTable({
            ajax: {
                url: '{{ route('barang.data') }}',
            },
            columns: [
                {
                    data: 'select_all',
                    searchable: false,
                    sortable: false,
                },
                {
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
                    data: 'kode_barang_lama'
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
                {
                    data: 'aksi'
                }
            ],
        });

        $('[name=select_all]').on('click', function () {
            $(':checkbox').prop('checked', this.checked);
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
            console.log(kategori)
            if (kategori == 3 || kategori == 4) {
                $('.form-it').css('display', 'block');
                getKode(kategori);
            } else if(kategori == 'Pilih Kategori'){
                $('.form-it').css('display', 'none');
                $('#kode_barang').val('');
            }
            else {
                $('.form-it').css('display', 'none');
                getKode(kategori);
            }
        }

        function getKode(kategori){
            $.ajax({
                    url: '/getkode/' + kategori,
                    type: 'GET',
                    data: {
                    "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#kode_barang').val(data);
                    }
                })
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
            $('#modal-form [name=lokasi]').prop('disabled', false);
            $('#modal-form [name=lokasi_id]').prop('disabled', false);
            $('select[name="lokasi_id"]').empty();
            $('#modal-form [name=user]').prop('disabled', false);
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
            $('.form-it').css('display', 'none')
        }

        function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Barang');

        $('#modal-form form')[0].reset();
        $('#modal-form [name=_method]').val('put');

        $.get(url)
            .done((response) => {
                console.log(response)
                $('#modal-form form').attr('action', 'barang/'+response.id_barang);
                $('#modal-form [name=kategori_id]').val(response.kategori_id);
                if (response.kategori_id == 3 || response.kategori_id == 4) {
                    $('.form-it').css('display', 'block');
                    if(response.user){
                        $('#modal-form [name=lokasi]').attr('disabled', true);
                        $('#modal-form [name=lokasi_id]').attr('disabled', true);
                        $('#modal-form [name=user]').attr('disabled', true);
                        $('#modal-form [name=lokasi_id]').empty();
                    $('#modal-form [name=kode_barang]').val(response.kode_barang);
                    $('#modal-form [name=kode_barang_lama]').val(response.kode_barang_lama);
                    $('#modal-form [name=merek]').val(response.merek);
                    $('#modal-form [name=tipe]').val(response.tipe);
                    $('#modal-form [name=lokasi]').val(response.lokasi.nama_lokasi);
                    $('#modal-form [name="lokasi_id"]').append('<option value="' + response.lokasi_id +
                            '">' + response.lokasi.departemen + '</option>');
                    $('#modal-form [name=user]').val(response.user);
                    $('#modal-form [name=mainboard]').val(response.mainboard);
                    $('#modal-form [name=prosesor]').val(response.prosesor);
                    $('#modal-form [name=memori]').val(response.memori);
                    $('#modal-form [name=hardisk]').val(response.hardisk);
                    $('#modal-form [name=ssd]').val(response.ssd);
                    $('#modal-form [name=vga]').val(response.vga);
                    $('#modal-form [name=sound]').val(response.sound);
                    $('#modal-form [name=network]').val(response.network);
                    $('#modal-form [name=os]').val(response.os);
                    $('#modal-form [name=keyboard]').val(response.keyboard);
                    $('#modal-form [name=mouse]').val(response.mouse);
                    }else{
                        $('#modal-form [name=lokasi]').attr('disabled', false);
                        $('#modal-form [name=lokasi_id]').attr('disabled', false);
                        $('#modal-form [name=user]').attr('disabled', false);
                        $('#modal-form [name="lokasi_id"]').empty();
                    $('#modal-form [name=kode_barang]').val(response.kode_barang);
                    $('#modal-form [name=kode_barang_lama]').val(response.kode_barang_lama);
                    $('#modal-form [name=merek]').val(response.merek);
                    $('#modal-form [name=tipe]').val(response.tipe);
                    $('#modal-form [name=lokasi]').val(response.lokasi.nama_lokasi);
                    $('#modal-form [name="lokasi_id"]').append('<option value="' + response.lokasi_id +
                            '">' + response.lokasi.departemen + '</option>');
                    $('#modal-form [name=user]').val(response.user);
                    $('#modal-form [name=mainboard]').val(response.mainboard);
                    $('#modal-form [name=prosesor]').val(response.prosesor);
                    $('#modal-form [name=memori]').val(response.memori);
                    $('#modal-form [name=hardisk]').val(response.hardisk);
                    $('#modal-form [name=ssd]').val(response.ssd);
                    $('#modal-form [name=vga]').val(response.vga);
                    $('#modal-form [name=sound]').val(response.sound);
                    $('#modal-form [name=network]').val(response.network);
                    $('#modal-form [name=os]').val(response.os);
                    $('#modal-form [name=keyboard]').val(response.keyboard);
                    $('#modal-form [name=mouse]').val(response.mouse);
                    }
                    
                } 
                else {
                    if(response.user){
                        $('#modal-form [name=lokasi]').attr('disabled', true);
                        $('#modal-form [name=lokasi_id]').attr('disabled', true);
                        $('#modal-form [name=user]').attr('disabled', true);
                        $('.form-it').css('display', 'none');
                    $('#modal-form [name="lokasi_id"]').empty();
                    $('#modal-form [name=kode_barang]').val(response.kode_barang);
                    $('#modal-form [name=kode_barang_lama]').val(response.kode_barang_lama);
                    $('#modal-form [name=merek]').val(response.merek);
                    $('#modal-form [name=tipe]').val(response.tipe);
                    $('#modal-form [name=lokasi]').val(response.lokasi.nama_lokasi);
                    $('#modal-form [name="lokasi_id"]').append('<option value="' + response.lokasi_id +
                            '">' + response.lokasi.departemen + '</option>');
                    $('#modal-form [name=user]').val(response.user);
                    }else{
                        $('#modal-form [name=lokasi]').attr('disabled', false);
                        $('#modal-form [name=lokasi_id]').attr('disabled', false);
                        $('#modal-form [name=user]').attr('disabled', false);
                        $('.form-it').css('display', 'none');
                    $('#modal-form [name="lokasi_id"]').empty();
                    $('#modal-form [name=kode_barang]').val(response.kode_barang);
                    $('#modal-form [name=kode_barang_lama]').val(response.kode_barang_lama);
                    $('#modal-form [name=merek]').val(response.merek);
                    $('#modal-form [name=tipe]').val(response.tipe);
                    $('#modal-form [name=lokasi]').val(response.lokasi.nama_lokasi);
                    $('#modal-form [name="lokasi_id"]').append('<option value="' + response.lokasi_id +
                            '">' + response.lokasi.departemen + '</option>');
                    $('#modal-form [name=user]').val(response.user);
                    }
                   
                }
                
            })
            .fail((errors) => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }

        function addFormKembali(url) {
            $('#modalkembali').modal('show');
            $('#modalkembali .modal-title').text('Pengembalian Barang');
        }

        function cetakBarcode(url) {
            if ($('input:checked').length < 1) {
            alert('Pilih data yang akan dicetak');
            return;
        } else {
            $('.form-barang')
                .attr('target', '_blank')
                .attr('action', url)
                .submit();
        }
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
