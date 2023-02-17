<!-- Modal Update excel link-->
<div class="modal fade" id="modal_excel_link" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update excel link</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="excel_form" method="POST">
        <div class="modal-body">
          <div class="mb-3">
            <label for="excel_link" class="form-label">New excel link</label>
            <input type="text" class="form-control rounded" id="excel_link" name="excel_link" required autofocus autocomplete="off" placeholder="https://docs.google.com/spreadsheets/d/.../pubhtml">
          </div>
          <small id="excel_modal_text"></small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal"><i class="fa fa-remove" aria-hidden="true"></i> Close</button>
          <button type="submit" class="btn btn-outline-info rounded-pill"><i class="fa-solid fa-file-excel" aria-hidden="true"></i> Save</button>
        </div>
      </form>
    </div>
  </div>
</div>