
 <?php 
 
 include_once "db_config.php";
 include_once "student.php";


 $errors = [];
 if(isset($_POST["btn_submit"])){
    $id = 1;
    $name = $_POST["name"];
    $email = $_POST["email"];
    $department = $_POST["department"];
    $cgpa = $_POST["cgpa"];

    print_r($_POST);

    if($name == ""){
        $errors["name"] = "Please give a name";
    }

    if(!count($errors)){
        $student = new Student ($id,$name,$email,$department,$cgpa);
        $success = $student->create();

        // print_r( $student);

        echo $success;
        header("location:index.php");
    }
 }
 
 ?>










<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js" integrity="sha512-EKWWs1ZcA2ZY9lbLISPz8aGR2+L7JVYqBAYTq5AXgBkSjRSuQEGqWx8R1zAX16KdXPaCjOCaKE8MCpU0wcHlHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-12">
                <a class="btn btn-dark " href="index.php">Manage Student</a>

                <form action="#" method="post">
                    <h3 class="text-primary text-center">Create Student</h3>
                    <div>
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control" type="text" name="name" id="name">
                    </div>

                    <div>
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control" type="text" name="email" id="email">
                    </div>

                    <div>
                        <label class="form-label" for="department">Department</label><br>
                        <select class="form-select " name="department" id="department">
                            <option selected value="">Select Department</option>
                            <option value="CSE">CSE</option>
                            <option value="EEE">EEE</option>
                            <option value="Civil">Civil</option>
                            <option value="Mechanical">Mechanical</option>
                            <option value="IT">IT</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label" for="cgpa">CGPA</label>
                        <input class="form-control" type="text" name="cgpa" id="cgpa">
                    </div>

                    <div>
                        <input class="btn btn-info mt-2" type="submit" name="btn_submit" id="">
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>