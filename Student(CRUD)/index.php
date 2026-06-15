 <?php

    include_once "db_config.php";
    require_once "student.php";



        $foundData = (object)[];
        if(isset($_GET["btn_submit"])){
           $id = $_GET["sid"];
           $foundData = "";

           if($id != ""){
            $foundData = Student::find($id) ?? [];
           }
        }

        if(isset($_GET["deleteid"])){
            $id = $_GET["deleteid"];
            $delete = Student::delete($id);
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
     <div class="container py-3">

         <a class="btn btn-success m-3" href="createData.php">Create Data</a>

         <div class="row">
             <div class="col-md-8 ">
                 <h1 class="text-danger">All Students</h1>

                 <table class=" table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>CGPA</th>
                            <th>Action </th>
                                                                                        
                        </tr>
                    </thead>
                    <tbody>
                         <?php 
                           $students= Student::all();
                           foreach($students as $value){
                            echo "
                                <tr>
                                    <td>$value->id</td>
                                    <td>$value->name</td>
                                    <td>$value->email</td>
                                    <td>$value->department</td>
                                    <td>$value->cgpa</td>
                                    <td>
                                        <a class='btn btn-warning' href='update.php?id=$value->id'>Edit</a>
                                        <a class='btn btn-danger' onclick='return confirm(`Are you sure?`)' href='index.php?deleteid=$value->id'>Delete</a>
                                    </td>
                                </tr>
                            
                            ";

                           }
                         ?>
                         
                    </tbody>
                 </table>
             </div>

             <div class="col-md-4">
                <h2>Search Student</h2>
                <form action="#" method="get">
                    <input type="text" name="sid" id="">
                    <input type="submit" name="btn_submit" id="">
                </form>
                 <?php echo is_object($foundData)? "": "Data not found" ?>

                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>  <?php echo $foundData->id ?? "" ?></th>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <th>  <?php echo $foundData->name ?? "" ?></th>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <th>  <?php echo $foundData->email ?? "" ?></th>
                    </tr>
                    <tr>
                        <th>Department</th>
                        <th>  <?php echo $foundData->department ?? "" ?></th>
                    </tr>
                    <tr>
                        <th>CGPA</th>
                        <th>  <?php echo $foundData->cgpa ?? "" ?></th>
                    </tr>
                </table>
             </div>
         </div>
     </div>
 </body>

 </html>