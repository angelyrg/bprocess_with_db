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
          getUsers();
          // TO DO: Update users table when one user is added
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
  console.log("Get userss")
  fetch("controller/user/user.index.php")
  .then(resp => resp.json())
  .then((data)=>{
    console.log(data);
      let all_users = ``;    
      data.forEach(element => {
        all_users += `
          <tr id="att-${element.id}">
            <td>${element.id}</td>
            <td>${element.username}</td>
            <td>${element.role}</td>
            <td>
                <button class="btn btn-sm btn-outline-danger rounded-pill" onclick="deleteAttached(${element.id})">
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


