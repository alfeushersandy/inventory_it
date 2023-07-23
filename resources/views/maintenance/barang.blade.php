<!-- Modal -->
<div class="modal fade" id="modal_barang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_barang_title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="box-body table-responsive mt-2">
            <table class="table table-striped table-bordered" style="text-align: center;">
                <thead class="thead-dark">
                    <th>Kode Barang</th>
                    <th>Merek</th>
                    <th>Tipe</th>
                    <th>Lokasi</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach ($barang as $item)
                        <tr>
                            <td>{{$item->kode_barang}}</td>
                            <td>{{$item->merek}}</td>
                            <td>{{$item->tipe}}</td>
                            <td>{{$item->lokasi_id}}</td>
                            <td>{{$item->user}}</td>
                            <td>{{$item->status}}</td>
                            <td>
                                <a href="#" class="btn btn-primary btn-xs btn-flat" 
                                 onclick="pilihBarang('{{$item->id_barang}}', '{{$item->kode_barang}}')">
                                pilih
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>