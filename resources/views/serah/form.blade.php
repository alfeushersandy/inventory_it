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
                        <div class="form-group row mt-3">
                            <label for="lokasi" id="label_nama_aset" class="col-lg-2 col-lg-offset-2 control-label">Lokasi</label>
                            <div class="col-lg-6">
                                <select class="form-select" aria-label="Default select example" onChange="dept()" name="lokasi" id="lokasi" re>
                                    <option selected>Pilih Lokasi</option>
                                    @foreach ($lokasi as $item)
                                        <option value="{{$item->nama_lokasi}}">{{$item->nama_lokasi}}</option>
                                    @endforeach
                                  </select>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="lokasi" id="label_nama_aset" class="col-lg-2 col-lg-offset-2 control-label">Departemen</label>
                            <div class="col-lg-6">
                                <select class="form-select" aria-label="Default select example" name="lokasi_id" id="lokasi_id">
                                </select>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="user" id="label_nama_aset" class="col-lg-2 col-lg-offset-2 control-label">User</label>
                            <div class="col-lg-6">
                                <input type="text" name="user" id="user" class="form-control" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="tanggal_serah" id="label_nama_aset" class="col-lg-2 col-lg-offset-2 control-label">Tanggal Serah</label>
                            <div class="col-lg-6">
                                <input type="date" name="tanggal_serah" id="tanggal_serah" class="form-control" value="{{ date('Y-m-d') }}" required autofocus>
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