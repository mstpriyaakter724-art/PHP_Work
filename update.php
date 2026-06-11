
 <?php 
   require_once "db_config.php";
    include_once("Student.php");


    if(isset($_GET["id"])){
       $id=$_GET["id"];
       $data = Student::find($id);
    }

    
    if(isset($_POST["btn_submit"])){
     $id= $_POST["id"];
     $name= $_POST["name"];
     $email= $_POST["email"];
     $gender= $_POST["gender"];
     $mobile= $_POST["mobile"];
     $student= new Student($id,$name, $email,$gender, $mobile);
     echo  $student->update();
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

        <a class="btn btn-primary" href="index.php">Manage Student</a>
    
    <form action="" method="post">
       <div>
         <!-- <label class="form-label" for="id">ID</label> <br> -->
          <input hidden class="form-control" type="text" name="id" id="id" value=" <?php echo $data->id ?? "" ?> ">
       </div>
       <div>
         <label  class="form-label"for="name">Name</label> <br>
          <input class="form-control" type="text" name="name" id="" value=" <?php echo ucfirst($data->name) ?? "" ?> ">
       </div>
       <div>
         <label class="form-label"  for="email">Email</label> <br>
          <input  class="form-control" type="text" name="email" id="" value=" <?php echo $data->email ?? "" ?> ">
       </div>
       <div>
         <label for="gender">Gender</label> <br>
          <input   <?php echo $data->gender == "male" ? "checked" :"" ?>    class="form-check-input" type="radio" name="gender" id="" value="male">Male
          <input  <?php echo $data->gender == "female" ? "checked" :"" ?>   class="form-check-input" type="radio" name="gender" id="" value="female">Female
       </div>
        <div>
         <label class="form-label" for="mobile">Mobile</label> <br>
          <input class="form-control" type="text" name="mobile" id="mobile" value=" <?php echo $data->mobile ?? "" ?> ">
       </div>
        <div>
        
          <input class="btn btn-primary mt-2" type="submit" name="btn_submit" >
       </div>

    </form>
   

        </div>
         </div>
    </div>
</body>
</html>