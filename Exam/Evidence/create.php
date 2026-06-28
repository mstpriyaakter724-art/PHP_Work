 <?php 
   require_once "db_config.php";

   if(isset($_POST["btn_submit"])){
    $name= $_POST["name"];
    $location = $_POST["location"];

    global $db;

    $stmt = $db->query("call create_manu('$name','$$location')");

    header("location:delete.php");
    
   }
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Document</title>

    <style>
        div{
            margin-top: 15px;
        }
    </style>
 </head>
 <body>
    <a href="create.php"><button>Create Q-2</button></a>     
     <a href="delete.php"><button>Delete Q-3</button></a>
     <a href="view.php"><button>View Q-4</button></a>
     <hr>

     <h2>Create Manufacturer</h2>
     <form action="" method="post">
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="location">Location</label>
            <input type="text" name="location" id="location">
        </div>
        <div>
            <input type="submit" name="btn_submit" id="">
        </div>
     </form>
 </body>
 </html>