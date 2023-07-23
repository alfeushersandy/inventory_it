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
                            <label for="kode_kategori" id="label_nama_aset" class="col-lg-3 col-lg-offset-3 control-label">Kode Kategori</label>
                            <div class="col-lg-6">
                                <input type="text" name="kode_kategori" id="kode_kategori" class="form-control" maxlength="2" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="nama_kategori" id="label_nama_aset" class="col-lg-3 col-lg-offset-3 control-label">Nama Kategori</label>
                            <div class="col-lg-6">
                                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required autofocus>
                                <span class="help-block with-errors"></span>
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