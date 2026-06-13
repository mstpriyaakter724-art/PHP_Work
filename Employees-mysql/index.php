<?php
// session_start();

// if(!$_SESSION["name"]){
//     header("location:login.php");
// }
 
 require_once "db_config.php";
 include_once "employees.php";


 $foundData = (object)[];
 if(isset($_GET["btn_submit"])){
    $id=$_GET["sid"];
    $foundData = "";
    if($id != ""){
        $foundData = Employee::find($id) ?? [];
    }
 }

 if(isset($_GET["deleteid"])){
    $id = $_GET["deleteid"];
    $delete = Employee::delete($id);
    echo $delete;
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
    <div class="container py-5">
         <a class="btn btn-success mx-3" href="create_employee.php">Create Employee</a>
         <a class="btn btn-info mx-3" href="">logout</a>
        <div class="row">
            <div class="col-md-8">
                
                <h1 class="mt-5 text-danger text-center">All Employees</h1>

                 <table class="table table-striped">
                    <thead>
                         <tr>
                             <th>Id</th>
                             <th>Name</th>
                             <th>Phone</th>
                             <th>Department</th>
                             <th>Designaton</th>
                             <th>Salary</th>
                             <th>Action</th>
                         </tr>
                    </thead>

                    <tbody>
                     <?php
                     $employee = Employee::all();
                      foreach($employee as $row){
                       echo "
                       
                        <tr>
                             <td>$row->id</td>
                             <td>$row->name</td>
                             <td>$row->phone</td>
                             <td>$row->department</td>
                             <td>$row->designation</td>
                             <td>$row->salary</td>
                             <td>
                                <a class='btn btn-info' href='update.php?id=$row->id'>Edit</a>
                                <a onclick='return confirm(`are you sure`)' class='btn btn-warning' href='index.php?deleteid=$row->id'>Delete</a>
                             </td>
                         </tr>
                       
                       
                       ";
                      }
                      
                  

                     ?>
                    </tbody>
                 </table>





               
            </div>

             <div class="col-md-4">
                  <h3 class="text-primary py-3">Search Employee</h3>
                 <form action="#" method="get">
                     <input type="text" name="sid" id="id">
                     <input type="submit" name="btn_submit" id="">
                 </form>

               
                  <?php echo  is_object($foundData) > 0 ? "" :"Data Not found" ?>
                  <table class="table">
                      <tr> 
                         <th>ID</th>
                         <th> <?php echo $foundData->id?? "" ?></th>
                      </tr>
                      <tr> 
                         <th>Name</th>
                         <th><?php echo  $foundData->name?? "" ?></th>
                      </tr>
                      <tr> 
                         <th>Phone</th>
                         <th><?php echo $foundData->phone?? "" ?></th>
                      </tr>
                      <tr> 
                         <th>Department</th>
                         <th><?php echo  $foundData->department?? "" ?></th>
                      </tr>
                      <tr> 
                         <th>Designatioin</th>
                         <th><?php echo  $foundData->designation?? "" ?></th>
                      </tr>
                      <tr> 
                         <th>Salary</th>
                         <th><?php echo  $foundData->salary?? "" ?></th>
                      </tr>
                  </table>
             </div>
        </div>

    </div>






</body>

</html>
