<!-- Modal New level-->
<div class="modal fade" id="modal_new_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New user</h5>
        <button type="button" class="btn-close rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="newuser_form"  method="POST">
        <div class="modal-body">

          <div class="mb-3">
            <label for="new_username" class="form-label">Username</label>
            <input type="text" class="form-control" id="new_username" name="new_username" placeholder="username" required autofocus autocomplete="off">
          </div>
          
          <div class="mb-3">
            <label for="user_password" class="form-label">Password</label>
            <input type="text" class="form-control" id="user_password" name="user_password" placeholder="password" required autocomplete="off">
          </div>

          <div class="mb-3 form-group">
            <label for="item_name" class="form-label">Role:</label>
            <select name="user_role" id="user_role" class="form-control" >
              <option value="admin" selected>Admin</option>
              <!-- TODO: Add more roles -->
            </select>
            
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