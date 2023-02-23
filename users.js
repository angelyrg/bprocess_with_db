$(() => {
  
  /** ===CRUD=== */
  //Get all users
  getUsers();

  //Insert new user
  $("#newuser_form").on('submit', function(e){
    e.preventDefault();
    $.ajax({
        url: 'controller/user/user.store.php',
        type: 'POST',
        data: $("#newuser_form").serialize(),
        success: function(resp){
          console.log(resp);
          var my_form = document.getElementById("newuser_form");
          my_form.reset();
          $("#modal_new_user").modal("hide");
          getUsers();
        }
    })
  });

  //Logout
  $("#btn_logout").on('click', function (e) {
    $.ajax({
      url : "controller/auth/logout.php",
      method : "POST",
      success: function(){
        $(location).attr('href', "home");
      }
    });
  })

});


//Get all users
function getUsers(){
  fetch("controller/user/user.index.php")
  .then(resp => resp.json())
  .then((data)=>{
      let all_users = ``;    
      data.forEach(element => {
        all_users += `
          <tr id="user-${element.id}">
            <td>${element.id}</td>
            <td>${element.username}</td>
            <td>${element.role}</td>
            <td>
                <button class="btn btn-sm btn-outline-secondary rounded-pill" onclick="resetPassword(${element.id})">
                    <i class="fa-solid fa-key" aria-hidden="true"></i> Reset password
                </button>
                <button class="btn btn-sm btn-outline-danger rounded-pill" onclick="deleteUser(${element.id})">
                    <i class="fa-solid fa-trash" aria-hidden="true"></i> Delete
                </button>
            </td>
          </tr>
        `;
      });

      $("#users_items").html(all_users);
      $('#table_users').DataTable();

  });
}

//Delete user
function deleteUser(id){
  if (confirm("Are you sure you want to delete this user?")){
    $.ajax({
      url: 'controller/user/user.destroy.php',
      type: 'POST',
      data: {id},
      success: function(){
        showToast('liveToast', "User removed successfully!");
        getUsers();
      }
    })
  }
}

//Reset user password
function resetPassword(id){
  if (confirm("Are you sure you want reset password? The new password will be: 12345678")){
    $.ajax({
      url: 'controller/user/user.reset.php',
      type: 'POST',
      data: {id},
      success: function(){
        showToast('liveToast', "Password updated successfully!<br>The new password is: 12345678");
        getUsers();
      }
    })
  }
}

//Display Toast
function showToast(toastId, message){
  var toastLive = document.getElementById(toastId)
  $("#toastSuccesMessage").html(message);
  var toast = new bootstrap.Toast(toastLive)
  toast.show()
}