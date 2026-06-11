<?php
session_start();
require_once "db_config.php";
$error = "";
if (isset($_POST["btn_submit"])) {
    $name = trim( $_POST["name"]);
    $password = $_POST["password"];

    $stmt = $db->query("select * from users  where name='$name' and password= '$password' ");
    $data = $stmt->fetch_object();
    
        if (isset($data->name)) {
            $_SESSION["name"] = $name;
            $_SESSION["id"] = $password;
            header("location:index.php");
        }else{
            $error = "incorrect name or password";
        }
    }

    
    //  print_r($_POST);




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
                        <input value=" <?= isset($name) ? "$name" : "" ?>" class="form-control" type="text" name="name" id="">
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