 <?php
    include_once "db_config.php";
    include_once "employees.php";

    $data = [];
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $data = Employee::find($id);
    }


    if (isset($_POST['btn_submit'])) {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $department = $_POST["department"];
        $designation = $_POST["designation"];
        $salary = $_POST["salary"];

        $employee= new Employee($id,$name,$phone,$department,$designation,$salary);


        echo $employee->update();
        header("location:index.php");
    }
    ?>





 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js" integrity="sha512-EKWWs1ZcA2ZY9lbLISPz8aGR2+L7JVYqBAYTq5AXgBkSjRSuQEGqWx8R1zAX16KdXPaCjOCaKE8MCpU0wcHlHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

 </head>

 <body>
     <div class="container mt-5">
         <div class="row">
             <div class="col-lg-12">
               

                 <a class="btn btn-primary" href="index.php">Manage Employee</a>
                     <h2 class="text-success text-center">Update Data</h2>
                 <form action="" method="post">

                     <div>
                         <input hidden class="form-control" type="text" name="id" id="id" value=" <?php echo $data->id ?? "" ?> ">
                     </div>

                     <div>
                         <label class="form-label" for="name">Name</label> <br>

                         <input class="form-control" type="text" name="name" id="" value="<?php echo $data->name ?? "" ?>">
                     </div>

                     <div>
                         <label class="form-label" for="phone">phone</label> <br>
                         <input class="form-control" type="text" name="phone" id="" value="<?php echo ($data->phone) ?? "" ?>">
                     </div>

                     <div>
                         <label class="form-label" for="department">Department</label>
                         <select class="form-select" name="department" id="department">
                             <option value="Sales">Sales</option>
                             <option value="Marketing">Marketing</option>
                             <option value="Finance">Finance</option>
                             <option value="Accounts">Accounts</option>
                             <option value="Administration">Administration</option>
                         </select>
                     </div>
                     <div class="mb-3">
                         <label class="form-label" for="designation">Designation</label>
                         <select class="form-select" name="designation" id="designation">
                             <option value="" selected>Select Designation</option>
                             <option value="Sales Executive">Sales Executive</option>
                             <option value="Marketing Executive">Marketing Executive</option>
                             <option value="Finance Officer">Finance Officer</option>
                             <option value="Accountant">Accountant</option>
                             <option value="Admin Executive">Admin Executive</option>
                         </select>
                     </div>
                     <div>
                         <label class="form-label" for="salary">Salary</label> <br>
                         <input class="form-control" type="text" name="salary" id="salary" value="<?php echo $data->salary ?? "" ?>">
                     </div>
                     <div>

                         <input class="btn btn-warning mt-2" type="submit" name="btn_submit">
                     </div>

                 </form>


             </div>
         </div>
     </div>
 </body>

 </html>