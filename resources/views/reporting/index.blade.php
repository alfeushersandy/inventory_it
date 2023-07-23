@extends('layouts.master')


@section('title')
    Reporting Aset
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Lokasi</label>
                        <select class="form-select lokasi" aria-label="Default select example" name="lokasi">
                            <option value="All Lokasi" selected>All Lokasi</option>
                        @foreach ($lokasi as $item)
                            <option value="{{$item->nama_lokasi}}">{{$item->nama_lokasi}}</option>
                        @endforeach
                        </select>   
                    </div>
                    <div class="col-md-4">
                        <label for="">Kategori</label>
                        <select class="form-select kategori" aria-label="Default select example" name="kategori">
                            <option value="All Kategori" selected>All Kategori</option>
                        @foreach ($kategori as $item)
                            <option value="{{$item->nama_kategori}}">{{$item->nama_kategori}}</option>
                        @endforeach
                        </select>   
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-2">
                        <div class="statistics-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column justify-content-between align-items-start">
                                    <h5 class="content-desc">Total</h5>
                                    <h3 class="statistics-value">{{$barang}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body table-responsive mt-2">
                    <form action="" method="post" class="form-barang">
                    @csrf
                        <table class="table table-striped table-bordered" style="text-align: center;">
                            <thead class="thead-dark">
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
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- @include('master_barang.kembali') --}}
@endsection
@push('scripts')
<script>
    $(function(){
        $('.lokasi').on('change', function(){
            lokasi = $(this).val();
            kategori = $('.kategori').val();
            getTotal(lokasi, kategori)
        })

        $('.kategori').on('change', function(){
            lokasi = $('.lokasi').val();
            kategori = $(this).val();
            getTotal(lokasi, kategori)
        })
    })

    function getTotal(lokasi, kategori){
        $.ajax({
                url: '/report/' + lokasi,
                type: 'GET',
                data: {
                "_token": "{{ csrf_token() }}",
                lokasi : lokasi,
                kategori : kategori
                },
                dataType: "json",
                success: function(data) {
                    $('.statistics-value').html(data);
            }
        })
    }
</script>
@endpush