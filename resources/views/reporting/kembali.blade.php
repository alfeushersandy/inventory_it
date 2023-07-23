<!-- Modal -->
<div class="modal fade" id="modalkembali" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalkembaliLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalkembaliLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('kembali.kembali')}}" method="POST">
            <div class="form-group row">
                <label for="kategori" id="label_nama_aset" class="col-lg-2 col-lg-offset-2 control-label">Status</label>
                <div class="col-lg-6">
                    <select class="form-select" aria-label="Default select example" name="status" id="status">
                        <option>Selesai</option>
                        <option>Rusak</option>
                        <option>Tukar</option>
                      </select>
                    <span class="help-block with-errors"></span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
      </div>
    </div>
  </div>