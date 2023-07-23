<!-- Modal -->
<div class="modal fade" id="modal-selesai" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="" method="post">
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modal-selesai_title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai">
              </div>
              <div class="modal-body">
                <input type="number" class="form-control" id="biaya" name="biaya">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </div>
        </form>
    </div>
  </div>