 <?php
    require_once "./db_config.php";
    require_once "./employee.php";


    if (isset($_POST["btn_submit"])) {
        $name = $_POST["name"];
        $location = $_POST["location"];
        $phone = $_POST["phone"];

        // $employes = new User();
        // $employes->Add($name,$location,$phone);

        User::Add($name, $location, $phone);
        header("location:index.php");
        exit();

    }



    if(isset($_GET["deleteId"])){
        $id = $_GET["deleteId"];
        $stmt = $db->query("delete from departments where id=$id");
        header("location:index.php");
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
     <div class="container bg-light">
         <div class="row">
             <div class="col-md-6">
                 <h2>Create Department</h2>

                 <form action="" method="post">
                     <div>
                         <label class="form-label" for="name">Name</label>
                         <input class="form-control" type="text" name="name" id="name">
                     </div>

                     <div>
                         <label class="form-label" for="location">Location</label>
                         <input class="form-control" type="text" name="location" id="location">
                     </div>

                     <div>
                         <label class="form-label" for="phone">Phone</label>
                         <input class="form-control" type="text" name="phone" id="phone">
                     </div>

                     <div>
                         <input class="btn btn-info mt-2" type="submit" name="btn_submit" id="">
                     </div>
                 </form>
             </div>

             <div class="col-md-6">
                 <h1>Department table</h1>

                 <table class="table table straped">
                     <thead>
                         <tr>
                             <th>ID</th>
                             <th>Name</th>
                             <th>Location</th>
                             <th>Phone</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            $data = User::show();
                            $result = [];
                            foreach ($data as $key => $dep) {
                                array_push($result, (object)$dep);
                                $key++;
                                echo "
                            <tr>
                             <td>$key</td>
                             <td>$dep->name</td>
                             <td>$dep->location</td>
                             <td>$dep->phone</td>
                             <td><a class='btn btn-warning' href='index.php?deleteId=$dep->id'>Delete </a></td>
                            </tr>
                            
                            ";
                            }
                            ?>
                     </tbody>
                 </table>
             </div>
         </div>
         <hr>
         <hr>

         <h1>Employee table</h1>

         <table class="table table straped">
             <thead>
                 <tr>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Salary</th>
                     <th>Department</th>
                 </tr>
             </thead>
             <tbody>
                 <?php
                    $data = User::allData();
                    $result = [];
                    foreach ($data as $key => $emp) {
                        array_push($result, (object)$emp);
                        $key++;
                        echo "
                            <tr>
                             <td>$key</td>
                             <td>$emp->name</td>
                             <td>$emp->salary</td>
                             <td>$emp->department</td>                            
                            </tr>
                            
                            ";
                    }
                    ?>
             </tbody>
         </table>



     </div>

 </body>

 </html>