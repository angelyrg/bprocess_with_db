<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="shortcut icon" href="https://bootswatch.com/_assets/img/logo.svg" type="image/x-icon">
    <title>Files test</title>
</head>

<body>
    <?php
    $getfile = file_get_contents('data.json');
    $jsonfile = json_decode($getfile);
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">

        <div class="row">

            <div class="col-md-8">
                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    <?php $no = 0;
                    foreach ($jsonfile->records as $index => $obj) : $no++;  ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $obj->title; ?></td>
                            <td><?php echo $obj->description; ?></td>
                            <td>
                                <!-- <a class="btn btn-xs btn-primary" href="update.php?id=<?php echo $index; ?>">Edit</a>
                            <a class="btn btn-xs btn-danger" href="delete.php?id=<?php echo $index; ?>">Delete</a> -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header">
                        New record
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" id="form_test">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control rounded-3">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" name="description" id="description" class="form-control rounded-3">
                            </div>
                            <div class="mt-2 text-center">
                                <button class="btn btn-primary" type="submit" id="btn_save">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>



    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="assets/app.js"></script>

</body>

</html>