$(() => {
  //Get all data from DB through 
    fetch("controller/process/process.index.php")
    .then(resp => resp.json())
    .then((data)=>{
        createTreeView('#treeview_content', data);  
        createSortable('#treeview_content', data);
    });

    $("#btn_collapse_tree").on("click", () => $("#treeview_content").dxTreeView("collapseAll"));
    $("#btn_expand_tree").on("click", () => $("#treeview_content").dxTreeView("expandAll"));
    

    
    //Verify if URL have parameter #
    const full_url = window.location.href;
    const process_id = parseInt(full_url.substr(full_url.indexOf('#')+1, full_url.length ));

    if (process_id > 0){
      updateContent(process_id);
    }else{
      console.log("Invalid url");
    }

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
        searchExpr: ["name", "main_file"],
        noDataText: "No match",

        // hint: "Hint",

        // elementAttr: {
        //   class: "my_treeview"
        // },

        onItemClick: function(e){
          //Get id from item clicked
          const selectedItem = e.itemData;
          //Modify URL
          const root_url = window.location.href;
          const url_path = root_url.substr(0, root_url.indexOf('#'));
          window.history.pushState({},"", url_path + '#' + selectedItem.id)
          
          updateContent(selectedItem.id);

        },

        onItemSelectionChanged: function(e) {
            const selectedProduct = e.itemData;            
            if(selectedProduct.price) {
                $("#product-details").removeClass("hidden");
                $("#product-details > img").attr("src", selectedProduct.image);
                $("#product-details > .price").text("$" + selectedProduct.price);
                $("#product-details > .name").text(selectedProduct.name);
            } else {
                $("#product-details").addClass("hidden");
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
      success: function(resp){
        data = JSON.parse(resp)[0];
        console.log(data);
        $("#process_title").html(data.name)
      },
      complete: function() {
        $("#icon_loading").addClass("visually-hidden");
      },

    });
  }

  //Get search parameters from URL
  function getQueryParams(){
    try{
        url = window.location.href;
        query_str = url.substr( url.indexOf('?')+1, url.length );
        r_params = query_str.split('&');
        params = {}
        for( i in r_params){
            param = r_params[i].split('=');
            params[ param[0] ] = param[1];
        }
        return params;
    }
    catch(e){
       return {};
    }
  }

