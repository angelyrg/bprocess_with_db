<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test enviroment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.4/css/dx.material.teal.dark.compact.min.css" integrity="sha512-ioJLHRykPd1rKVB8X4J1taJlTukGkGb9tM7NO4DUAE3U6UszBxzfpaXjkH48issEberdAQ+9yHHmilYjYYDzqQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/bootswatch.css">
    <link rel="stylesheet" href="assets/treeview.css">
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
                <div id="icon_loading" class="spinner-border text-secondary visually-hidden" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p id="process_title"></p>
            </div>
        </div>
    </div>

    <?php include("includes/modal_new_item.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.4/js/dx.all.js" integrity="sha512-aQAJMeqooVJsjLfnQeh5XCKnn8pF+ujBYawvUePQZooZ5PthLF2/bZS1reU+nuGEBYuzrFG1812mxjF09R1T8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="main.js"></script>
    <script src="new_item.js"></script>

</body>
</html>