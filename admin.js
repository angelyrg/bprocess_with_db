$(() => {
  refreshTreeview();
  
  $("#btn_collapse_tree").on("click", () => $("#treeview_content").dxTreeView("collapseAll"));
  $("#btn_expand_tree").on("click", () => $("#treeview_content").dxTreeView("expandAll"));

  const process_id = getIdURL();

  if (process_id > 0){
    $("#process_info").removeClass("d-none");
    $("#process_home").addClass("d-none");
    updateContent( process_id );
  }else{
    console.log("Invalid url");
    updateExcelViewer()
    $("#process_home").removeClass("d-none");
    $("#process_info").addClass("d-none");
  }

  /** ===CRUD=== */
  //Insert new record
  $("#newitem_form").on('submit', function(e){
    e.preventDefault();
    $.ajax({
        url: 'controller/process/process.store.php',
        type: 'POST',
        data: $("#newitem_form").serialize(),
        success: function(resp){
          if (resp != "error"){
            let just_added_id = parseInt(resp);

            setIdURL(just_added_id);            
            refreshTreeview();
            hideModal('#modal_new', 'newitem_form');            
            updateContent(just_added_id);
            showToast('liveToast', "New record saved successfully!");
          }
        }
    })
  });
  
  //Edit record
  $("#edit_item_form").on('submit', function(e){
    e.preventDefault();
    $.ajax({
        url: 'controller/process/process.update.php',
        type: 'POST',
        data: $("#edit_item_form").serialize(),
        success: function(resp){
          if (resp != "error"){
            let just_updated_id = parseInt(resp);          
            refreshTreeview();
            hideModal('#modal_edit', 'edit_item_form');
            updateContent(just_updated_id);
            showToast('liveToast', "Updated successfully!");
          }
        }
    })
  });

  //Delete record
  $("#delete_item_form").on('submit', function(e){
    e.preventDefault();
    $.ajax({
        url: 'controller/process/process.destroy.php',
        type: 'POST',
        data: $("#delete_item_form").serialize(),
        success: function(resp){
          if (resp != "error"){
            let just_deleted_parent_id = parseInt(resp);          
            refreshTreeview();
            hideModal('#modal_delete', 'delete_item_form');
            updateContent(just_deleted_parent_id);
            showToast('liveToast', "Deleted successfully!");
          }
        }
    })
  });

  //Upload PDF  
  $("#pdf_form").on('submit', function (e) {
    e.preventDefault();
    var parameters = new FormData( $("#pdf_form")[0] );

    $.ajax({
      url : "controller/process/process.pdf_upload.php",
      method : "POST",
      data: parameters,
      processData: false,
      contentType: false,
      beforeSend: function(){
        $("#btn_upload_pdf").html( `<div class="spinner-border spinner-border-sm text-secondary" role="status"></div> Uploading..` )
      },
      success: function(resp){
        hideModal('#modal_upload_pdf', 'pdf_form');
        updateContent(resp);
        showToast('liveToast', "Main PDF file uploaded successfully!");        
      },
      complete: function(resp){
        $("#btn_upload_pdf").html(`<i class="fa fa-upload" aria-hidden="true"></i> Upload file`);
      }

    });

  })

  //Delete PDF
  $("#delete_pdf_form").on('submit', function(e){
    e.preventDefault();
    $.ajax({
        url: 'controller/process/process.pdf_destroy.php',
        type: 'POST',
        data: $("#delete_pdf_form").serialize(),
        beforeSend: function(){
          $("#btn_delete_pdf").html( `<div class="spinner-border spinner-border-sm text-secondary" role="status"></div> Deleting` )
        },
        success: function(resp){
          if (resp != "error"){
            let just_deleted_parent_id = parseInt(resp);          
            refreshTreeview();
            hideModal('#modal_delete_pdf', 'delete_pdf_form');
            updateContent(just_deleted_parent_id);
            showToast('liveToast', "PDF file deleted successfully!");
          }
        },
        complete: function(){
          $("#btn_delete_pdf").html(`Delete`);
        }
    })
  });
  
  //Delete BIZAGI
  $("#delete_bizagi_form").on('submit', function(e){
    e.preventDefault();
    $.ajax({
        url: 'controller/process/process.bizagi_destroy.php',
        type: 'POST',
        data: $("#delete_bizagi_form").serialize(),
        beforeSend: function(){
          $("#btn_delete_bizagi").html( `<div class="spinner-border spinner-border-sm text-secondary" role="status"></div> Deleting` )
        },
        success: function(resp){
          if (resp != "error"){
            let just_deleted_parent_id = parseInt(resp);          
            refreshTreeview();
            hideModal('#modal_delete_bizagi', 'delete_bizagi_form');
            updateContent(just_deleted_parent_id);
            showToast('liveToast', "Bizagi deleted successfully!");
          }
        },
        complete: function(){
          $("#btn_delete_bizagi").html(`Delete`);
        }
    })
  });

  //Upload Attaches  
  $("#form_attach").on('submit', function (e) {
    e.preventDefault();
    var attachments = new FormData( $("#form_attach")[0] );
    $.ajax({
      url : "controller/attach/attach.upload.php",
      method : "POST",
      data: attachments,
      processData: false,
      contentType: false,
      beforeSend: function(){
        $("#btn_save_attach").html( `<div class="spinner-border spinner-border-sm text-secondary" role="status"></div> Uploading..` )
      },
      success: function(resp){
        hideModal('#modal_upload_attach', 'form_attach');
        updateContent(resp);
        showToast('liveToast', "Attachment files uploaded successfully!");
      },
      complete: function(resp){
        $("#btn_save_attach").html(`<i class="fa fa-upload" aria-hidden="true"></i> Upload files`);
      }
    });
  })

  //Update Excel link 
  $("#excel_form").on('submit', function (e) {
    e.preventDefault();
    $.ajax({
      url : "controller/excel/excel.update.php",
      method : "POST",
      data : $("#excel_form").serialize(),
      success: function(resp){
        if(resp === "ok"){
          $("#excel_modal_text").removeClass("text-danger").html("");
          $("#excel_viewer").removeClass("d-none");
          hideModal('#modal_excel_link', 'excel_form');
          showToast('liveToast', "Excel link updated successfully!");
          updateExcelViewer();
        }else if (resp === "invalid link"){
          $("#excel_modal_text").addClass("text-danger").html(`Invalid link.<br>Please make sure your link has been obtained from Google Docs: File/Share/Publish to web/Link`);
        }else{
          $("#excel_modal_text").addClass("text-danger").html(`Error`);
        }
      }
    });
  })

  //Logout
  $("#form_login").on('submit', function (e) {
    e.preventDefault();
    $.ajax({
      url : "controller/auth/login.php",
      method : "POST",
      data : $("#form_login").serialize(),
      success: function(resp){
        if (resp == 0) {
          //Error in login
          $("#login_message").attr("class", "text-danger").html("Invalid credentials.Try again <br><br>");
        }else if(resp == 1) {
          //Login success
          $("#login_message").attr("class", "text-success").html("¡Success! <br><br>");
          $(location).attr('href', "admin.php");
        }
      }
    });
  })

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
  
  function createSortable(selector, data) {
    $(selector).dxSortable({
      filter: '.dx-treeview-item',
      group: 'shared',
      data: data,
      allowDropInsideItem: true,
      allowReordering: true,
      onDragChange(e) {
        if (e.fromComponent === e.toComponent) {
          const $nodes = e.element.find('.dx-treeview-node');
          const isDragIntoChild = $nodes.eq(e.fromIndex).find($nodes.eq(e.toIndex)).length > 0;
          if (isDragIntoChild) {
            e.cancel = true;
          }
        }
      },
      onDragEnd(e) {
        if (e.fromComponent === e.toComponent && e.fromIndex === e.toIndex) {
          return;
        }
  
        const fromTreeView = getTreeView( selector);
        const toTreeView = getTreeView( selector);
  
        const fromNode = findNode(fromTreeView, e.fromIndex);
        const toNode = findNode(toTreeView, calculateToIndex(e));
  
        if (e.dropInsideItem && toNode !== null && !toNode.itemData.isDirectory) {
          return;
        }
  
        const fromTopVisibleNode = getTopVisibleNode(fromTreeView);
        const toTopVisibleNode = getTopVisibleNode(toTreeView);  
        const fromItems = fromTreeView.option('items');
        const toItems = toTreeView.option('items');

        moveNode(fromNode, toNode, fromItems, toItems, e.dropInsideItem);

        fromTreeView.option('items', fromItems);
        toTreeView.option('items', toItems);
        fromTreeView.scrollToItem(fromTopVisibleNode);
        toTreeView.scrollToItem(toTopVisibleNode);

        //Update values in database
        const idFrom = fromNode != null ? fromNode.itemData.id : 0;
        const idTo = toNode != null ? toNode.itemData.id : 0;
        updateSort(idFrom, idTo);

      },
    });
  }
  
  function getTreeView(selector) {
    return $(selector).dxTreeView('instance');
  }
  
  function calculateToIndex(e) {
    if (e.fromComponent !== e.toComponent || e.dropInsideItem) {
      return e.toIndex;
    }
  
    return e.fromIndex >= e.toIndex
      ? e.toIndex
      : e.toIndex + 1;
  }
  
  function findNode(treeView, index) {
    const nodeElement = treeView.element().find('.dx-treeview-node')[index];
    if (nodeElement) {
      return findNodeById(treeView.getNodes(), nodeElement.getAttribute('data-item-id'));
    }
    return null;
  }
  
  function findNodeById(nodes, id) {
    for (let i = 0; i < nodes.length; i += 1) {
      if (nodes[i].itemData.id === id) {
        return nodes[i];
      }
      if (nodes[i].children) {
        const node = findNodeById(nodes[i].children, id);
        if (node != null) {
          return node;
        }
      }
    }
    return null;
  }
  
  function moveNode(fromNode, toNode, fromItems, toItems, isDropInsideItem) {
    const fromIndex = findIndex(fromItems, fromNode.itemData.id);
    fromItems.splice(fromIndex, 1);
  
    const toIndex = toNode === null || isDropInsideItem
      ? toItems.length
      : findIndex(toItems, toNode.itemData.id);
    toItems.splice(toIndex, 0, fromNode.itemData);
  
    moveChildren(fromNode, fromItems, toItems);
    if (isDropInsideItem) {
      fromNode.itemData.parentId = toNode.itemData.id;

    } else {
      fromNode.itemData.parentId = toNode != null
        ? toNode.itemData.parentId
        : undefined;
    }
  }
  
  function moveChildren(node, fromItems, toItems) {
    if (!node.itemData.isDirectory) {
      return;
    }
  
    node.children.forEach((child) => {
      if (child.itemData.isDirectory) {
        moveChildren(child, fromItems, toItems);
      }
  
      const fromIndex = findIndex(fromItems, child.itemData.id);
      fromItems.splice(fromIndex, 1);
      toItems.splice(toItems.length, 0, child.itemData);
    });
  }
  
  function findIndex(array, id) {
    const idsArray = array.map((elem) => elem.id);
    return idsArray.indexOf(id);
  }
  
  function getTopVisibleNode(component) {
    const treeViewElement = component.element().get(0);
    const treeViewTopPosition = treeViewElement.getBoundingClientRect().top;
    const nodes = treeViewElement.querySelectorAll('.dx-treeview-node');
    const nodes_length = nodes.length;
    for (let i = 0; i < nodes_length; i += 1) {
      const nodeTopPosition = nodes[i].getBoundingClientRect().top;
      if (nodeTopPosition >= treeViewTopPosition) {
        return nodes[i];
      }
    }
  
    return null;
  }

  //Save moved data in database
  function updateSort(idfrom, idto){
    $.ajax({
      method : "POST",
      url : "controller/process/process.sort.php",
      data : {idfrom, idto},
      success: function(){
        showToast('liveToast', "Item moved successfuly");
      }
    });    
  }

  //update main content
  function updateContent(id){
    $.ajax({
      method : "GET",
      url : "controller/process/process.show.php",
      data : {id},
      beforeSend: function(){
        $("#icon_loading").removeClass("visually-hidden");
      },
      error: function(){
        $("#icon_loading").addClass("visually-hidden");
      },
      success: function(resp){
        let all_data = JSON.parse(resp)[0];
        if ( all_data.length > 0){
          let process = all_data[0];
          let attached = all_data[1];

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
          if ( process.main_file != ""){
            $('#no_pdf_viewer').addClass("d-none");
            $('#pdf_viewer').attr("src", "upload/pdfs/"+process.main_file+"#view=FitH");
            $('#pdf_viewer_content').removeClass("d-none");
          }else{
            $('#no_pdf_viewer').removeClass("d-none");
            $('#pdf_viewer').attr("src", "");
            $('#pdf_viewer_content').addClass("d-none");
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
      },
      complete: function() {
        $("#icon_loading").addClass("visually-hidden");
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
  function showToast(toastId, message){
    var toastLive = document.getElementById(toastId)
    $("#toastSuccesMessage").html(message);
    var toast = new bootstrap.Toast(toastLive)
    toast.show()
  }

  //Refresh treeview with updated data
  function refreshTreeview(){
    fetch("controller/process/process.index.php")
    .then(resp => resp.json())
    .then((data)=>{
        createTreeView('#treeview_content', data);
        createSortable('#treeview_content', data);
    });
  }

  //Delete attached file
  function deleteAttached(id){
    if (confirm("Are you sure you want delete this attached file?")){
      $.ajax({
        url: 'controller/attach/attach.destroy.php',
        type: 'POST',
        data: {attached_id : id},
        success: function(resp){
          if (resp != "error"){
            $("#att-"+id).remove();
            showToast('liveToast', "Attached file deleted successfully!");
          }
        }
      })
    }
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

  //Delete excel link
  function removeExcel(){
    if (confirm("Are you sure you want to remove the excel?")){
      $.ajax({
        url: 'controller/excel/excel.destroy.php',
        success: function(resp){
          if (resp === "removed"){
            showToast('liveToast', "Excel link removed successfully!");
            updateExcelViewer();
          }
        }
      })
    }
  }
