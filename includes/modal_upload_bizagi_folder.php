
<!-- Modal Upload Bizagi folder-->
<div class="modal fade" id="modal_upload_bizagi_folder" tabindex="-1" aria-labelledby="modal_bizagi" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-info fs-5" >Upload bizagi folder</h1>
        <button type="button" class="btn-close rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="p-4">
          <p>Choose a bizagi folder to upload.</p>
          <div class="picker">
            <!-- After select a folder, execute upload.js script -->
            <input type="file" id="picker" name="fileList" class="form-control" webkitdirectory multiple>
            <input type="hidden" id="process_id_bizagi" name="process_id_bizagi" value="">
          </div>
          <br>
          <p class="mb-0">Percentage</p>
          <span id="box">0%</span>
          <br>
          <p class="mb-0">Progress</p>
          <div id="myProgress">
            <div id="myBar"></div>
          </div>
          <p>Files Uploaded</p>
          <span id="listing"></span>
        </div>
      </div>
      <div class="d-grid mx-5 px-5 mt-4 mb-3">
        <button type="button" class="btn btn-info rounded-pill fw-bolder mx-5" id="btn_close_bizagi_modal" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>