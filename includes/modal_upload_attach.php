<!-- Modal Upload attached files-->
<div class="modal fade" id="modal_upload_attach" tabindex="-1" aria-labelledby="modalPDFUploading" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalPDFUploading">Upload attachment files</h5>
        <button type="button" class="btn-close rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" id="form_attach" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="process_id_attach" id="process_id_attach" value="<?= $process["id"]; ?>" required >
          <input type="hidden" name="file_type" id="file_type" value="1" required >
          <div class="mb-3">
            <p for="pdf_file" class="form-label">You can select multiples files.</p>
            <input type="file" name="attach_files[]" id="attach_files" class="form-control rounded-pill" multiple required >
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn rounded-pill btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn rounded-pill btn-info" id="btn_save_attach" name="btn_save_attach"><i class="fa fa-upload" aria-hidden="true"></i> Upload files</button>
        </div>
      </form>
    </div>
  </div>
</div>