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
                            <label for="kategori" id="label_nama_aset" class="col-lg-2 col-lg-offset-2 control-label">Kategori</label>
                            <div class="col-lg-6">
                                <select class="form-select kategori" onChange="kategori()" aria-label="Default select example" name="kategori_id" id="kategori_id">
                                    <option selected>Pilih Kategori</option>
                                    @foreach ($kategori as $key => $item)
                                        <option value="{{$key}}">{{$item}}</option>
                                    @endforeach
                                  </select>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="kode_barang" class="col-lg-2 col-lg-offset-2 control-label">Kode Barang</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="kode_barang" id="kode_barang" readonly> 
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="kode_barang_lama" class="col-lg-2 col-lg-offset-2 control-label">Kode Barang Lama</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="kode_barang_lama" id="kode_barang_lama" autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="Merek" class="col-lg-2 col-lg-offset-2 control-label">Merek</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="merek" id="merek">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="tipe" class="col-lg-2 col-lg-offset-2 control-label">Tipe</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="tipe" id="tipe">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="lokasi" id="label_nama_aset" class="col-lg-2 col-lg-offset-2 control-label">Lokasi</label>
                            <div class="col-lg-6">
                                <select class="form-select" aria-label="Default select example" onChange="dept()" name="lokasi" id="lokasi">
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
                            <label for="user" class="col-lg-2 col-lg-offset-2 control-label">User</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="user" id="user">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-it" style="display: none;">
                            <div class="form-group row mt-3">
                                <label for="user" class="col-lg-2 col-lg-offset-2 control-label">Mainboard</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="mainboard" id="mainboard">
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="user" class="col-lg-2 col-lg-offset-2 control-label">Prosesor</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="prosesor" id="prosesor">
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="user" class="col-lg-2 col-lg-offset-2 control-label">Memori</label>
                                <div class="col-lg-6">
                                    <input type="number" class="form-control" name="memori" id="memori">
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="hardisk" class="col-lg-2 col-lg-offset-2 control-label">Hardisk</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="hardisk" id="hardisk">
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="hardisk" class="col-lg-2 col-lg-offset-2 control-label">SSD</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="ssd" id="ssd">
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="user" class="col-lg-2 col-lg-offset-2 control-label">VGA</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="vga" id="vga" value="O/B">
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="user" class="col-lg-2 col-lg-offset-2 control-label">Sound</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="sound" id="sound" value="O/B">
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="user" class="col-lg-2 col-lg-offset-2 control-label">Network</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="network" id="network" value="O/B">
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="user" class="col-lg-2 col-lg-offset-2 control-label">Operating Sistem</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="os" id="os">
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="user" class="col-lg-2 col-lg-offset-2 control-label">keyboard</label>
                                <div class="col-lg-6">
                                    <select class="form-select" aria-label="Default select example" name="keyboard" id="keyboard">
                                    <option value="1" selected>Ada</option>
                                    <option value="0">Tidak Ada</option>
                                    </select>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="user" class="col-lg-2 col-lg-offset-2 control-label">Mouse</label>
                                <div class="col-lg-6">
                                    <select class="form-select" aria-label="Default select example" name="mouse" id="mouse">
                                    <option value="1" selected>Ada</option>
                                    <option value="0">Tidak Ada</option>
                                    </select>
                                    <span class="help-block with-errors"></span>
                                </div>
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