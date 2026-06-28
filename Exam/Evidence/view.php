 <?php
    require_once "db_config.php";


    global $db;

    $stmt = $db->query("select * from greate_price");
    $result = array_map(fn($e) => (object)$e, $stmt->fetch_all(MYSQLI_ASSOC));

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
     <h2>All Products whose price greater than 3000</h2>

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