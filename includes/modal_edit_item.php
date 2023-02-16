<!-- Modal Edit-->
<div class="modal fade" id="modal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit element</h5>
        <button type="button" class="btn-close rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="edit_item_form" method="POST">
        <div class="modal-body">

          <div class="mb-3">
            <input type="hidden" class="form-control" id="id_edit" name="id_edit" required >
          </div>

          <div class="mb-3">
            <label for="is_directory_edit" class="form-label">Type</label>
            <select name="is_directory_edit" id="is_directory_edit" class="form-select" required>
                <option value="1">Folder</option>
                <option value="0">Process</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="item_name_edit" class="form-label">Name</label>
            <input type="text" class="form-control" id="item_name_edit" name="item_name_edit" required autofocus autocomplete="off">
          </div>

          <div class="mb-3 form-group">
            <label for="item_name" class="form-label">Description</label>
            <textarea name="item_description_edit" id="item_description_edit" class="form-control" placeholder="Description..." cols="10" rows="4"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline-info rounded-pill">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>