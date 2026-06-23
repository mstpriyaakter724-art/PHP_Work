<?php

session_start();

if(!$_SESSION["name"]){
    header("location:login.php");
}

if (isset($_POST["btn_submit"])) {
    $file = $_FILES["file"];

    print_r($file);

    $name = $file["name"];
    $type = $file["type"];
    $tmp_name = $file["tmp_name"];
    $size = $file["size"];
    $error = $file["error"];


    if ($size <= 1024 * 1024 * 1) {
        move_uploaded_file($tmp_name, "create_class/$name");
        echo "<embed ' src='create_class/$name' width='200' >";
    } else {
        echo "allowed file is 1mb";
    }
}


?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <a class="btn btn-danger" href="log.php">logout</a>


        <div class="row justify-content-center">
            <div class="col-md-5">

                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">Upload Image</h4>
                    </div>

                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="file" class="form-label">
                                    Select Image
                                </label>
                                <input
                                    type="file"
                                    name="file"
                                    id="file"
                                    class="form-control">
                            </div>

                            <button
                                type="submit"
                                name="btn_submit"
                                class="btn btn-primary w-100">
                                Upload
                            </button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>