<!-- Modal New level-->
<div class="modal fade" id="modal_new" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New element</h5>
        <button type="button" class="btn-close rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="newitem_form"  method="POST">
        <div class="modal-body">

          <div class="mb-3">
            <label for="is_directory" class="form-label">Type</label>
            <select name="is_directory" id="is_directory" class="form-select" required>
                <option value="1">Folder</option>
                <option value="0">Process</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="item_name" class="form-label">Name</label>
            <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Item name" required autofocus autocomplete="off">
          </div>

          <div class="mb-3 form-group">
            <label for="item_name" class="form-label">Description</label>
            <textarea name="item_description" id="item_description" class="form-control" placeholder="Description..." cols="10" rows="4"></textarea>
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