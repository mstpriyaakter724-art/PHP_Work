<?php
session_start();

 if(!$_SESSION["name"]){
   header("location:login.php");
 }


require_once "db_config.php";
include_once("Student.php");

// print_r($_SESSION);
$foundData=(object)[];
if(isset($_GET["btn_submit"])){

    $id= $_GET["sid"];
    $foundData = "";
    if($id != ""){
         $foundData = Student::find($id) ?? []; 
    }
   
}

if(isset($_GET["deleteid"])){
    $id= $_GET["deleteid"];
    $delete= Student::delete($id);
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
    <div class="container">
         <a class="btn btn-secondary" href="createStudent.php">Create Student</a>
         <a class="btn btn-secondary" href="logout.php">logout</a>
        <div class="row">
            <div class="col-md-8">
                
                <h1>All Students</h1>

                 <table class="table table-striped">
                    <thead>
                         <tr>
                             <th>Id</th>
                             <th>Name</th>
                             <th>Email</th>
                             <th>Gender</th>
                             <th>Mobile</th>
                             <th>Action</th>
                         </tr>
                    </thead>

                    <tbody>
                     <?php
                      $students= Student::all();                    
                      foreach($students as $row){
                       
                       echo "
                       
                        <tr>
                             <td>$row->id</td>
                             <td>$row->name</td>
                             <td>$row->email</td>
                             <td>$row->gender</td>
                             <td>$row->mobile</td>
                             <td>
                                <a class='btn btn-info' href='update.php?id=$row->id'>Edit</a>
                                <a onclick='return confirm(`are you sure`)' class='btn btn-danger' href='index.php?deleteid=$row->id'>Delete</a>
                             </td>
                         </tr>
                       
                       
                       ";
                      }
                      
                  

                     ?>
                    </tbody>
                 </table>





               
            </div>

             <div class="col-md-4">
                  <h3>Search Student</h3>
                 <form action="#" method="get">
                     <input type="text" name="sid" id="id">
                     <input type="submit" name="btn_submit" id="">
                 </form>

               
                  <?php echo  is_object($foundData) ? "" :"Data Not found" ?>
                  <table class="table">
                      <tr> 
                         <th>ID</th>
                         <th> <?php echo  $foundData->id?? "" ?></th>
                      </tr>
                      <tr> 
                         <th>Name</th>
                         <th><?php echo  $foundData->name?? "" ?></th>
                      </tr>
                      <tr> 
                         <th>Email</th>
                         <th><?php echo  $foundData->email?? "" ?></th>
                      </tr>
                      <tr> 
                         <th>Gender</th>
                         <th><?php echo  $foundData->gender?? "" ?></th>
                      </tr>
                      <tr> 
                         <th>Phone</th>
                         <th><?php echo  $foundData->mobile?? "" ?></th>
                      </tr>
                  </table>
             </div>
        </div>

    </div>






</body>

</html>