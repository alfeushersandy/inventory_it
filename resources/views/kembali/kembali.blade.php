<!-- Modal -->
<div class="modal fade" id="modalkembali" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalkembaliLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalkembaliLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="POST">
          @csrf
          @method('post')
          <div class="modal-body">
                  <div class="row">
                     <div class="d-flex justify-content-between">
                      <a class="btn btn-warning" href="">Selesai</a>
                      <a class="btn btn-warning" href="">Rusak</a>
                      <a class="btn btn-warning" href="">Tukar</a>
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