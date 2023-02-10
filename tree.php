<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test enviroment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.4/css/dx.material.teal.dark.compact.min.css" integrity="sha512-ioJLHRykPd1rKVB8X4J1taJlTukGkGb9tM7NO4DUAE3U6UszBxzfpaXjkH48issEberdAQ+9yHHmilYjYYDzqQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/bootswatch.css">
    <link rel="stylesheet" href="assets/css/treeview.css">
    <link rel="stylesheet" href="assets/datatables/datatables.min.css">
    <link rel="stylesheet" href="assets/css/style.scss">
</head>
<body>
    <nav class="navbar navbar-expand-lg my_navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="assets/imgs/bitel.svg" alt="Bitel" class="img-fluid"> <span class="fw-bold">Admin</span>
            </a>
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <button class="btn btn-outline-info" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user" aria-hidden="true"></i> User
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item text-info" href="#"><i class="fa-solid fa-home" aria-hidden="true"></i> Home</a></li>
                        <li><a class="dropdown-item text-info" href="#"> <i class="fa-solid fa-right-from-bracket" aria-hidden="true"></i> Logout</a></li>
                    </ul>
                </div>
                <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"  aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row py-3">
            <div class="col-md-4 col-lg-3 p-2 border border-dark rounded d-md-block sidebar collapse" id="sidebarMenu">
                <div class="d-flex justify-content-end my-1">
                    <a href="#" id="btn_expand_tree" class="btn btn-sm btn-outline-light rounded-pill ms-1">Expand all</a>
                    <a href="#" id="btn_collapse_tree" class="btn btn-sm btn-outline-light rounded-pill ms-1">Collapse all</a>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#modal_new">
                        <i class="fa-solid fa-plus" aria-hidden="true"></i> New Item
                    </button>
                    
                </div>
                <div class="dx-viewport">
                    <div class="demo-container">
                        <div class="form">
                            <div class="drive-panel">
                                <div class="drive-header dx-treeview-item">
                                    <div class="dx-treeview-item-content">
                                        <i class="dx-icon dx-icon-activefolder"></i><span>Processes</span>
                                    </div>
                                </div>
                                <div id="treeview_content"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-lg-9" id="content_container">

                <!-- main process info -->
                <div class="container-fluid" id="process_info">
                    <div class="d-flex justify-content-between align-items-center my-2 ">
                        <div class="">
                            <div id="icon_loading" class="spinner-border spinner-border-sm text-secondary d-block visually-hidden" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <div class="d-block">
                                <!-- <i class="dx-icon-folder" aria-hidden="true"></i> -->
                                <p class="text-info fw-bold" id="process_title"></p>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="btn btn-outline-danger btn-sm rounded-pill" id="btn_modal_delete" data-bs-toggle="modal" data-bs-target="#modal_delete">
                                <i class="fa-solid fa-trash" aria-hidden="true"></i> Delete
                            </button>

                            <button type="button" class="btn btn-outline-warning btn-sm rounded-pill" id="btn_modal_edit" data-bs-toggle="modal" data-bs-target="#modal_edit">
                                <i class="fa-solid fa-pen" aria-hidden="true"></i> Edit
                            </button>


                            <button type="button" class="btn btn-info btn-sm rounded-pill" id="btn_update_pdf" data-bs-toggle="modal" data-bs-target="#modal_upload_pdf">
                                <i class="fa-solid fa-plus" aria-hidden="true"></i> Change PDF file
                            </button>

                            <button type="button" class="btn btn-info btn-sm rounded-pill" id="btn_upload_bizagi_folder" data-bs-toggle="modal" data-bs-target="#modal_upload_bizagi_folder">
                                <i class="fa-solid fa-plus" aria-hidden="true"></i> Upload Bizagi Folder
                            </button>

                            <a href="#" class="btn btn-info btn-sm rounded-pill" target="_blank" id="link_bizagi_diagram" rel="noopener">
                                <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i> Open Bizagi
                            </a>

                        </div>
                    </div>
                    <nav class="nav nav-tabs d-flex justify-content-center pt-3 pb-2 border-top" id="nav-tab-details" role="tablist">
                        <a class="nav-link btn active text-center my_btn" id="nav-pdf-tab" data-bs-toggle="tab" href="#nav-pdf" role="tab" aria-controls="nav-pdf" aria-selected="true">PDF</a>
                        <a class="nav-link btn text-center my_btn" id="nav-attach-tab" data-bs-toggle="tab" href="#nav-attach" role="tab" aria-controls="nav-attach" aria-selected="false">Attached files</a>
                    </nav>
                    <div class="tab-content " id="nav-tabContent">
                        <!-- PDF tab -->
                        <div class="tab-pane fade show active " id="nav-pdf" role="tabpanel" aria-labelledby="nav-pdf-tab">
                            <div class="container pt-0 d-flex align-items-center justify-content-center rounded-3" id="pdf_content">

                                <iframe src="" width="100%" id="pdf_viewer" title="PDF viewer" class=""></iframe>
                                
                                <div class="text-center" id="no_pdf_viewer">
                                    <img src="assets/imgs/no-file.svg" alt="File not found" class="img-fluid">
                                    <p class="text-secondary"><small>PDF file is in process to be sign by BOD.</small></p>
                                    <button type="button" class="btn btn-outline-info rounded-pill px-5" data-bs-toggle="modal" data-bs-target="#modal_upload_pdf">
                                        <i class="fa-solid fa-plus" aria-hidden="true"></i> Upload PDF file
                                    </button>
                                </div>
                                
                            </div>
                        </div>

                        <div class="tab-pane fade " id="nav-attach" role="tabpanel" aria-labelledby="nav-attach-tab">
                            <div class="d-flex justify-content-between align-items-center my-2 ">
                                <div class="text-info">Atachment files</div>
                                <button type="button" class="btn btn-outline-info rounded-pill" data-bs-toggle="modal" data-bs-target="#modal_upload_attach">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add file
                                </button>

                            </div>
                            <div class="table-responsive">
                                <table class="table" id="table_id" summary="Attached files">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>File's name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="attached_table">
                                        <tr>
                                            <td>id</td>
                                            <td>attached name</td>
                                            <td>
                                                <a href="attach.destroy.php" class="btn btn-outline-danger btn-sm rounded-pill" onclick="if(confirm('Are you sure to delete this item?') === false) event.preventDefault();">
                                                    <i class="fa fa-trash" aria-hidden="true"></i> Remove
                                                </a>
                                                <a href="../upload/attached/" class="btn btn-sm btn-outline-dark rounded-pill" download>
                                                    <i class="fa-solid fa-download" aria-hidden="true"></i> Download
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    //MODALS
    include("includes/modal_new_item.php");
    include("includes/modal_edit_item.php");
    include("includes/modal_delete_item.php");
    include("includes/modal_upload_pdf.php");
    include("includes/modal_upload_attach.php");

    //TOASTS
    include("includes/toast.php");
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.4/js/dx.all.js" integrity="sha512-aQAJMeqooVJsjLfnQeh5XCKnn8pF+ujBYawvUePQZooZ5PthLF2/bZS1reU+nuGEBYuzrFG1812mxjF09R1T8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/datatables/datatables.min.js"></script>
    <script src="main.js"></script>

</body>
</html>