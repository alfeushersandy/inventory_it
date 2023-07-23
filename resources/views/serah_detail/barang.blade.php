<div class="modal fade" id="modal-barang" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Aset</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-barang">
                    <thead>
                        <th width="5%">No</th>
                        <th>Kode barang</th>
                        <th>Kategori</th>
                        <th>Merek</th>
                        <th>Tipe</th>
                        <th>Status</th>
                        <th><i class="fa fa-cog"></i></th>
                    </thead>
                    <tbody>
                        @foreach ($barang as $key => $item)
                            <tr>
                                <td width="5%">{{ $key+1 }}</td>
                                <td><span class="label label-success">{{ $item->kode_barang }}</span></td>
                                <td>{{ $item->nama_kategori }}</td>
                                <td>{{ $item->merek }}</td>
                                <td>{{ $item->tipe }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <a href="{{route('detail.store', $item->id_barang)}}" class="btn btn-primary btn-xs btn-flat">
                                        Pilih
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>