<?php
session_start();
$error = "";
if (isset($_POST["btn_submit"])) {
    $name = $_POST["name"];
    $password = $_POST["password"];
    $data = file("user.txt", FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
    foreach ($data as $user) {
        list($id, $_name, $_password) = explode(",", $user);
        if ($name == $_name && $password == $_password) {
            $_SESSION["name"] = $name;
            $_SESSION["id"] = $id;
            header("location:index.php");
        }
    }

    $error = "incorrect name or password";
    //  print_r($_POST);

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
    <title>Login Page</title>
</head>

<body class="bg-light">
    <div class="container d-flex align-items-center justify-content-center">
        <div class="card " style="width: 400px; margin-top:100px">
            <div class="card-body">
                <form action="#" method="post">
                    <h3 class="text-center">Login</h3>
                    <?php echo $error ?>
                    <div class="mt-3">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control" type="text" name="name" id="">
                    </div>
                    <div class="mt-3">
                        <label class="form-label" for="name">Password</label>
                        <input  class="form-control" type="text" name="password" id="">
                    </div>
                    <div class="my-4">

                        <input class="btn btn-primary w-100" type="submit" name="btn_submit" id="">
                    </div>

                    <a class="text-decoration-none" href="#">Forget Password</a>
                </form>
            </div>
        </div>
    </div>



</body>

</html>