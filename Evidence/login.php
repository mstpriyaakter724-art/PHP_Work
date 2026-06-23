
 <?php 
 
 session_start();

 if(isset($_POST["btn_submit"])){
    $email = $_POST["email"];
    $password = $_POST["password"];


    if($email == "admin@gmail.com" && $password == "12345"){
        $_SESSION["email"]= $email;
        $_SESSION["name"]= "admin";

        header("location:upload.php");
    }else{
        echo "invallid email or password";
    }
 }
 
 ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input class="form-control" type="text" name="email" id="email">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input class="form-control" type="text" name="password" id="password">
                            </div>

                            <div>
                                <input class="form-control btn btn-primary" type="submit" name="btn_submit" id="">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
    
</body>
</html>