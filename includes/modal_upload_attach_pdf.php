<!-- Modal Upload pdf attach-->
<div class="modal fade" id="modal_upload_attach_pdf" tabindex="-1" aria-labelledby="modalPDFUploading" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload PDF</h5>
        <button type="button" class="btn-close rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" id="form_attach_pdf" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="process_id_attach" id="process_id_attach_pdf" required >
          <input type="hidden" name="file_type" id="file_type" value="0" required >
          <div class="mb-3">
            <label for="pdf_file" class="form-label">Select file to upload</label>
            <input type="file" name="attach_files[]" id="attach_files" class="form-control rounded-pill" required accept=".pdf">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn rounded-pill btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn rounded-pill btn-info" id="btn_save_attach" name="btn_save_attach"><i class="fa fa-upload" aria-hidden="true"></i> Upload PDF</button>
        </div>
      </form>
    </div>
  </div>
</div>