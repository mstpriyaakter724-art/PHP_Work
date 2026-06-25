 <?php 
 try {
    $db = new mysqli("localhost", "root","","school");
    echo "database connected successfully";
 } catch (\Throwable $th) {
  echo $th->getMessage();
 }
 
 




 ?>