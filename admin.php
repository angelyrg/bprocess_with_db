<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: home");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitel Process Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.4/css/dx.material.teal.light.min.css" integrity="sha512-Q7TGbyUKM3/hGtfq/4X1UvCWUvEyVBUFMzQ576eF2VS0TfuSCfJCTl5kvl+VFpLj7J4oZdQUuYIeJ0D17iKNWA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/bootswatch.css">
    <link rel="stylesheet" href="assets/datatables/datatables.min.css">
    <link rel="stylesheet" href="assets/css/style.scss">
</head>

<body>
    <nav class="navbar navbar-expand-lg my_navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="./">
                <img src="assets/imgs/bitel.svg" alt="Bitel" class="img-fluid"> <span class="fw-bold">Admin</span>
            </a>
            <div class="d-flex align-items-center">
                <button class="btn btn-outline-info rounded-pill" data-bs-toggle="modal" data-bs-target="#modal_logout">
                    <i class="fa-solid fa-right-from-bracket" aria-hidden="true"></i> Logout
                </button>
                <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-lg-3 p-2 border border-dark rounded d-md-block sidebar collapse" id="sidebarMenu">

                <a href="users" class="btn btn-sm btn-outline-light d-block"><i class="fa-solid fa-users" aria-hidden="true"></i> Users</a>
                <hr>
                
                
                <div class="dx-viewport">
                    <div class="demo-container">
                        <div class="form">
                            <div class="drive-panel">
                                <div class="drive-header dx-treeview-item">
                                    <div class="dx-treeview-item-content">
                                        <i class="dx-icon dx-icon-activefolder" aria-hidden="true"></i><span>Processes</span>
                                    </div>
                                    <div class="d-flex justify-content-end my-1">
                                        <button class="btn btn-sm btn-outline-light rounded-pill ms-1" id="btn_toggle_expand">
                                            Expand all
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-light rounded-pill ms-1" data-bs-toggle="modal" data-bs-target="#modal_new">
                                            <i class="fa-solid fa-plus" aria-hidden="true"></i> New Item
                                        </button>
                                    </div>
                                </div>
                                <div id="treeview_content"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-lg-9" id="content_container">

                <!-- Home Main info -->
                <div class="container-fluid d-none" id="process_home">
                    <div class="row">
                        <div class="col-12 border border-info border rounded-3 py-3">
                            <h4>Welcome to Index Process Admin Page</h4>
                            <!-- Excel -->
                            <div class="container-fluid" id="processes_excel">
                                <button id="btn_remove_excel_link" class="btn btn-outline-danger btn-sm rounded-pill" onclick="removeExcel()">
                                    <i class="fa fa-trash" aria-hidden="true"></i> Remove excel
                                </button>
                                <button id="btn_update_excel_link" class="btn btn-sm btn-outline-info rounded-pill" data-bs-toggle="modal" data-bs-target="#modal_excel_link">
                                    <i class="fa-solid fa-file-excel" aria-hidden="true"></i> Update excel link
                                </button>
                                <iframe src="" class="col-12 d-none" id="excel_viewer" title="Google documents viewer"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main process info -->
                <div class="container-fluid d-none" id="process_info">
                    <div class="d-flex justify-content-between align-items-center my-2 ">
                        <div class="">
                            <div id="icon_loading" class="spinner-border spinner-border-sm text-secondary d-block visually-hidden" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <div class="d-block">
                                <p class="text-info fw-bold" id="process_title"></p>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="btn btn-outline-warning btn-sm rounded-pill" id="btn_modal_edit" data-bs-toggle="modal" data-bs-target="#modal_edit">
                                <i class="fa-solid fa-pen" aria-hidden="true"></i> Edit this item
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-sm rounded-pill" id="btn_modal_delete" data-bs-toggle="modal" data-bs-target="#modal_delete">
                                <i class="fa-solid fa-trash" aria-hidden="true"></i> Delete
                            </button>
                        </div>
                    </div>

                    <small id="process_description"></small>

                    <nav class="nav nav-tabs d-flex justify-content-center pt-3 pb-2 border-top" id="nav-tab-details" role="tablist">
                        <a class="nav-link btn text-center my_btn mx-1 active" id="nav-pdf-tab" data-bs-toggle="tab" href="#nav-pdf" role="tab" aria-controls="nav-pdf" aria-selected="true">PDF</a>
                        <a class="nav-link btn text-center my_btn mx-1" id="nav-attach-tab" data-bs-toggle="tab" href="#nav-attach" role="tab" aria-controls="nav-attach" aria-selected="false">Attached files</a>
                        <a class="nav-link btn text-center my_btn mx-1" id="nav-bizagi-tab" data-bs-toggle="tab" href="#nav-bizagi" role="tab" aria-controls="nav-bizagi" aria-selected="false">Bizagi</a>
                    </nav>
                    <div class="tab-content " id="nav-tabContent">
                        <!-- PDF tab -->
                        <div class="tab-pane fade show active " id="nav-pdf" role="tabpanel" aria-labelledby="nav-pdf-tab">
                            <div class="container pt-0 align-items-center rounded-3" id="pdf_content">

                                <div class="d-none" id="pdf_viewer_content">
                                    <div class="border border-bottom d-flex justify-content-between align-items-center">
                                        <div>
                                            <h4 class="text-center my-2">Main PDF file</h4>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-danger btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#modal_delete_pdf">
                                                <i class="fa-solid fa-trash" aria-hidden="true"></i> Delete PDF
                                            </button>
                                        </div>
                                    </div>
                                    <iframe src="" width="100%" id="pdf_viewer" title="PDF file"></iframe>
                                </div>

                                <div class="text-center d-none" id="no_pdf_viewer">
                                    <img src="assets/imgs/no-file.svg" alt="PDF file not found" class="img-fluid py-5">
                                    <p class="text-dark fw-bolder"><small>PDF file is in process to be sign by BOD.</small></p>
                                    <button type="button" class="btn btn-outline-info rounded-pill" data-bs-toggle="modal" data-bs-target="#modal_upload_pdf">
                                        <i class="fa-solid fa-plus" aria-hidden="true"></i> Upload PDF file
                                    </button>
                                </div>

                            </div>
                        </div>

                        <!-- Attached tab -->
                        <div class="tab-pane fade " id="nav-attach" role="tabpanel" aria-labelledby="nav-attach-tab">
                            <div class="container pt-0 align-items-center rounded-3" id="attach_content">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="text-info my-2">Atachment files</div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-info btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#modal_upload_attach">
                                            <i class="fa-solid fa-upload" aria-hidden="true"></i> Upload attachment files
                                        </button>
                                    </div>
                                </div>

                                <div class="table-responsive px-0 px-md-5">
                                    <table class="table" id="table_id" summary="Attached files">
                                        <thead>
                                            <tr>
                                                <th>N°</th>
                                                <th>File's name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table_items"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Bizagi tab -->
                        <div class="tab-pane fade" id="nav-bizagi" role="tabpanel" aria-labelledby="nav-bizagi-tab">
                            <div class="container pt-0 align-items-center rounded-3" id="bizagi_content">

                                <div class="d-none" id="bizagi_viewer_content">
                                    <div class="border border-bottom d-flex justify-content-between align-items-center">
                                        <div>
                                            <h4 class="text-center my-2">Bizagi viewer</h4>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-danger btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#modal_delete_bizagi">
                                                <i class="fa-solid fa-trash" aria-hidden="true"></i> Delete Bizagi
                                            </button>
                                            <a href="" class="btn btn-info btn-sm rounded-pill" target="_blank" id="link_bizagi_diagram" rel="noopener">
                                                <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i> Open in Bizagi
                                            </a>
                                        </div>

                                    </div>
                                    <iframe src="" width="100%" id="bizagi_viewer" title="Bizagi viewer"></iframe>
                                </div>

                                <div class="text-center d-none" id="no_bizagi_viewer">
                                    <img src="assets/imgs/bizagi_icon.png" alt="Bizagi not found" class="img-fluid my-5 bizagi_logo" width="40%">
                                    <p class="text-dark fw-bolder"><small>There is no Bizagi to display</small></p>
                                    <button type="button" class="btn btn-outline-info rounded-pill" id="btn_upload_bizagi_folder" data-bs-toggle="modal" data-bs-target="#modal_upload_bizagi_folder">
                                        <i class="fa-solid fa-plus" aria-hidden="true"></i> Upload Bizagi Folder
                                    </button>
                                </div>
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
    include("includes/modal_delete_pdf.php");
    include("includes/modal_delete_bizagi.php");
    include("includes/modal_upload_pdf.php");
    include("includes/modal_upload_attach.php");
    include("includes/modal_upload_bizagi_folder.php");
    include("includes/modal_excel_link.php");
    include("includes/modal_logout.php");

    //TOASTS
    include("includes/toast.php");
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.4/js/dx.all.js" integrity="sha512-aQAJMeqooVJsjLfnQeh5XCKnn8pF+ujBYawvUePQZooZ5PthLF2/bZS1reU+nuGEBYuzrFG1812mxjF09R1T8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/datatables/datatables.min.js"></script>
    <script src="assets/js/upload_bizagi.js"></script>
    <script src="admin.js"></script>

</body>

</html>