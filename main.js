$(() => {
  refreshTreeview();
  
  $("#btn_collapse_tree").on("click", () => $("#treeview_content").dxTreeView("collapseAll"));
  $("#btn_expand_tree").on("click", () => $("#treeview_content").dxTreeView("expandAll"));

  const process_id = getIdURL();

  if (process_id > 0){
    updateContent( process_id );
  }else{
    console.log("Invalid url");
  }

  /* ===CRUD=== */
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
    console.log("Submit stoped");
    var parameters = new FormData( $("#pdf_form")[0] );

    $.ajax({
      url : "controller/pdf/pdf.upload.php",
      method : "POST",
      data: parameters,
      processData: false,
      contentType: false,
      beforeSend: function(){
        $("#btn_upload_pdf").html( `<div class="spinner-border spinner-border-sm text-secondary" role="status"></div> Uploading..` )
      },
      success: function(resp){
        console.log(resp);
        hideModal('#modal_upload_pdf', 'pdf_form');
        updateContent(resp);
        showToast('liveToast', "Main PDF file uploaded successfully!");        
      },
      complete: function(resp){
        $("#btn_upload_pdf").html(`<i class="fa fa-upload" aria-hidden="true"></i> Upload file`);
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
        searchExpr: ["name"],
        noDataText: "No match",

        // hint: "Hint",

        // elementAttr: {
        //   class: "my_treeview"
        // },

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
      success: function(resp){
        console.log(resp);
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
        if ( JSON.parse(resp).length > 0){
          data = JSON.parse(resp)[0];
          process = data[0];
          attached = data[1];
  
          // console.log(process);
          // console.log(attached);

          //Update all fields about
          $("#process_title").html(process.name);

          //Update edit modal data
          $("#id_edit").val(process.id);
          $('#id_delete').val(process.id);
          $('#pdf_process_id').val(process.id);
          $('#id_delete_parent').val(process.parentId);
          $("#item_name_edit").val(process.name);
          $('#is_directory_edit').val(process.isDirectory);
          
          if ( process.main_file != ""){
            $('#no_pdf_viewer').hide();
            $('#pdf_viewer').attr("src", "upload/pdfs/"+process.main_file);
            $('#pdf_viewer').show();            
          }else{
            $('#pdf_viewer').hide();
            $('#no_pdf_viewer').show();
          }

        }else{
          console.log("Invalid id");
        }

      },
      complete: function() {
        $("#icon_loading").addClass("visually-hidden");
      },

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
