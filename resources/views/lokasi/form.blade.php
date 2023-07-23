<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="post" class="form-horizontal">
            @csrf
            @method('post')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="nama_lokasi" id="label_nama_aset" class="col-lg-2 col-lg-offset-2 control-label">Nama Lokasi</label>
                            <div class="col-lg-6">
                                <input type="text" name="nama_lokasi" id="nama_lokasi" class="form-control" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="nama_lokasi" id="label_nama_aset" class="col-lg-2 col-lg-offset-2 control-label">Pilih Departemen</label>
                            <div class="col">
                                @foreach ($dept as $item)
                                    <input type="checkbox" name="departemen[]" id="departemen[]" value="{{$item->nama_departemen}}">
                                    <label for="departemen[]">{{$item->nama_departemen}}</label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
        </form>
    </div>
</div>