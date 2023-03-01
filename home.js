$(() => {
  
  const process_id = getIdURL();
  refreshTreeview(process_id);
  
  if (process_id > 0){
    $("#process_info").removeClass("d-none");
    $("#process_home").addClass("d-none");
    updateContent( process_id );
  }else{
    console.log("Invalid id");
    updateExcelViewer()
    $("#process_home").removeClass("d-none");
    $("#process_info").addClass("d-none");
  }

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

  //Togle expand/collapse
  let expanded = false;
  $("#btn_toggle_expand").on('click', function(){
    if (expanded){
      $("#treeview_content").dxTreeView("collapseAll");
      expanded = false;
      $("#btn_toggle_expand").html("Expand all")
    }else{
      $("#treeview_content").dxTreeView("expandAll");
      expanded = true;
      $("#btn_toggle_expand").html("Collapse all")
    }
  });

});

  function createTreeView(selector, items) {
    $(selector).dxTreeView({
        items,
        dataStructure: 'plain',
        displayExpr: 'name',
        keyExpr: "id",
        parentIdExpr: "parentId",    
        searchEnabled: true,
        searchMode: "contains",
        searchExpr: ["name", "description"],
        noDataText: "No data to display",

        // hint: "Hint",

        onItemClick: function(e){
          const selectedItem = e.itemData;
          const currentId = getIdURL();
          if (selectedItem.id != currentId ){
            setIdURL(selectedItem.id)
            updateContent(selectedItem.id);
          }
        }
    });
  }


  //update main content
  function updateContent(id){
    //TO DO: Don't allow update if id is invalid
    if (id>0){
      console.log("Valid");
    }else{
      console.log("Invalid");
    }
    let icon_spiner = `<div id="icon_loading" class="spinner-border spinner-border-sm text-secondary d-block visually-hidden" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>`;
    $.ajax({
      method : "GET",
      url : "controller/process/process.show.php",
      data : {id},
      beforeSend: function(){
        $("#process_title").html(icon_spiner);
      },
      error: function(){
        $("#process_title").html(icon_spiner);
      },
      success: function(resp){
        let all_data = JSON.parse(resp)[0];        

        if ( all_data.length > 0){
          let process = all_data[0];
          let attached = all_data[1];
          let pdfs = all_data[2];
          let total_pdf = all_data[3];
          
          //Hide welcome display and show process info
          $("#process_info").removeClass("d-none");
          $("#process_home").addClass("d-none");

          //Update all fields about in MAIN CONTENT
          $("#process_title").html(process.name);
          $("#process_description").html(process.description);

          //Update MODALS
          $("#id_edit").val(process.id);
          $('#is_directory_edit').val(process.isDirectory);
          $("#item_name_edit").val(process.name);
          $("#item_description_edit").val(process.description);
          $('#id_delete').val(process.id);
          $('#pdf_process_id').val(process.id);
          $('#id_delete_parent').val(process.parentId);
          $('#process_id_attach').val(process.id);
          $('#process_id_attach_pdf').val(process.id);
          $('#process_id_bizagi').val(process.id);
          
          $("#id_process_delete_pdf").val(process.id);
          $("#id_process_delete_bizagi").val(process.id);

          //Bizagi folder
          if ( process.bizagi_folder != ""){
            $('#link_bizagi_diagram').attr("href", `upload/bizagi/${process.bizagi_folder}/index.html`);          
            $('#link_bizagi_diagram').show();
          }else{
            $('#link_bizagi_diagram').hide();
            $('#link_bizagi_diagram').attr("href", "");
          }

          //PDF file viewer
          if (total_pdf == 0){
            $("#pdf_content_list").addClass("d-none");
            $('#pdf_content').removeClass("d-none");

            $('#no_pdf_viewer').removeClass("d-none");
            $('#pdf_viewer').attr("src", "");
            $('#pdf_viewer_content').addClass("d-none");
          }else if(total_pdf == 1){
            $("#pdf_content_list").addClass("d-none");
            $('#pdf_content').removeClass("d-none");
            $('#no_pdf_viewer').addClass("d-none");
            $('#pdf_viewer').attr("src", "upload/attach/"+pdfs[0].attach_file+"#view=FitH");
            $('#pdf_viewer_content').removeClass("d-none");
          }else{
            //Show table form
            $('#pdf_content').removeClass("d-none");
            $('#pdf_content').addClass("d-none");
            $("#pdf_content_list").removeClass("d-none")
            let all_pdfs = ``;    
            let c = 0;      
            pdfs.forEach(element => {
              all_pdfs += `
                <tr id="att-${element.id}">
                  <td>${++c}</td>
                  <td>${element.attach_name}</td>
                  <td>
                      <button class="btn btn-sm btn-outline-danger rounded-pill" onclick="deleteAttached(${element.id})">
                          <i class="fa-solid fa-trash" aria-hidden="true"></i> Delete
                      </button>
                      <a href="upload/attach/${element.attach_file}" class="btn btn-sm btn-outline-dark rounded-pill" download>
                          <i class="fa-solid fa-download" aria-hidden="true"></i> Download
                      </a>
                  </td>
                </tr>
              `;
            });

            $("#table_pdf_items").html(all_pdfs);
            $('#pdf_table_id').DataTable();
          }

          //Bizagi viewer
          if ( process.bizagi_folder != ""){
            $('#bizagi_viewer').attr("src", `upload/bizagi/${process.bizagi_folder}/index.html`);
            $('#no_bizagi_viewer').addClass("d-none");
            $('#bizagi_viewer_content').removeClass("d-none");
          }else{
            $('#bizagi_viewer').attr("src", "");
            $('#no_bizagi_viewer').removeClass("d-none");
            $('#bizagi_viewer_content').addClass("d-none");
          }

          //List Attached files
          let all_attached = ``;    
          let cont = 0;      
          attached.forEach(element => {
            all_attached += `
              <tr id="att-${element.id}">
                <td>${++cont}</td>
                <td>${element.attach_name}</td>
                <td>
                    <button class="btn btn-sm btn-outline-danger rounded-pill" onclick="deleteAttached(${element.id})">
                        <i class="fa-solid fa-trash" aria-hidden="true"></i> Delete
                    </button>
                    <a href="upload/attach/${element.attach_file}" class="btn btn-sm btn-outline-dark rounded-pill" download>
                        <i class="fa-solid fa-download" aria-hidden="true"></i> Download
                    </a>
                </td>
              </tr>
            `;
          });

          $("#table_items").html(all_attached);
          $('#table_id').DataTable();

        }else{
          console.log("Invalid id");
        }
      }
    });
  }

  //Get #id from URL
  function getIdURL(){
    const full_url = window.location.href;
    return parseInt(full_url.substr(full_url.indexOf('#')+1, full_url.length ));
  }

  //Set #id to URL
  function setIdURL(id){
    const root_url = window.location.href;
    const url_path = root_url.substr(0, root_url.indexOf('#'));
    window.history.pushState({},"", url_path + '#' + id)
  }

  //Hide modal
  function hideModal(modalSelector, formId){
    var my_form = document.getElementById(formId);
    my_form.reset();
    $(modalSelector).modal("hide");
  }

  //Display Toast
  function showToast(toastId, messageSelector, message){
    var toastLive = document.getElementById(toastId)
    $(messageSelector).html(message);
    var toast = new bootstrap.Toast(toastLive)
    toast.show()
  }

  //Refresh treeview with updated data
  function refreshTreeview(id=0){
    fetch("controller/process/process.index.php")
    .then(resp => resp.json())
    .then((data)=>{
        Object.values(data).forEach(val => {
          if (val['id'] == id){
            val.expanded = true
          }
        });
        createTreeView('#treeview_content', data);
    });
  }

  //Update Excel
  function updateExcelViewer(){
    $.ajax({
      method : "GET",
      url : "controller/excel/excel.index.php",
      success: function(resp){
        if (resp != ""){
          $("#btn_remove_excel_link").removeClass("d-none");
          $("#excel_viewer").removeClass("d-none").attr("src", resp);
        }else{
          $("#btn_remove_excel_link").addClass("d-none");
          $("#excel_viewer").addClass("d-none").attr("src", "");
        }
      }
    });
  }

