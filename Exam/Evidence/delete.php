 <?php
    require_once "db_config.php";

    $Manu_stmt = $db->query("select * from manufacturers");
    $Manu_result = array_map(fn($e) => (object)$e, $Manu_stmt->fetch_all(MYSQLI_ASSOC));

    $stmt = $db->query("select * from all_product");
    $result = array_map(fn($e) => (object)$e, $stmt->fetch_all(MYSQLI_ASSOC));

    if(isset($_GET["deleteId"])){
        $id = $_GET["deleteId"];

        $stmt = $db->query("delete from manufacturers where id= $id");
        header("location:delete.php");
    }

    ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>

 </head>

 <body>
      <a href="create.php"><button>Create Q-2</button></a>     
     <a href="delete.php"><button>Delete Q-3</button></a>
     <a href="view.php"><button>View Q-4</button></a>
     <hr>

     <h2>Manufacturers</h2>
     <table border="2">
         <thead>
             <tr>
                 <th>Id</th>
                 <th>Name</th>
                 <th>Location</th>
                 <th>Action</th>
             </tr>

         </thead>
         <tbody>

             <?php
                foreach ($Manu_result as $key => $manu) {
                    $key++;
                    echo "
                        <tr>
                            <td>$key</td>
                            <td>$manu->name</td>
                           <td>$manu->location</td>                            
                            <td><a href='delete.php?deleteId=$manu->id'><button>Delete</button></a></td>
                     </tr>
                    
                    ";
                }

                ?>

         </tbody>
     </table>
     <br>
     <hr>
     <br>
     <table border="2">
         <thead>
             <tr>
                 <th>Id</th>
                 <th>Name</th>
                 <th>Price</th>
                 <th>Manufacturer</th>
             </tr>

         </thead>
         <tbody>
             <?php
                foreach ($result as $key => $pro) {
                    $key++;
                    echo "
                        <tr>
                            <td>$key</td>
                            <td>$pro->name</td>
                            <td>$pro->price</td>
                            <td>$pro->manufacture</td>
                     </tr>
                    
                    ";
                }

                ?>

         </tbody>
     </table>
 </body>

 </html>