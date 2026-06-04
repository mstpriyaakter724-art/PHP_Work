<?php
    include_once("Student.php");

    $data = [];
        if (isset($_GET["btn_submit"])) {
            $id = $_GET["sid"];
            $data = student::find($id) ?? [];
        }
        if (isset($_GET["id"])) {
            $id = $_GET["id"];

            $data = Student::delete($id);

            echo $data;
        }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js" integrity="sha512-EKWWs1ZcA2ZY9lbLISPz8aGR2+L7JVYqBAYTq5AXgBkSjRSuQEGqWx8R1zAX16KdXPaCjOCaKE8MCpU0wcHlHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Student Data</title>
</head>

<body>
    <div class="container">
        <a class="btn btn-secondary" href="createStudent.php"></a>
        <div class="row">
            <div class="col-md-8">
                <h2>All Students</h2>
                <?php echo student::show(); ?>
            </div>

            <div class="col-md-4">
                <form action="#" method="get">
                    <label for="id">Id</label>
                    <input type="text" name="sid" id="id">
                    <input type="submit" name="btn_submit">
                </form>
                <h2>Student Data</h2>
                <?php echo is_array($data) ? "" : "Data Not found" ?>

                <table>
                    <tr>
                        <th>ID</th>
                        <th> <?php echo  $data["sid"] ?? "" ?></th>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <th><?php echo  $data["name"] ?? "" ?></th>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <th><?php echo  $data["email"] ?? "" ?></th>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <th><?php echo  $data["gender"] ?? "" ?></th>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <th><?php echo  $data["mobile"] ?? "" ?></th>
                    </tr>
                </table>

            </div>
        </div>
    </div>
</body>

</html>