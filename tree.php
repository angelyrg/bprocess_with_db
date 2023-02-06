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
    <div class="container">
        <div class="row py-3">
            <div class="col-lg-4 p-2 border border-dark rounded" id="menu_container">
                <div class="d-flex justify-content-end my-1">
                    <a href="#" id="btn_expand_tree" class="btn btn-sm btn-outline-light rounded-pill ms-1">Expand all</a>
                    <a href="#" id="btn_collapse_tree" class="btn btn-sm btn-outline-light rounded-pill ms-1">Collapse all</a>
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
            <div class="col-lg-8" id="content_container"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.4/js/dx.all.js" integrity="sha512-aQAJMeqooVJsjLfnQeh5XCKnn8pF+ujBYawvUePQZooZ5PthLF2/bZS1reU+nuGEBYuzrFG1812mxjF09R1T8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="treeview.js"></script>

</body>
</html>